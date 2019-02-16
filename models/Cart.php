<?php

namespace app\models;

use yii\db\ActiveRecord;

class Cart extends ActiveRecord{

    //模型表名
    public static function tableName(){
        return "{{%cart}}";
    }

    //验证规则
    public function rules(){
        return [
            [['userid','productid','productnumber','price'], 'required'],
            ['createtime', 'safe']
        ];
    }

}