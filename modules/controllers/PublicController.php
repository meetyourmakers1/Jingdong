<?php

namespace app\modules\controllers;

use yii\web\Controller;
use app\modules\models\Admin;
use Yii;

class PublicController extends Controller{

    //管理员登陆页
    public function actionLogin(){
        $this->layout = false;
        $model = new Admin;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->login($post)) {
                $this->redirect(['default/index']);
                Yii::$app->end();
            }
        }
        return $this->render('login',['model' => $model]);
    }

    //管理员登出
    public function actionLogout(){
        Yii::$app->session->removeAll();
        if (!isset(Yii::$app->session['admin']['adminuser'])) {
            $this->redirect(['public/login']);
            Yii::$app->end();
        }
        return $this->goback();
    }

    //管理员找回密码
    public function actionFindadminpass(){
        $this->layout = false;
        $model = new Admin;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->findAdminpass($post)) {
                Yii::$app->session->setFlash('info', '发送成功，请您查收!');
            }
        }
        return $this->render("findadminpass", ['model' => $model]);
    }

}