<?php
    $this->title = '购物车';
    use yii\bootstrap\ActiveForm;
?>
<section id="cart-page">
    <div class="container">
        <?php 
            $form = ActiveForm::begin([
                'action' => yii\helpers\Url::to(['order/add']),
            ]) 
        ?>
        <div class="col-xs-12 col-md-9 items-holder no-margin">
            <?php 
                $total = 0; 
            ?>
            <?php 
                foreach((array)$data as $key=>$cart): 
            ?>
            <input type="hidden" name="OrderDetail[<?php echo $key ?>][productid]" value="<?php echo $cart['productid'] ?>">
            <input type="hidden" name="OrderDetail[<?php echo $key ?>][price]" value="<?php echo $cart['price'] ?>">
            <input type="hidden" name="OrderDetail[<?php echo $key ?>][productnumber]" value="<?php echo $cart['productnumber'] ?>">
            <div class="row no-margin cart-item">
                <div class="col-xs-12 col-sm-2 no-margin">
                    <a href="<?php echo yii\helpers\Url::to(['product/detail', 'id' => $cart['productid']]) ?>" class="thumb-holder">
                        <img class="lazy" alt="" src="http://<?php echo $cart['cover'] ?>" />
                    </a>
                </div>
                <div class="col-xs-12 col-sm-5 ">
                    <div class="title">
                        <a href="<?php echo yii\helpers\Url::to(['product/detail', 'id' => $cart['productid']]) ?>">         
                            <?php 
                                echo $cart['title'] 
                            ?>
                        </a>
                    </div>
                </div> 
                <div class="col-xs-12 col-sm-3 no-margin">
                    <div class="quantity">
                        <div class="le-quantity">
                                <a class="minus" href="#reduce"></a>
                                <input name="productnumber" id="<?php echo $cart['id'] ?>" readonly="readonly" type="text" value="<?php echo $cart['productnumber'] ?>" />
                                <a class="plus" href="#add"></a>
                        </div>
                    </div>
                </div> 
                <div class="col-xs-12 col-sm-2 no-margin">
                    <div class="price">
                        ￥
                        <span>
                            <?php 
                                echo $cart['price'] 
                            ?>
                        </span>
                    </div>
                    <a class="close-btn" href="<?php echo yii\helpers\Url::to(['cart/del', 'id' => $cart['id']]) ?>"></a>
                </div>
            </div>
            <?php 
                $total += $cart['price']*$cart['productnumber']; 
            ?>
            <?php 
                endforeach; 
            ?>
        </div>
        <div class="col-xs-12 col-md-3 no-margin sidebar ">
            <div class="widget cart-summary">
                <h1 class="border">
                    商品购物车
                </h1>
                <div class="body">
                    <ul class="tabled-data no-border inverse-bold">
                        <li>
                            <label>
                                购物车总价
                            </label>
                            <input name="amount" id="<?php echo $total  ?>" readonly="readonly" type="text" value="<?php echo $total  ?>" />
                            <div class="value pull-right">
                                ￥ 
                                <span>
                                    <?php 
                                        echo $total 
                                    ?>
                                </span>
                            </div>
                        </li>
                    </ul>
                    <ul id="total-price" class="tabled-data inverse-bold no-border">
                        <li>
                            <label>
                                订单总价
                            </label>
                            <div class="value pull-right ordertotal">
                                ￥ 
                                <span>
                                    <?php 
                                        echo $total 
                                    ?>
                                </span>
                            </div>
                        </li>
                    </ul>
                    <div class="buttons-holder">
                        <input type='submit' class="le-button big" value="去结算">
                        <a class="simple-link block" href="<?php echo yii\helpers\Url::to(['index/index']) ?>" >
                            继续购物
                        </a>
                    </div>
                </div>
            </div>
            <div id="cupon-widget" class="widget">
                <h1 class="border">
                    使用优惠券
                </h1>
                <div class="body">
                    <form>
                        <div class="inline-input">
                            <input data-placeholder="请输入优惠券码" type="text" />
                            <button class="le-button" type="submit">
                                使用
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php 
            ActiveForm::end(); 
        ?>
    </div>
</section>
<?php
    $url = yii\helpers\Url::to(['cart/mod']);
    $js = <<<JS
                $(".minus").click(function(){
                    var id = $("input[name=productnumber]").attr('id');
                    var productnumber = parseInt($("input[name=productnumber]").val()) - 0;
                    if (parseInt($("input[name=productnumber]").val()) <= 1) {
                        var productnumber = 1;
                    }
                    var total = parseFloat($(".value.pull-right span").html());
                    var price = parseFloat($(".price span").html());
                    changeNum(id, productnumber);
                    var p = total - price;
                    if (p < 0) {
                        var p = "0";
                    }
                    $(".value.pull-right span").html(p + "");
                    $(".value.pull-right.ordertotal span").html(p + "");
                });
                $(".plus").click(function(){
                    var id = $("input[name=productnumber]").attr('id');
                    var productnumber = parseInt($("input[name=productnumber]").val()) + 0;
                    var total = parseFloat($(".value.pull-right span").html());
                    var price = parseFloat($(".price span").html());
                    changeNum(id, productnumber);
                    var p = total + price;
                    $(".value.pull-right span").html(p + "");
                    $(".value.pull-right.ordertotal span").html(p + "");
                });
                function changeNum(id, productnumber)
                {
                    $.get('$url', {'productnumber':productnumber, 'id':id}, function(data){
                        location.reload();
                    });
                }
JS;
    $this->registerJs($js);
?>