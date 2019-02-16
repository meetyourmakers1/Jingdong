<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Category;
use app\models\User;
use Yii;
use app\models\Cart;
use app\models\Product;

class CommonController extends Controller{

    public function init(){
        $list = Category::getList();
        $this->view->params['list'] = $list;
        $sql = new \yii\caching\DbDependency([
            'sql' => 'select max(createtime) from {{%product}} where isstore = "1"',
        ]);
        $sale = Product::getDb()->cache(function(){
            return Product::find()->where('isstore = "1" and issale = "1"')->orderby('createtime desc')->limit(3)->all();
        }, 60, $sql);
        $new = Product::getDb()->cache(function(){
            return Product::find()->where('isstore = "1"')->orderby('createtime desc')->limit(3)->all();
        }, 60, $sql);
        $hot = Product::getDb()->cache(function(){
            return Product::find()->where('isstore = "1" and ishot = "1"')->orderby('createtime desc')->limit(3)->all();
        }, 60, $sql);
        $tui = Product::getDb()->cache(function (){
            return Product::find()->where('istui = "1" and isstore = "1"')->orderby('createtime desc')->limit(3)->all();
        }, 60, $sql);
        $this->view->params['sale'] = (array)$sale;
        $this->view->params['new'] = (array)$new;
        $this->view->params['hot'] = (array)$hot;
        $this->view->params['tui'] = (array)$tui;
        /*$data = [];
        $total = 0;
        $userid = User::find()->where('username = :username',[':username' => Yii::$app->session['loginname']])->one();
        $carts = Cart::find()->where('userid = :userid', [':userid' => $userid])->asArray()->all();
        foreach($carts as $k=>$product) {
            $product = Product::find()->where('productid = :pid', [':pid' => $product['productid']])->one();
            $data['products'][$k]['cover'] = $product->cover;
            $data['products'][$k]['title'] = $product->title;
            $data['products'][$k]['productnum'] = $product['productnum'];
            $data['products'][$k]['price'] = $product['price'];
            $data['products'][$k]['productid'] = $product['productid'];
            $data['products'][$k]['cartid'] = $product['cartid'];
            $total += $data['products'][$k]['price'] * $data['products'][$k]['productnum'];
        }
        $data['total'] = $total;
        $this->view->params['cart'] = $data;*/
    }
    
}