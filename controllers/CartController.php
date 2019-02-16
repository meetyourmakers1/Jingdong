<?php

namespace app\controllers;

use app\controllers\CommonController;
use Yii;
use app\models\User;
use app\models\Product;
use app\models\Cart;

class CartController extends CommonController{

    //购物车页
    public function actionIndex(){
        $this->layout = 'layout1';
        if (Yii::$app->session['loginname'] == null) {
            return $this->redirect(['user/login']);
        }
        $userid = User::find()->where('username = :username', [':username' => Yii::$app->session['loginname']])->one()->id;
        $carts = Cart::find()->where('userid = :userid', [':userid' => $userid])->asArray()->all();
        $data = [];
        foreach ($carts as $key=>$product) {
            $model = Product::find()->where('id = :id', [':id' => $product['productid']])->one();
            $data[$key]['cover'] = $model->cover;
            $data[$key]['title'] = $model->title;
            $data[$key]['productnumber'] = $product['productnumber'];
            $data[$key]['price'] = $product['price'];
            $data[$key]['productid'] = $product['productid'];
            $data[$key]['id'] = $product['id'];
        }
        return $this->render("index", ['data' => $data]);
    }

    //加入购物车
    public function actionAdd(){
        if (Yii::$app->session['loginname'] == null) {
            return $this->redirect(['user/login']);
        }
        $userid = User::find()->where('username = :username', [':username' => Yii::$app->session['loginname']])->one()->id;
        if (Yii::$app->request->isGet) {
            $productid = Yii::$app->request->get("productid");
            $product = Product::find()->where('id = :id', [':id' => $productid])->one();
            $productnumber = 1;
            $price = $product->issale ? $product->saleprice : $product->price;
            $data['Cart'] = [ 'userid' => $userid,'productid' => $productid, 'productnumber' => $productnumber, 'price' => $price];
        }
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $productnumber = Yii::$app->request->post()['productnumber'];
            $data['Cart'] = $post;
            $data['Cart']['userid'] = $userid;
        }
        if (!$model = Cart::find()->where('userid = :userid and productid = :productid ', [':userid' => $data['Cart']['userid'],':productid' => $data['Cart']['productid'] ])->one()) {
            $model = new Cart;
        } else {
            $data['Cart']['productnumber'] = $model->productnumber + $productnumber;
        }
        $data['Cart']['createtime'] = time();
        $model->load($data);
        $model->save();
        return $this->redirect(['cart/index']);
    }

    //编辑购物车
    public function actionMod(){
        $id = Yii::$app->request->get("id");
        $productnumber= Yii::$app->request->get("productnumber");
        Cart::updateAll(['productnumber' => $productnumber], 'id = :id', [':id' => $id]);
    }

    //删除购物车
    public function actionDel(){
        $id = Yii::$app->request->get("id");
        Cart::deleteAll('id = :id', [':id' => $id]);
        return $this->redirect(['cart/index']);
    }

}