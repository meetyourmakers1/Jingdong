<?php

namespace app\models;

use yii\db\ActiveRecord;

class OrderDetail extends ActiveRecord{

    //模型表名
    public static function tableName(){
        return "{{%order_detail}}";
    }

    //验证规则
    public function rules(){
        return [
            [['productid', 'productnumber', 'price', 'orderid', 'createtime'],'required'],
        ];
    }

    //订单详情创建
    public function add($data){
        if ($this->load($data) && $this->save()) {
            return true;
        }
        return false;
    }
    
}