<?php

namespace app\controllers;

use app\controllers\CommonController;
use Yii;
use app\models\User;
use app\models\Order;
use app\models\OrderDetail;
use app\models\Cart;
use app\models\Product;
use app\models\Address;
use app\models\Pay;
use dzer\express\Express;

class OrderController extends CommonController{

    //我的订单页
    public function actionIndex(){
        $this->layout = "layout2";
        if (Yii::$app->session['loginname'] == null) {
            return $this->redirect(['user/login']);
        }
        $userid = User::find()->where('username = :username or useremail = :useremail', [':username' => Yii::$app->session['loginname'], ':useremail' => Yii::$app->session['loginname']])->one()->id;
        $orders = Order::getMyOrder($userid);
        return $this->render("index", ['orders' => $orders]);
    }

    //订单创建
    public function actionAdd(){
        if (Yii::$app->session['loginname'] == null) {
            return $this->redirect(['user/login']);
        }
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $userid = User::find()->where('username = :username or useremail = :email', [':username' => Yii::$app->session['loginname'], ':email' => Yii::$app->session['loginname']])->one()->id;
            $model = new Order;
            $model->scenario = 'add';
            $model->userid = $userid;
            $model->status = Order::CREATEORDER;
            $model->createtime = time();
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if (!$model->save()) {
                    throw new \Exception();
                }
                $id = $model->getPrimaryKey();
                foreach ($post['OrderDetail'] as $product) {
                    $orderDetail = new OrderDetail;
                    $product['orderid'] = $id;
                    $product['createtime'] = time();
                    $data['OrderDetail'] = $product;
                    if (!$orderDetail->add($data)) {
                        throw new \Exception();
                    }
                    $cart = Cart::deleteAll('productid = :productid' , [':productid' => $product['productid']]);
                    $product = Product::updateAllCounters(['number' => -$product['productnumber']], 'id = :id', [':id' => $product['productid']]);
                    if (!$cart && $product) {
                        throw new \Exception();
                    }
                }
                $transaction->commit();
            } catch(\Exception $e) {
                $transaction->rollback();
                return $this->redirect(['cart/index']);
            }
        }
        return $this->redirect(['order/check', 'id' => $id]);
    }

    //订单确认页
    public function actionCheck(){
        $this->layout = "layout1";
        if (Yii::$app->session['loginname'] == null) {
            return $this->redirect(['user/login']);
        }
        $orderid = Yii::$app->request->get('id');
        $status = Order::find()->where('id = :id', [':id' => $orderid])->one()->status;
        if ($status != Order::CREATEORDER && $status != Order::CHECKORDER) {
            return $this->redirect(['order/index']);
        }
        $userid = User::find()->where('username = :username or useremail = :email', [':username' => Yii::$app->session['loginname'], ':email' => Yii::$app->session['loginname']])->one()->id;
        $expresses = Yii::$app->params['express'];
        $expressPrice = Yii::$app->params['expressPrice'];
        $addresses = Address::find()->where('userid = :userid', [':userid' => $userid])->asArray()->all();
        $orderDetails = OrderDetail::find()->where('orderid = :orderid', [':orderid' => $orderid])->asArray()->all();
        $data = [];
        foreach ($orderDetails as $orderDetail) {
            $model = Product::find()->where('id = :id' , [':id' => $orderDetail['productid']])->one();
            $orderDetail['title'] = $model->title;
            $orderDetail['cover'] = $model->cover;
            $data[] = $orderDetail;
        }
        return $this->render("check", ['products' => $data,'expresses' => $expresses, 'expressPrice' => $expressPrice, 'addresses' => $addresses ]);
    }

    //订单确认
    public function actionConfirm(){   
        if (Yii::$app->session['loginname'] == null) {
            return $this->redirect(['user/login']);
        }
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $userid = User::find()->where('username = :username or useremail = :email', [':username' => Yii::$app->session['loginname'], ':email' => Yii::$app->session['loginname']])->one()->id;
            $model = Order::find()->where('id = :id and userid = :userid', [':id' => $post['id'], ':userid' => $userid])->one();
            $model->scenario = "confirm";
            $post['status'] = Order::CHECKORDER;
            $orderDetails = OrderDetail::find()->where('orderid = :orderid', [':orderid' => $post['id']])->all();
            $amount = 0;
            foreach ($orderDetails as $orderDetail) {
                $amount += $orderDetail->productnumber*$orderDetail->price;
            }
            $express = Yii::$app->params['expressPrice'][$post['expressid']];
            $amount += $express;
            $post['amount'] = $amount;
            $data['Order'] = $post;
            if ($model->load($data) && $model->save()) {
                return $this->redirect(['order/pay', 'id' => $post['id']]);
            }
        }
        return $this->redirect(['index/index']);
    }

    //订单支付
    public function actionPay(){
        if (Yii::$app->session['loginname'] == null) {
            return $this->redirect(['user/login']);
        }
        $id = Yii::$app->request->get('id');  
        return Pay::alipay($id);
    }

    //会员收货
    public function actionReceived(){
        $id = Yii::$app->request->get('id');
        $order = Order::find()->where('id = :id', [':id' => $id])->one();
        if ($order->status == Order::SENDED) {
            $order->status = Order::RECEIVED;
            $order->save();
        }
        return $this->redirect(['order/index']);
    }

    //物流信息
    public function actionGetexpress(){
        require_once("../vendor/dzer/yii2-express/src/Express.php");
        $expressno = Yii::$app->request->get('expressno');
        $res = Express::search($expressno);
        echo $res;
    }
    
}