<?php

namespace app\modules\controllers;

use app\modules\controllers\CommonController;
use app\models\Product;
use app\models\Category;
use Yii;
use yii\data\Pagination;
use crazyfd\qiniu\Qiniu;

class ProductController extends CommonController{

    //商品列表
    public function actionList(){
        $this->layout = "layout1";
        $model = Product::find();
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['product'];
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $products = $model->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render("list",['products' => $products,'pagination' => $pagination]);
    }

    //加入新商品
    public function actionAdd(){
        $this->layout = "layout1";
        $model = new Product;
        $category = new Category;
        $categories = $category->getCategories();
        $categories = $category->getCategoryTree($categories);
        foreach ($categories as $key) {
            $list[$key['id']] = $key['title'];
        }
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $pictures = $this->upload();
            if (!$pictures) {
                $model->addError('cover', '商品封面不能为空!');
            } else {
                $post['Product']['cover'] = $pictures['cover'];
                $post['Product']['pictures'] = $pictures['pictures'];
            }
            if ($model->add($post)) {
                Yii::$app->session->setFlash('info', '添加成功!');
            } else {
                Yii::$app->session->setFlash('info', '添加失败!');
            }
        }
        return $this->render("add", ['model' => $model,'list' => $list]);
    }

    //商品图片上传七牛
    private function upload(){
        $qiniu = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
        $id1 = uniqid();
        $qiniu->uploadFile($_FILES['Product']['tmp_name']['cover'], $id1);
        $cover = $qiniu->getLink($id1);
        $pictures = [];
        foreach ($_FILES['Product']['tmp_name']['pictures'] as $key => $file) {
            if ($_FILES['Product']['error']['pictures'][$key] > 0) {
                continue;
            }
            $id2 = uniqid();
            $qiniu->uploadFile($file, $id2);
            $pictures[$id2] = $qiniu->getLink($id2);
        }
        return ['cover' => $cover, 'pictures' => json_encode($pictures)];
    }

    //编辑商品
    public function actionMod(){
        $this->layout = "layout1";
        $category = new Category;
        $categories = $category->getCategories();
        $categories = $category->getCategoryTree($categories);
        foreach ($categories as $key) {
            $list[$key['id']] = $key['title'];
        }
        $id = Yii::$app->request->get("id");
        $model = Product::find()->where('id = :id', [':id' => $id])->one();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $qiniu = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
            $post['Product']['cover'] = $model->cover;
            if ($_FILES['Product']['error']['cover'] == 0) {
                $id = uniqid();
                $qiniu->uploadFile($_FILES['Product']['tmp_name']['cover'], $id);
                $post['Product']['cover'] = $qiniu->getLink($id);
                $qiniu->delete(basename($model->cover));
            }
            $pictures = [];
            foreach ($_FILES['Product']['tmp_name']['pictures'] as $key => $file) {
                if ($_FILES['Product']['error']['pictures'][$key] > 0) {
                    continue;
                }
                $id = uniqid();
                $qiniu->uploadfile($file, $id);
                $pictures[$id] = $qiniu->getlink($id);
            }
            $post['Product']['pictures'] = json_encode(array_merge((array)json_decode($model->pictures, true), $pictures));
            if ($model->load($post) && $model->save()) {
                Yii::$app->session->setFlash('info', '修改成功!');
            }
        }
        return $this->render('add', ['model' => $model, 'list' => $list]);
    }

    //删除商品图片
    public function actionRemovepicture(){
        $key = Yii::$app->request->get("key");
        $id = Yii::$app->request->get("id");
        $model = Product::find()->where('id = :id', [':id' => $id])->one();
        $qiniu = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
        $qiniu->delete($key);
        $pictures = json_decode($model->pictures, true);
        unset($pictures[$key]);
        Product::updateAll(['pictures' => json_encode($pictures)], 'id = :id', [':id' => $id]);
        return $this->redirect(['product/mod', 'id' => $id]);
    }

    //上架商品
    public function actionOn(){
        $id = Yii::$app->request->get("id");
        Product::updateAll(['isstore' => '1'], 'id = :id', [':id' => $id]);
        return $this->redirect(['product/list']);
    }

    //下架商品
    public function actionOff(){
        $id = Yii::$app->request->get("id");
        Product::updateAll(['isstore' => '0'], 'id = :id', [':id' => $id]);
        return $this->redirect(['product/list']);
    }

    //删除商品
    public function actionDel(){
        $id = Yii::$app->request->get("id");
        $model = Product::find()->where('id = :id', [':id' => $id])->one();
        $key = basename($model->cover);
        $qiniu = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
        $qiniu->delete($key);
        $pictures = json_decode($model->pictures, true);
        foreach ($pictures as $key=>$file) {
            $qiniu->delete($key);
        }
        Product::deleteAll('id = :id', [':id' => $id]);
        return $this->redirect(['product/list']);
    }

}