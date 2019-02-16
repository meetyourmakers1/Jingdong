<?php
    $this->title = "订单确认";
    use yii\bootstrap\ActiveForm;
?>
<section id="checkout-page">
    <div class="container">
        <div class="col-xs-12 no-margin">
            <section id="shipping-address" style="margin-bottom:100px;margin-top:-10px">
                <h2 class="border h1">
                    收货地址
                </h2>
                <a href="#" id="createlink">
                    新建联系人
                </a>
                <?php 
                    foreach($addresses as $key => $address): 
                ?>
                <div class="row field-row" style="margin-top:10px">
                    <div class="col-xs-12">
                        <input class="le-radio big address" type="radio" name="address" value="<?php echo $address['id'] ?>" <?php if ($key == 0) {echo 'checked = "checked"';} ?> />
                        <a class="simple-link bold" href="#">
                            <?php 
                                echo $address['firstname'].$address['lastname']." ".$address['home']." ".$address['address']. " " . $address['postcode']. " ". $address['email']." ".$address['telephone'] 
                            ?>
                        </a>
                    </div>
                    <a style="margin-left:45px" href="<?php echo yii\helpers\Url::to(['address/del', 'id' => $address['id']]) ?>">
                        删除
                    </a>
                </div>
                <?php 
                    endforeach; 
                ?>
            </section>
            <div class="billing-address" style="display:none;">
                <h2 class="border h1">
                    新建联系人
                </h2>
                <?php 
                    ActiveForm::begin([
                        'action' => ['address/add'],    
                    ]); 
                ?>
                <div class="row field-row">
                    <div class="col-xs-12 col-sm-6">
                        <label>
                            姓*
                        </label>
                        <input class="le-input" name="firstname" >
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <label>
                            名*
                        </label>
                        <input class="le-input" name="lastname" >
                    </div>
                </div>
                <div class="row field-row">
                    <div class="col-xs-12">
                        <label>
                            家庭名称
                        </label>
                        <input class="le-input" name="home" >
                    </div>
                </div>
                <div class="row field-row">
                    <div class="col-xs-12 col-sm-6">
                        <label>
                            地址*
                        </label>
                        <input class="le-input" data-placeholder="例如：西安市高新区" name="address1" >
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <label>
                            &nbsp;
                        </label>
                        <input class="le-input" data-placeholder="例如 : 高新一路" name="address2" >
                    </div>
                </div>
                <div class="row field-row">
                    <div class="col-xs-12 col-sm-4">
                        <label>
                            邮编
                        </label>
                        <input class="le-input" name="postcode" >
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <label>
                            电子邮箱地址*
                        </label>
                        <input class="le-input" name="email" >
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <label>
                            联系电话*
                        </label>
                        <input class="le-input" name="telephone" >
                    </div>
                </div>
                <div class="place-order-button">
                    <button class="le-button small">
                        新建
                    </button>
                </div>
                <?php 
                    ActiveForm::end(); 
                ?>
            </div>
            <?php 
                ActiveForm::begin([
                    'action' => ['order/confirm'],
    				'options'=> ['id' => 'orderconfirm'],
                ]); 
            ?>
            <section id="your-order">
                <h2 class="border h1">
                    您的订单详情
                </h2>
                <?php 
                    $total = 0; 
                ?>
                <?php 
                    foreach($products as $product): 
                ?>
                <div class="row no-margin order-item">
                    <div class="col-xs-12 col-sm-1 no-margin">
                        <a href="<?php echo yii\helpers\Url::to(['product/detail', 'id' => $product['productid']]) ?>" class="qty">
                            <?php 
                                echo $product['productnumber'] 
                            ?> 
                            x
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-9 ">
                        <div class="title">
                            <a href="<?php echo yii\helpers\Url::to(['product/detail', 'id' => $product['productid']]) ?>" class="thumb-holder">
                                <img width=50 class="lazy" alt="" src="http://<?php echo $product['cover'] ?>" />
                            </a>
                            <a style="margin-left:50px;" href="<?php echo yii\helpers\Url::to(['product/detail', 'id' => $product['productid']]) ?>">
                                <?php 
                                    echo $product['title'] 
                                ?>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-2 no-margin">
                        <div class="price">
                            ￥ 
                            <?php 
                                echo $product['price'] 
                            ?>
                        </div>
                    </div>
                </div>
                <?php 
                    $total += $product['productnumber']*$product['price'] 
                ?>
                <?php 
                    endforeach; 
                ?>
            </section>
            <input type="hidden" value="<?php echo (int)\Yii::$app->request->get("id"); ?>" name="id">
            <input type="hidden" name="addressid" value>
            <div id="total-area" class="row no-margin">
                <div class="col-xs-12 col-lg-4 col-lg-offset-8 no-margin-right">
                    <div id="subtotal-holder">
                        <ul class="tabled-data inverse-bold no-border">
                            <li>
                                <label>
                                    商品总价
                                </label>
                                <div style="width:100%;text-align:right" id="total" class="value">
                                    ￥ 
                                    <span>
                                        <?php 
                                            echo $total 
                                        ?>
                                    </span>
                                </div>
                            </li>
                            <li>
                                <label>
                                    选择快递
                                </label>
                                <div style="width:100%;text-align:right" class="value">
                                    <div class="radio-group">
                                        <?php 
                                            foreach($expresses as $key=>$express): 
                                        ?>
                                        <?php 
                                            $checked = ""; if($key == 1) $checked = "checked" 
                                        ?>
                                        <input class="le-radio express" type="radio" name="expressid" value="<?php echo $key ?>" data="<?php echo $expressPrice[$key] ?>" <?php echo $checked ?>> 
                                        <div class="radio-label bold">
                                            <?php 
                                                echo $express 
                                            ?>
                                            <span class="bold"> 
                                                ￥ 
                                                <?php 
                                                    echo $expressPrice[$key] 
                                                ?>
                                            </span>
                                        </div>
                                        <br>
                                        <?php 
                                            endforeach; 
                                        ?>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul id="total-field" class="tabled-data inverse-bold ">
                            <li>
                                <label>
                                    订单总额
                                </label>
                                <div class="value" style="width:100%;text-align:right" id="ototal">
                                    ￥ 
                                    <span>
                                        <?php 
                                            echo $total + 20 
                                        ?>
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="payment-method-options">
                <div class="payment-method-option">
                    <input class="le-radio" type="radio" name="paymethod" value="alipay" checked>
                    <div class="radio-label bold ">
                        支付宝支付
                    </div>
                </div>                  
            </div>
            <div class="place-order-button">
                <button class="le-button big">
                    确认订单
                </button>
            </div>
            <?php 
                ActiveForm::end(); 
            ?>
        </div>
    </div>   
</section>
<?php
    $js = <<<JS
    $("#createlink").click(function(){
        $(".billing-address").slideDown();
    });
    var total = parseFloat($("#total span").html());
    $(".le-radio.express").click(function(){
        var ototal = parseFloat($(this).attr('data')) + total;
        $("#ototal span").html(ototal);
    });
    $("input.address").click(function(){
        var addressid = $(this).val();
        $("input[name=addressid]").val(addressid);
    });
JS;
    $this->registerJs($js);
?> 



