<?php

namespace app\controllers;

use app\controllers\CommonController;
use app\models\User;
use Yii;

class UserController extends CommonController{

    //前台登录页
	public function actionLogin(){
        $this->layout = 'layout2';
        $model = new User;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->login($post)) {
                /*return $this->goBack(Yii::$app->request->referrer);*/
                return $this->redirect(['index/index']);
            }
        }
        return $this->render('login', ['model' => $model]);
	}

    //发送邮件注册会员
    public function actionRegistbyemail(){
        $this->layout = 'layout2';
        $model = new User;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if ($model->registByEMail($post)) {
                Yii::$app->session->setFlash('info', '电子邮件发送成功!');
            }
        }
        return $this->render('login', ['model' => $model]);
    }

    //登出
    public function actionLogout(){   
        Yii::$app->session->remove('loginname');
        if (!isset(Yii::$app->session['loginname'])) {
            /*return $this->goBack(Yii::$app->request->referrer);*/
            return $this->redirect(['user/login']);
        }
    }

    //qq登录页
    public function actionLoginbyqq(){
        require_once("../vendor/qqlogin/qqConnectAPI.php");
        $qc = new \QC();
        $qc->qq_login();
    }

    //qq注册页
    public function actionRegistbyqq(){
        $this->layout = "layout2";
        $model = new User;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $session = Yii::$app->session;
            $post['User']['openid'] = $session['openid'];
            if ($model->addUser($post, 'registbyqq')) {
                $session['loginname'] = $post['User']['username'];
                return $this->redirect(['index/index']);
            }
        }
        return $this->render('registbyqq', ['model' => $model]);
    }

}