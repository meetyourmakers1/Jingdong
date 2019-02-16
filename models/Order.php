<?php

namespace app\models;

use yii\db\ActiveRecord;

class Order extends ActiveRecord{

    const CREATEORDER = 0;
    const CHECKORDER = 100;
    const PAYSUCCESS = 201;
    const PAYFAILED = 202;
    const SENDED = 220;
    const RECEIVED = 260;
 
    public static $status = [
        self::CREATEORDER => '订单创建',
        self::CHECKORDER => '订单确认',
        self::PAYSUCCESS => '支付成功',
        self::PAYFAILED => '支付失败',
        self::SENDED => '已发货',
        self::RECEIVED => '订单完成',
    ];

    public $username;
    public $products;
    public $address;
    public $newstatus;

    //模型表名
    public static function tableName(){
        return "{{%order}}";
    }

    //模型属性
    public function attributeLabels(){
        return [
            'expressno' => '快递单号',
        ];
    }

    //验证规则
    public function rules(){
        return [
            [['userid', 'status'], 'required', 'on' => ['add']],
            ['createtime', 'safe', 'on' => ['add']],
            [['amount', 'status','expressid','addressid'], 'required', 'on' => ['confirm']],
            ['expressno', 'required', 'message' => '请输入快递单号!', 'on' => 'send'],
        ];
    }

    //所有订单详情
    public function getOrderDetails($orders){
        foreach($orders as $order){
            $order = self::getOrderDetail($order);
        }
        return $orders;
    }

    //每个订单详情
    public static function getOrderDetail($order){
        $order->username = User::find()->where('id = :id', [':id' => $order->userid])->one()->username;
        $orderDetails = OrderDetail::find()->where('orderid = :orderid', [':orderid' => $order->id])->all();
        $products = [];
        foreach ($orderDetails as $orderDetail) {
            $product = Product::find()->where('id = :id', [':id' => $orderDetail->productid])->one();
            $product->number = $orderDetail->productnumber;
            $products[] = $product;
        }
        $order->products = $products;
        $address = Address::find()->where('id = :id', [':id' => $order->addressid])->one();
        if (empty($address)) {
            $order->address = "";
        } else {
            $order->address = $address->address;
        }
        $order->newstatus = self::$status[$order->status];
        return $order;
    }

    //我的订单
    public static function getMyOrder($userid){
        $orders = self::find()->where('status > 0 and userid = :userid', [':userid' => $userid])->orderBy('createtime desc')->all();
        foreach ($orders as $order) {
            $orderDetails = OrderDetail::find()->where('orderid = :orderid', [':orderid' => $order->id])->all();
            $products = [];
            foreach ($orderDetails as $orderDetail) {
                $product = Product::find()->where('id = :id', [':id' => $orderDetail->productid])->one();
                $product->category = Category::find()->where('id = :id', [':id' => $product->categoryid])->one()->title;
                $product->number = $orderDetail->productnumber;
                $product->price = $orderDetail->price;
                $products[] = $product;
            }
            $order->products = $products;
            $order->newstatus = self::$status[$order->status];
        }
        return $orders;
    }

}