<?php

namespace app\controllers;

use app\controllers\CommonController;
use Yii;
use app\models\Pay;

class PayController extends CommonController{

    public $enableCsrfValidation = false;

    //异步通知支付状态
    public function actionAsyncNotify(){
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            if (Pay::asyncNotify($post)) {
                echo "success";
            }
            echo "false";
        }
    }

    //同步通知支付状态
    public function actionSyncNotify(){
        $this->layout = 'layout1';
        $trade_status = Yii::$app->request->get('trade_status');
        if ($trade_status == 'TRADE_SUCCESS') {
            $status = 'ok';
        } else {
            $status = 'no';
        }
        return $this->render("syncnotify", ['status' => $status]);
    }
    
}