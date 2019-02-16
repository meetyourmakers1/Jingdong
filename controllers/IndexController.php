<?php

namespace app\controllers;

use app\controllers\CommonController;
use app\models\Product;

class IndexController extends CommonController{

    //前台首页
    public function actionIndex(){
        //$this->layout = false;
        $this->layout = "layout1";
        //return $this->renderPartial('index');
        $data['new'] = Product::find()->where('isstore = "1" and isnew = "1"')->orderby('createtime desc')->limit(4)->all();
        $data['hot'] = Product::find()->where('isstore = "1" and ishot = "1"')->orderby('createtime desc')->limit(4)->all();
        $data['tui'] = Product::find()->where('isstore = "1" and istui = "1"')->orderby('createtime desc')->limit(4)->all();
        $data['products'] = Product::find()->where('isstore = "1"')->orderby('createtime desc')->limit(7)->all();
        return $this->render('index',['data' => $data]);
    }

}