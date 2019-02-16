<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Category extends ActiveRecord{

    //模型表名
    public static function tableName(){
        return "{{%category}}";
    }

    //模型属性
    public function attributeLabels(){
        return [
            'pid' => '商品上级分类',
            'title' => '商品分类名称'
        ];
    }

    //验证规则
    public function rules(){
        return [
            ['pid', 'required', 'message' => '商品上级分类不能为空!', 'except' => 'rename'],
            ['title', 'required', 'message' => '商品分类名称不能为空!'],
            ['createtime', 'safe']
        ];
    }

    //加入新商品分类
    public function add($data){
        if ($this->load($data) && $this->validate()) {
            $this->createtime = time();
            if ($this->save(false)) {
                return true;
            }
            return false;
        }
        return false;
    }

    //所有商品分类数组
    public function getCategories(){
        $categories = ArrayHelper::toArray(self::find()->all());
        return $categories;
    }

    //商品分类排序
    public function getCategoryTree($categories, $pid = 0,$num = 0,$prefix = '|--'){
        $categoryTree = [];
        foreach ($categories as $category) {
            if ($category['pid'] == $pid) {
                $category['num'] = $num;
                $newcategory['id'] = $category['id'];
                $newcategory['title'] = str_repeat($prefix,$category['num']).$category['title'];
                $categoryTree[] = $newcategory;          
                $categoryTree = array_merge($categoryTree, $this->getCategoryTree($categories, $category['id'],$num+1));
            }
        }
        return $categoryTree;
    }

    //首页二级分类
    public static function getList(){
        $top = self::find()->where('pid = :pid', [":pid" => 0])->limit(10)->orderby('createtime asc')->asArray()->all();
        $list = [];
        foreach ((array)$top as $key=>$category) {
            $category['children'] = self::find()->where("pid = :pid", [":pid" => $category['id']])->limit(10)->asArray()->all();
            $list[$key] = $category;
        }
        return $list;
    }

}