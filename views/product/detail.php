<?php
    $this->title = "商品详情";
    use yii\bootstrap\ActiveForm;
?>
<div id="single-product">
    <div class="container">
        <div class="no-margin col-xs-12 col-sm-6 col-md-5 gallery-holder">
            <div class="product-item-holder size-big single-product-gallery small-gallery">
                <div id="owl-single-product">
                    <div class="single-product-gallery-item" id="slide1">
                        <a data-rel="prettyphoto" href="<?php echo $product['cover'] ?>">
                            <img class="img-responsive" alt="" src="http://<?php echo $product['cover'] ?>" />
                        </a>
                    </div>
                    <?php 
                        $i = 2 
                    ?>
                    <?php 
                        foreach((array)json_decode($product['pictures'], true) as $key=>$picture): 
                    ?>
                    <div class="single-product-gallery-item" id="slide<?php echo $i ?>">
                        <a data-rel="prettyphoto" href="<?php echo $picture ?>">
                            <img class="img-responsive" alt="" src="http://<?php echo $picture ?>" />
                        </a>
                    </div>
                    <?php 
                        $i++ 
                    ?>
                    <?php 
                        endforeach; 
                    ?>
                </div>
                <div class="single-product-gallery-thumbs gallery-thumbs">
                    <div id="owl-single-product-thumbnails">
                        <?php 
                            $i = 2 
                        ?>
                        <?php 
                            foreach((array)json_decode($product['pictures'], true) as $key=>$picture): 
                        ?>
                        <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="<?php echo $i-1 ?>" href="#slide<?php echo $i ?>">
                            <img width="67" alt="" src="http://<?php echo $picture ?>"/>
                        </a>
                        <?php 
                            $i++; 
                        ?>
                        <?php 
                            endforeach; 
                        ?>
                    </div>
                    <div class="nav-holder left hidden-xs">
                        <a class="prev-btn slider-prev" data-target="#owl-single-product-thumbnails" href="#prev"></a>
                    </div>
                    <div class="nav-holder right hidden-xs">
                        <a class="next-btn slider-next" data-target="#owl-single-product-thumbnails" href="#next"></a>
                    </div>
                </div>
            </div> 
        </div>     
        <div class="no-margin col-xs-12 col-sm-7 body-holder">
            <div class="body">
                <div style="margin-top:30px"></div>
                <div class="title">
                    <a href="#">
                        <?php 
                            echo $product['title'] 
                        ?>
                    </a>
                </div>
                <div class="availability" style="font-size:15px;margin:0;line-height:30px">
                    <label>
                        库存:
                    </label>
                    <span class="available">  
                        <?php 
                            echo $product['number'] 
                        ?>
                    </span>
                </div>
                <div class="prices">
                    <?php 
                        if ($product['issale']): 
                    ?>
                    <div class="price-current">
                        ￥
                        <?php 
                            echo $product['saleprice'] 
                        ?>
                    </div>
                    <div class="price-prev">
                        ￥
                        <?php 
                            echo $product['price'] 
                        ?>
                    </div>
                    <?php 
                        else: 
                    ?>
                    <div class="price-current">
                        ￥
                        <?php 
                            echo $product['price'] 
                        ?>
                    </div>
                    <?php 
                        endif; 
                    ?>
                </div>
                <div class="qnt-holder">
                    <?php 
                        $form = ActiveForm::begin([
                            'action' => yii\helpers\Url::to(['cart/add']),
                        ]) 
                    ?>
                    <div class="le-quantity">
                        <a class="minus" href="#reduce"></a>
                        <input name="productnumber" readonly="readonly" type="text" value="1" />
                        <a class="plus" href="#add"></a>
                    </div>
                    <input type="hidden" name="price" value="<?php echo $product['issale'] == '1'?$product['saleprice']:$product['price'] ?>">
                    <input type="hidden" name="productid" value="<?php echo $product['id'] ?>">
                    <input type='submit' id="addto-cart" class="le-button huge" value="加入购物车">
                    <?php 
                        ActiveForm::end(); 
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<section id="single-product-tab">
    <div class="container">
        <div class="tab-holder">
            <ul class="nav nav-tabs simple" >
                <li class="active">
                    <a href="#description" data-toggle="tab">
                        商品详情
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="description">
                    <p>
                        <?php 
                            echo $product['description'] 
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="recently-reviewd" class="wow fadeInUp">
	<div class="container">
		<div class="carousel-holder hover">			
			<div class="title-nav">
				<h2 class="h1">
                    所有商品
                </h2>
				<div class="nav-holder">
					<a href="#prev" data-target="#owl-recently-viewed" class="slider-prev btn-prev fa fa-angle-left"></a>
					<a href="#next" data-target="#owl-recently-viewed" class="slider-next btn-next fa fa-angle-right"></a>
				</div>
			</div>
			<div id="owl-recently-viewed" class="owl-carousel product-grid-holder">
                <?php 
                    foreach($data['products'] as $product): 
                ?>
                <div class="no-margin carousel-item product-item-holder size-small hover">
					<div class="product-item">
                        <?php 
                            if ($product->ishot): 
                        ?>
                        <div class="ribbon red">
                            <span>
                                HOT
                            </span>
                        </div> 
                        <?php 
                            endif; 
                        ?>
                        <?php 
                            if ($product->issale): 
                        ?>
                        <div class="ribbon green">
                            <span>
                                sale
                            </span>
                        </div> 
                        <?php 
                            endif; 
                        ?>
						<div class="image">
                            <img alt="" src="http://<?php echo $product->cover ?>" />
						</div>
						<div class="body">
							<div class="title">
                                <a href="<?php echo yii\helpers\Url::to(['product/detail', 'id' => $product->id]) ?>">
                                    <?php 
                                        echo $product->title 
                                    ?>
                                </a>
							</div>
						</div>
						<div class="prices">
                            <div class="price-current text-right">
                                ￥
                                <?php 
                                    echo $product->saleprice 
                                ?>
                            </div>
						</div>
						<div class="hover-area">
							<div class="add-cart-button">
                                <a href="<?php echo yii\helpers\Url::to(['cart/add', 'productid' => $product->id]) ?>" class="le-button">
                                    加入购物车
                                </a>
							</div>
						</div>
					</div>
				</div>
                <?php 
                    endforeach; 
                ?>
			</div>
		</div>
	</div>
</section>