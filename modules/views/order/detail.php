<?php
    $this->title = '订单详情';
    /*$this->params['breadcrumbs'][] = ['label' => '订单管理', 'url' => ['/admin/order/list']];
    $this->params['breadcrumbs'][] = $this->title;*/
?>
<div class="container-fluid">
    <div id="pad-wrapper" class="users-list">
        <div class="row-fluid header">
            <h3>
                订单详情
            </h3>
        </div>
        <div class="row-fluid">
            <p>
                订单编号：
                <?php 
                    echo $order->id 
                ?>
            </p>
            <p>
                下单会员：
                <?php 
                    echo $order->username 
                ?>
            </p>
            <p>
                收货地址：
                <?php 
                    echo $order->address 
                ?>
            </p>
            <p>
                订单总价：
                <?php 
                    echo $order->amount 
                ?>
            </p>
            <p>
                快递方式：
                <?php 
                    echo array_key_exists($order->expressid, \Yii::$app->params['express'])?\Yii::$app->params['express'][$order->expressid]:'' 
                ?>
            </p>
            <p>
                快递编号：
                <?php 
                    echo $order->expressno 
                ?>
            </p>
            <p>
                订单状态：
                <?php 
                    echo $order->newstatus 
                ?>
            </p>
            <p>
                商品列表：
            </p>
            <p>
                <?php 
                    foreach($order->products as $product): 
                ?>
                <div style="display:inline">
                    <img src="http://<?php echo $product->cover ?>">
                    <br>
                    <?php 
                        echo $product->number
                    ?> 
                    x 
                    <?php 
                        echo $product->title 
                    ?>
                </div>
                <?php 
                    endforeach; 
                ?>
            </p>
        </div>
    </div>
</div>
