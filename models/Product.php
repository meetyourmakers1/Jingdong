<?php

namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord{

    const AK = 'hCk5hZfUvoOoyE4Fzqm_mphFLhAdJZAIUnjmK-R8';
    const SK = 'v1GMlFFLAXSIUjSzD5g2g70r-4y7_Phfn3YScfoX';
    const DOMAIN = 'pmpsb2ige.bkt.clouddn.com';
    const BUCKET = 'ningbo';

    public $category;

    //模型表名
    public static function tableName(){
        return "{{%product}}";
    }

    //模型属性
    public function attributeLabels(){
        return [
            'categoryid' => '商品分类',
            'title'  => '商品名称',
            'description'  => '商品描述',
            'number'    => '商品库存',
            'price'  => '商品价格',
            'cover'  => '图片封面',
            'pictures'   => '商品图片',
            'isstore'   => '是否上架',
            'issale' => '是否促销',
            'saleprice' => '促销价格',
            'ishot'  => '是否热卖',
            'istui'   => '是否推荐',
        ];
    }

    //验证规则
    public function rules(){
        return [
            ['categoryid', 'required', 'message' => '商品分类不能为空!'],
            ['title', 'required', 'message' => '商品标题不能为空!'],
            ['description', 'required', 'message' => '商品描述不能为空!'],
            ['number', 'integer', 'min' => 0, 'message' => '商品库存必须是数字!'],
            ['price', 'required', 'message' => '商品单价不能为空!'],                                           
            [['price','saleprice'], 'number', 'min' => 0.01, 'message' => '商品价格必须是数字!'],
            [['isstore','issale','ishot',  'istui','pictures'],'safe'],
            [['cover'], 'required'],
        ];
    }

    //加入新商品
    public function add($data){
        $this->isnew = 0;
        $this->createtime = time();
        if ($this->load($data) && $this->save()) {
            return true;
        }
        return false;
    }

}