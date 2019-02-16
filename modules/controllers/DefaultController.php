<?php

namespace app\modules\controllers;

use app\modules\controllers\CommonController;

class DefaultController extends CommonController{
    
    //后台首页
    public function actionIndex(){
        $this->layout = 'layout1';
        return $this->render('index');
    }

}