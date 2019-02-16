<?php
    $this->title = "商品列表";
?>
<section id="category-grid">
    <div class="container">
        <div class="col-xs-12 col-sm-3 no-margin sidebar narrow">
            <div class="widget">
                <h1>
                    商品筛选
                </h1>
                <div class="body bordered">
                    <div class="category-filter">
                        <h2>
                            品牌
                        </h2>
                        <hr>
                        <ul>
                            <li>
                                <input checked="checked" class="le-checkbox" type="checkbox"  /> 
                                <label>
                                    Samsung
                                </label> 
                                <span class="pull-right">
                                    (2)
                                </span>
                            </li>
                            <li>
                                <input  class="le-checkbox" type="checkbox" /> 
                                <label>
                                    Dell
                                </label> 
                                <span class="pull-right">
                                    (8)
                                </span>
                            </li>
                            <li>
                                <input  class="le-checkbox" type="checkbox" /> 
                                <label>
                                    Toshiba
                                </label>
                                <span class="pull-right">
                                    (1)
                                </span>
                            </li>
                            <li>
                                <input  class="le-checkbox" type="checkbox" /> 
                                <label>
                                    Apple
                                </label> 
                                <span class="pull-right">
                                    (5)
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="price-filter">
                        <h2>
                            价格
                        </h2>
                        <hr>
                        <div class="price-range-holder">
                            <input type="text" class="price-slider" value="" >
                            <span class="min-max">
                                Price: ￥89 - ￥2899
                            </span>
                            <span class="filter-button">
                                <a href="#">
                                    筛选
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget">
                <h1 class="border">
                    特价商品
                </h1>
                <ul class="product-list">
                    <?php 
                        foreach($sale as $product): 
                    ?>
                    <li>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 no-margin">
                                <a href="<?php echo yii\helpers\Url::to(['product/detail', 'id' => $product['id']]) ?>" class="thumb-holder">
                                    <img alt="" src="http://<?php echo $product['cover'] ?>" />
                                </a>
                            </div>
                            <div class="col-xs-8 col-sm-8 no-margin">
                                <a href="<?php echo yii\helpers\Url::to(['product/detail', 'id' => $product['id']]) ?>">
                                    <?php 
                                        echo $product['title'] 
                                    ?>
                                </a>
                                <div class="price">
                                    <div class="price-prev">
                                        ￥
                                        <?php 
                                            echo $product['price'] 
                                        ?>
                                    </div>
                                    <div class="price-current">
                                        ￥
                                        <?php 
                                            echo $product['saleprice'] 
                                        ?>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </li>
                    <?php 
                        endforeach; 
                    ?>
                </ul>
            </div>
            <div class="widget">
                <h1 class="border">
                    推荐商品
                </h1>
                <ul class="product-list">
                    <?php 
                        foreach($tui as $product): 
                    ?>
                    <li class="sidebar-product-list-item">
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 no-margin">
                                <a href="<?php echo yii\helpers\Url::to(['product/detail', 'id' => $product['id']]) ?>" class="thumb-holder">
                                    <img alt="" src="http://<?php echo $product['cover'] ?>" />
                                </a>
                            </div>
                            <div class="col-xs-8 col-sm-8 no-margin">
                                <a href="<?php echo yii\helpers\Url::to(['product/detail', 'id' => $product['id']]) ?>">
                                    <?php 
                                        echo $product['title'] 
                                    ?>
                                </a>
                                <div class="price">
                                    <div class="price-current">
                                        ￥
                                        <?php 
                                            echo $product['price'] 
                                        ?>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </li>
                    <?php 
                        endforeach; 
                    ?>
                </ul>
            </div>
        </div>
        <div class="col-xs-12 col-sm-9 no-margin wide sidebar">
            <section id="recommended-products" class="carousel-holder hover small">
                <div class="title-nav">
                    <h2 class="inverse">
                        热卖商品
                    </h2>
                    <div class="nav-holder">
                        <a href="#prev" data-target="#owl-recommended-products" class="slider-prev btn-prev fa fa-angle-left"></a>
                        <a href="#next" data-target="#owl-recommended-products" class="slider-next btn-next fa fa-angle-right"></a>
                    </div>
                </div>
                <div id="owl-recommended-products" class="owl-carousel product-grid-holder">
                    <?php 
                        foreach($hot as $product): 
                    ?>
                    <div class="no-margin carousel-item product-item-holder hover size-medium" style="width: 219px;">
                        <div class="product-item">
                            <div class="ribbon red">
                                <span>
                                    hot
                                </span>
                            </div> 
                            <div class="image">
                                <img alt="" src="http://<?php echo $product['cover'] ?>" />
                            </div>
                            <div class="body">
                                <div class="title">
                                    <a href="<?php echo yii\helpers\Url::to(['product/detail', 'id' => $product['id']]) ?>">
                                        <?php 
                                            echo $product['title'] 
                                        ?>
                                    </a>
                                </div>
                            </div>
                            <div class="prices">
                                <div class="price-current text-right">
                                    ￥ 
                                    <?php 
                                        echo $product['issale'] ? $product['saleprice'] :$product['price'] 
                                    ?>
                                </div>
                            </div>
                            <div class="hover-area">
                                <div class="add-cart-button">
                                    <a href="<?php echo yii\helpers\Url::to(['cart/add', 'productid' => $product['id']]) ?>" class="le-button">
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
            </section>          
            <section id="gaming">
                <div class="grid-list-products">
                    <h2 class="section-title">
                        所有商品
                    </h2>
                    <div class="control-bar" style="height:60px">                                   
                        <div class="grid-list-buttons">
                            <ul>
                                <li class="grid-list-button-item active">
                                    <a data-toggle="tab" href="#grid-view">
                                        <i class="fa fa-th-large"></i>
                                        图文
                                    </a>
                                </li>
                                <li class="grid-list-button-item ">
                                    <a data-toggle="tab" href="#list-view">
                                        <i class="fa fa-th-list"></i> 
                                        列表
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>                                           
                    <div class="tab-content">
                        <div id="grid-view" class="products-grid fade tab-pane in active">                            
                            <div class="product-grid-holder">
                                <div class="row no-margin">
                                    <?php 
                                        foreach($products as $product): 
                                    ?>
                                    <div class="col-xs-12 col-sm-4 no-margin product-item-holder hover">
                                        <div class="product-item">
                                            <?php 
                                                if ($product['ishot']): 
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
                                                if ($product['issale']): 
                                            ?>
                                            <div class="ribbon green">
                                                <span>
                                                    sale
                                                </span>
                                            </div> 
                                            <?php 
                                                endif; 
                                            ?>
                                            <?php 
                                                if ($product['istui']): 
                                            ?>
                                            <div class="ribbon blue">
                                                <span>
                                                    recommond
                                                </span>
                                            </div> 
                                            <?php 
                                                endif; 
                                            ?>
                                            <div class="image">
                                                <img alt="" src="http://<?php echo $product['cover'] ?>"  />
                                            </div>
                                            <div class="body">
                                                <?php 
                                                    if($product['issale']): 
                                                ?>
                                                <div class="label-discount green">
                                                    <?php 
                                                        echo round($product['saleprice']/$product['price']*100, 0) 
                                                    ?>
                                                    % sale
                                                </div>
                                                <?php 
                                                    endif; 
                                                ?>
                                                <div class="title">
                                                    <a href="<?php echo yii\helpers\Url::to(['product/detail', 'id' => $product['id']]) ?>">
                                                        <?php 
                                                            echo $product['title'] 
                                                        ?>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="prices">
                                                <?php 
                                                    if ($product['issale']): 
                                                ?>
                                                <div class="price-prev">
                                                    ￥
                                                    <?php 
                                                        echo $product['price'] 
                                                    ?>
                                                </div>
                                                <div class="price-current pull-right">
                                                    ￥
                                                    <?php 
                                                        echo $product['saleprice'] 
                                                    ?>
                                                </div>
                                                <?php 
                                                    else: 
                                                ?>
                                                <div class="price-current pull-right">
                                                    ￥
                                                    <?php 
                                                        echo $product['price'] 
                                                    ?>
                                                </div>
                                                <?php 
                                                    endif; 
                                                ?>
                                            </div>
                                            <div class="hover-area">
                                                <div class="add-cart-button">
                                                    <a href="<?php echo yii\helpers\Url::to(['cart/add', 'productid' => $product['id']]) ?>" class="le-button">
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
                            <div class="pagination-holder">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 text-left">
                                            <?php 
                                                echo yii\widgets\LinkPager::widget([
                                                    'pagination' => $pagination,
                                                    'prevPageLabel' => '&#8249;',
                                                    'nextPageLabel' => '&#8250;',
                                                ]); 
                                            ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="result-counter">
                                            Showing 
                                            <span>
                                                1-9
                                            </span> 
                                            of 
                                            <span>
                                                <?php 
                                                    echo $count 
                                                ?>
                                            </span> 
                                            results
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="list-view" class="products-grid fade tab-pane ">
                            <div class="products-list">
                                <?php 
                                    foreach($products as $product): 
                                ?>
                                <div class="product-item product-item-holder">
                                    <?php 
                                        if ($product['ishot']): 
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
                                        if ($product['issale']): 
                                    ?>
                                    <div class="ribbon green">
                                        <span>
                                            sale
                                        </span>
                                    </div> 
                                    <?php 
                                        endif; 
                                    ?>
                                    <?php 
                                        if ($product['istui']): 
                                    ?>
                                    <div class="ribbon blue">
                                        <span>
                                            recommond
                                        </span>
                                    </div> 
                                    <?php 
                                        endif; 
                                    ?>
                                    <div class="row">
                                        <div class="no-margin col-xs-12 col-sm-4 image-holder">
                                            <div class="image">
                                                <img alt="" src="http://<?php echo $product['cover'] ?>"  />
                                            </div>
                                        </div>
                                        <div class="no-margin col-xs-12 col-sm-5 body-holder">
                                            <div class="body">
                                                <?php 
                                                    if($product['issale']): 
                                                ?>
                                                <div class="label-discount green">
                                                    <?php 
                                                        echo round($product['saleprice']/$product['price']*100, 0) 
                                                    ?>
                                                    % sale
                                                </div>
                                                <?php 
                                                    endif; 
                                                ?>
                                                <div class="title">
                                                    <a href="<?php echo yii\helpers\Url::to(['product/detail', 'id' => $product['id']]) ?>">
                                                        <?php 
                                                            echo $product['title'] 
                                                        ?>
                                                    </a>
                                                </div>
                                                <div class="excerpt">
                                                    <p>
                                                        <?php 
                                                            echo mb_substr($product['description'], 0, 250, 'utf-8') 
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="no-margin col-xs-12 col-sm-3 price-area">
                                            <div class="right-clmn">
                                                <?php 
                                                    if($product['issale']): 
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
                                                <div class="availability">
                                                    <label>
                                                        库存:
                                                    </label>
                                                    <span class="available">  
                                                        <?php 
                                                            echo $product['number'] 
                                                        ?>
                                                    </span>
                                                </div>
                                                <a class="le-button" href="<?php echo yii\helpers\Url::to(['cart/add', 'productid' => $product['id']]) ?>">
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
                            <div class="pagination-holder">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 text-left">
                                        <ul class="pagination">
                                            <li class="current">
                                                <a  href="#">
                                                    1
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    2
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    3
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    4
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    next
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="result-counter">
                                            Showing 
                                            <span>
                                                1-9
                                            </span> 
                                            of 
                                            <span>
                                                11
                                            </span> 
                                            results
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>           
        </div>
    </div>
</section>     