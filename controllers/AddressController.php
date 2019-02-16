<?php

namespace app\controllers;

use app\controllers\CommonController;
use Yii;
use app\models\User;
use app\models\Address;

class AddressController extends CommonController{

    //创建收货地址
    public function actionAdd(){
        if (Yii::$app->session['loginname'] == null) {
            return $this->redirect(['user/login']);
        }
        $userid = User::find()->where('username = :username or useremail = :email', [':username' => Yii::$app->session['loginname'], ':email' => Yii::$app->session['loginname']])->one()->id;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $post['userid'] = $userid;
            $post['address'] = $post['address1'].$post['address2'];
            $data['Address'] = $post;
            $model = new Address;
            $model->load($data);
            $model->save();
        }
        return $this->redirect($_SERVER['HTTP_REFERER']);
    }

    //删除收货地址
    public function actionDel(){
        if (Yii::$app->session['loginname'] == null) {
            return $this->redirect(['user/login']);
        }
        $userid = User::find()->where('username = :username or useremail = :email', [':username' => Yii::$app->session['loginname'], ':email' => Yii::$app->session['loginname']])->one()->id;
        $id = Yii::$app->request->get('id');
        if (!Address::find()->where('userid = :userid and id = :id', [':userid' => $userid, ':id' => $id])->one()) {
            return $this->redirect($_SERVER['HTTP_REFERER']);
        }
        Address::deleteAll('id = :id', [':id' => $id]);
        return $this->redirect($_SERVER['HTTP_REFERER']);
    }

}