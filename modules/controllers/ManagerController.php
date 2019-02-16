<?php

namespace app\modules\controllers;

use app\modules\controllers\CommonController;
use app\modules\models\Admin;
use Yii;
use yii\data\Pagination;

class ManagerController extends CommonController{

    //发送邮件修改管理员密码
    public function actionMailchangeadminpass(){
        $this->layout = false;
        $adminuser = Yii::$app->request->get("adminuser");
        $time = Yii::$app->request->get("time");
        $token = Yii::$app->request->get("token");
        $model = new Admin;
        $myToken = md5(md5($adminuser).base64_encode(Yii::$app->request->userIP).md5($time));
        if ($token != $myToken) {
            $this->redirect(['public/login']);
            Yii::$app->end();
        }
        if (time() - $time > 300) {
            $this->redirect(['public/login']);
            Yii::$app->end();
        }
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->changeAdminPass($post)) {
                Yii::$app->session->setFlash('info', '修改成功!');
            }
        }
        $model->adminuser = $adminuser;
        return $this->render("mailchangeadminpass", ['model' => $model]);
    }

    //管理员列表页
    public function actionList(){
        $this->layout = "layout1";
        $model = Admin::find();
        $count = $model->count();
        $pageSize = Yii::$app->params['pageSize']['manager'];
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $managers = $model->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render("list", ['managers' => $managers, 'pagination' => $pagination]);
    }

    //添加管理员
    public function actionAdd(){
        $this->layout = 'layout1';
        $model = new Admin;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->addAdmin($post)) {
                Yii::$app->session->setFlash('info', '添加成功!');
            } else {
                Yii::$app->session->setFlash('info', '添加失败!');
            }
        }
        $model->adminpass = '';
        $model->repassword = '';
        return $this->render('add', ['model' => $model]);
    }

    //删除管理员
    public function actionDel(){
        $id = (int)Yii::$app->request->get("id");
        if (empty($id) || $id == 1) {
            $this->redirect(['manager/list']);
        }
        $model = new Admin;
        if ($model->deleteAll('id = :id', [':id' => $id])) {
            Yii::$app->session->setFlash('info', '删除成功!');
            $this->redirect(['manager/list']);
        }
    }

    //修改管理员邮箱
    public function actionModadminemail(){
        $this->layout = 'layout1';
        $model = Admin::find()->where('adminuser = :adminuser', [':adminuser' => Yii::$app->session['admin']['adminuser']])->one();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->modAdminemail($post)) {
                Yii::$app->session->setFlash('info', '修改成功!');
            }
        }
        $model->adminpass = "";
        return $this->render('modadminemail', ['model' => $model]);
    }

    //修改管理员密码
    public function actionModadminpass(){
        $this->layout = "layout1";
        $model = Admin::find()->where('adminuser = :adminuser', [':adminuser' => Yii::$app->session['admin']['adminuser']])->one();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->modAdminpass($post)) {
                Yii::$app->session->setFlash('info', '修改成功!');
            }
        }
        $model->adminpass = '';
        $model->repassword = '';
        return $this->render('modadminpass', ['model' => $model]);
    }
    
}