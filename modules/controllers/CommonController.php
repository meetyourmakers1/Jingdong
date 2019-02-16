<?php

namespace app\modules\controllers;

use yii\web\Controller;
use Yii;

class CommonController extends Controller{
    
    public function init(){
        if (Yii::$app->session['admin']['adminuser'] == null) {
            return $this->redirect(['/admin/public/login']);
        }
    }
    
}