<?php

namespace app\controllers;

use app\controllers\CommonController;
use Yii;
use app\models\Product;
use yii\data\Pagination;

class ProductController extends CommonController{

    //商品列表页
    public function actionIndex(){
        //$this->layout = false;
        $this->layout = "layout2";
        //return $this->renderPartial('index');
        $categoryid = Yii::$app->request->get("categoryid");
        $model = Product::find()->where('categoryid = :categoryid and isstore = "1"', [':categoryid' => $categoryid]);
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['frontproduct'];
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $products = $model->offset($pagination->offset)->limit($pagination->limit)->asArray()->all();
        $sale = $model->Where('categoryid = :categoryid and isstore = \'1\' and issale = \'1\'', [':categoryid' => $categoryid])->orderby('createtime desc')->limit(5)->asArray()->all();
        $hot = $model->Where('categoryid = :categoryid and isstore = \'1\' and ishot = \'1\'', [':categoryid' => $categoryid])->orderby('createtime desc')->limit(5)->asArray()->all();
        $tui = $model->Where('categoryid = :categoryid and isstore = \'1\' and istui = \'1\'', [':categoryid' => $categoryid])->orderby('createtime desc')->limit(5)->asArray()->all();
        return $this->render('index',['products' => $products,'sale' => $sale,'hot' => $hot,  'tui' => $tui,  'pagination' => $pagination, 'count' => $count]);
    }

    //商品详情页
    public function actionDetail(){
        $this->layout = "layout2";
        $id = Yii::$app->request->get("id");
        $product = Product::find()->where('id = :id', [':id' => $id])->asArray()->one();
        $data['products'] = Product::find()->where('isstore = "1"')->orderby('createtime desc')->limit(7)->all();
        return $this->render("detail", ['product' => $product, 'data' => $data]);
    }

}