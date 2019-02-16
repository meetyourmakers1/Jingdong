<?php

namespace app\models;

use yii\db\ActiveRecord;

class Address extends ActiveRecord{

    //模型表名
    public static function tableName(){
        return "{{%address}}";
    }

    //验证规则
    public function rules(){
        return [
            [['firstname', 'lastname', 'address', 'telephone','email', 'userid', ], 'required'],
            [['home', 'postcode','createtime'],'safe'],
        ];
    }
    
}