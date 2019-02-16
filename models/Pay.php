<?php

namespace app\models;

use app\models\Order;
use app\models\OrderDetail;
use app\models\Product;

class Pay{

    public static function alipay($id){
        $subject = "商城";
        $total_fee = Order::find()->where('id = :id', [':id' => $id])->one()->amount;
        $orderDetails = OrderDetail::find()->where('orderid = :orderid', [':orderid' => $id])->all();
        $body = "";
        foreach ($orderDetails as $orderDetail) {
            $body .= Product::find()->where('id = :id', [':id' => $orderDetail['productid']])->one()->title . " - ";
        }
        $body .= "等商品";
        $show_url = "www.jingdong.com";
        require_once("../vendor/AliPay/AlipayPay.php");
        $alipay = new \AlipayPay;
        $html = $alipay->requestPay($id, $subject, $total_fee, $body, $show_url);
        echo $html;   
    }

    //异步通知支付状态
    public static function asyncNotify($data){
        $alipay = new \AlipayPay();
        $verify_result = $alipay->verifyNotify();
        if ($verify_result) {
            $out_trade_no = $data['extra_common_param'];
            $trade_no = $data['trade_no'];
            $trade_status = $data['trade_status'];
            $status = Order::PAYFAILED;
            if ($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
                $status = Order::PAYSUCCESS;
                $order = Order::find()->where('id = :id', [':id' => $out_trade_no])->one();
                if ($order->status == Order::CHECKORDER) {
                    Order::updateAll(['status' => $status],'tradeno' => $trade_no, 'tradedata' => json_encode($data)], 'id = :id', [':id' => $order->id]);
                } else {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }
    
}