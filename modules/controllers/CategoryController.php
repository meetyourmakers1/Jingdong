<?php

namespace app\modules\controllers;

use app\modules\controllers\CommonController;
use app\models\Category;
use Yii;

class CategoryController extends CommonController{

    //商品分类列表
    public function actionList(){
        $this->layout = "layout1";
        $model = new Category;
        $categories = $model->getCategories();
        $categories = $model->getCategoryTree($categories);
        return $this->render("list",['categories' => $categories]);
    }

    //加入新商品分类
    public function actionAdd(){
        $this->layout = "layout1";
        $model = new Category;
        $categories = $model->getCategories();
        $categoryTree = $model->getCategoryTree($categories);
        $list[0] = '添加商品顶级分类';
        foreach ($categoryTree as $key) {
            $list[$key['id']] = $key['title'];
        }
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->add($post)) {
                Yii::$app->session->setFlash('info','添加成功!');
            }
        }
        return $this->render("add",['model' =>$model,'list' => $list]);
    }

    //编辑商品分类
    public function actionMod(){
        $this->layout = "layout1";
        $id = Yii::$app->request->get("id");
        $model = Category::find()->where('id = :id', [':id' => $id])->one();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->load($post) && $model->save()) {
                Yii::$app->session->setFlash('info', '修改成功!');
            }
        }
        $categories = $model->getCategories();
        $categoryTree = $model->getCategoryTree($categories);
        $list[0] = '添加商品顶级分类';
        foreach ($categoryTree as $key) {
            $list[$key['id']] = $key['title'];
        }
        return $this->render('add', ['model' => $model, 'list' => $list]);
    }

    //删除商品分类
    public function actionDel(){
        $id = Yii::$app->request->get("id");
        $category = Category::find()->where('pid = :pid', [":pid" => $id])->one();
        try {
            if ($category) {
                    throw new \Exception('该商品分类下有子类，不允许删除!');
            }
            if (Category::deleteAll('id = :id', [":id" => $id])) {
                throw new \Exception('删除成功!');
            }
        } catch(\Exception $e) {
            Yii::$app->session->setFlash('info', $e->getMessage());
        }
        return $this->redirect(['category/list']);
    }

} 