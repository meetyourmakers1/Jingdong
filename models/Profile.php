<?php

namespace app\models;

use yii\db\ActiveRecord;

class Profile extends ActiveRecord{

    //模型表名
    public static function tableName(){
        return "{{%profile}}";
    }
    
}