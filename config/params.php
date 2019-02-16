<?php

return [
    'adminEmail' => 'admin@example.com',
    'pageSize' => [
        'manager' => 10, //管理员列表分页条数
        'user' => 10, //会员列表分页条数
        'product' => 10, //商品列表分页条数
        'frontproduct' => 10, //前台商品列表分页条数
        'order' => 10, //后台订单列表分页条数
    ],
    'defaultValue' => [
        'avatar' => 'admin/img/contact-img.png',
    ],
    'express' => [
        1 => '顺丰快递',
        2 => '中通快递',
        3 => '圆通快递',
    ],
    'expressPrice' => [
        1 => 20,
        2 => 15,
        3 => 10,
    ],
];