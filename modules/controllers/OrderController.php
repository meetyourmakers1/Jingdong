<?php

namespace app\modules\controllers;

use app\modules\controllers\CommonController;
use app\models\Order;
use Yii;
use yii\data\Pagination;
use app\models\OrderDetail;
use app\models\Product;
use app\models\User;
use app\models\Address;

class OrderController extends CommonController{

    //订单列表
    public function actionList(){
        $this->layout = "layout1";
        $model = Order::find();
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['order'];
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $orders = $model->offset($pagination->offset)->limit($pagination->limit)->all();
        $orders = Order::getOrderDetails($orders);
        return $this->render('list', [ 'orders' => $orders,'pagination' => $pagination]);
    }

    //订单详情
    public function actionDetail(){
        $this->layout = "layout1";
        $id = (int)Yii::$app->request->get('id');
        $order = Order::find()->where('id = :id', [':id' => $id])->one();
        $order = Order::getOrderDetail($order);
        return $this->render('detail', ['order' => $order]);
    }

    //管理员发货
    public function actionSend(){
        $this->layout = "layout1";
        $id = (int)Yii::$app->request->get('id');
        $model = Order::find()->where('id = :id', [':id' => $id])->one();
        $model->scenario = "send";
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $model->status = Order::SENDED;
            if ($model->load($post) && $model->save()) {
                Yii::$app->session->setFlash('info', '发货成功!');
            }
        }
        return $this->render('send', ['model' => $model]);
    }

}