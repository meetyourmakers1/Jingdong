<?php
    $this->title = "首页";
    /*yii\bootstrap\BootstrapAsset::register($this);*/
?>
<div id="top-banner-and-menu">
    <div class="container">        
        <div class="col-xs-12 col-sm-4 col-md-3 sidemenu-holder">
            <div class="side-menu animate-dropdown">
                <div class="head">
                    <i class="fa fa-list"></i> 
                    所有分类 
                </div>        
                <nav class="yamm megamenu-horizontal" role="navigation">
                    <ul class="nav">
                        <?php
                            foreach($this->params['list'] as $top) :
                        ?>
                        <li class="dropdown menu-item">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php 
                                    echo $top['title'] 
                                ?>
                            </a>
                            <ul class="dropdown-menu mega-menu">
                                <li class="yamm-content">
                                    <div class="row">
                                        <div class="col-xs-12 col-lg-4">
                                            <ul>
                                                <?php 
                                                    foreach($top['children'] as $children): 
                                                ?>
                                                <li>
                                                    <a href="<?php echo yii\helpers\Url::to(['product/index', 'categoryid' => $children['id']]) ?>">
                                                        <?php 
                                                            echo $children['title'] 
                                                        ?>
                                                    </a>
                                                </li>
                                                <?php 
                                                    endforeach; 
                                                ?>
                                            </ul>
                                        </div>
                                        <div class="dropdown-banner-holder">
                                            <a href="#">
                                                <img alt="" src="/images/banners/banner-side.png" />
                                            </a>
                                        </div>
                                    </div>                        
                                </li>
                            </ul>
                        </li>
                        <?php
                            endforeach;
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="col-xs-12 col-sm-8 col-md-9 homebanner-holder">
            <div id="hero">
                <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                    <div class="item" style="background-image: url(/images/sliders/slider01.jpg);">
                        <div class="container-fluid">
                            <div class="caption vertical-center text-left">
                                <div class="big-text fadeInDown-1">
                                    最高优惠
                                    <span class="big">
                                        <span class="sign">
                                            ￥
                                        </span>
                                        400
                                    </span>
                                </div>
                                <div class="excerpt fadeInDown-2">
                                    潮玩生活
                                    <br>
                                    享受生活
                                    <br>
                                    引领时尚
                                </div>
                                <div class="small fadeInDown-2">
                                    最后 5 天限时抢购
                                </div>
                                <div class="button-holder fadeInDown-3">
                                    <a href="#" class="big le-button ">
                                        去购买
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>          
        </div>
    </div>
</div>
<section id="banner-holder" class="wow fadeInUp">
    <div class="container">
        <div class="col-xs-12 col-lg-6 no-margin banner">
            <a href="category-grid.html">
                <div class="banner-text theblue">
                    <h1 style="font-family:'Microsoft Yahei';">
                        尝尝鲜
                    </h1>
                    <span class="tagline">
                        查看最新分类
                    </span>
                </div>
                <img class="banner-image" alt="" src="/images/blank.gif" data-echo="/images/banners/banner-narrow-01.jpg" />
            </a>
        </div>
        <div class="col-xs-12 col-lg-6 no-margin text-right banner">
            <a href="category-grid.html">
                <div class="banner-text right">
                    <h1 style="font-family:'Microsoft Yahei';">
                        时尚流行
                    </h1>
                    <span class="tagline">
                        查看最新上架
                    </span>
                </div>
                <img class="banner-image" alt="" src="/images/blank.gif" data-echo="/images/banners/banner-narrow-02.jpg" />
            </a>
        </div>
    </div>
</section>
<div id="products-tab" class="wow fadeInUp">
    <div class="container">
        <div class="tab-holder">
            <ul class="nav nav-tabs" >
                <li class="active">
                    <a href="#featured" data-toggle="tab">
                        推荐商品
                    </a>
                </li>
                <li>
                    <a href="#new-arrivals" data-toggle="tab">
                        最新上架
                    </a>
                </li>
                <li>
                    <a href="#top-sales" data-toggle="tab">
                        最佳热卖
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="featured">
                    <div class="product-grid-holder">
                        <?php 
                            foreach ($data['tui'] as $product): 
                        ?>
                        <div class="col-sm-4 col-md-3  no-margin product-item-holder hover">
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
                                    <div class="price-prev">
                                        ￥
                                        <?php 
                                            echo $product->price 
                                        ?>
                                    </div>
                                    <div class="price-current pull-right">
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
                    <div class="loadmore-holder text-center">
                        <a class="btn-loadmore" href="#">
                            <i class="fa fa-plus"></i>
                            查看更多
                        </a>
                    </div> 
                </div>
                <div class="tab-pane" id="new-arrivals">
                    <div class="product-grid-holder">
                        <?php 
                            foreach ($data['new'] as $product): 
                        ?>
                        <div class="col-sm-4 col-md-3  no-margin product-item-holder hover">
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
                                    <div class="price-prev">
                                        ￥
                                        <?php 
                                            echo $product->price 
                                        ?>
                                    </div>
                                    <div class="price-current pull-right">
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
                    <div class="loadmore-holder text-center">
                        <a class="btn-loadmore" href="#">
                            <i class="fa fa-plus"></i>
                            查看更多
                        </a>
                    </div> 
                </div>
                <div class="tab-pane" id="top-sales">
                    <div class="product-grid-holder">
                        <?php 
                            foreach ($data['hot'] as $product): 
                        ?>
                        <div class="col-sm-4 col-md-3  no-margin product-item-holder hover">
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
                                    <div class="price-prev">
                                        ￥
                                        <?php 
                                            echo $product->price 
                                        ?>
                                    </div>
                                    <div class="price-current pull-right">
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
                    <div class="loadmore-holder text-center">
                        <a class="btn-loadmore" href="#">
                            <i class="fa fa-plus"></i>
                            查看更多
                        </a>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
<section id="bestsellers" class="color-bg wow fadeInUp">
    <div class="container">
        <h1 class="section-title">
            最新商品
        </h1>
        <div class="product-grid-holder medium">
            <div class="col-xs-12 col-md-7 no-margin">
                <div class="row no-margin">
                    <?php 
                        for ($i = 0;$i < 3;$i++): 
                    ?>
                    <?php 
                        if (empty($data['products'][$i])) continue; 
                    ?>
                    <div class="col-xs-12 col-sm-4 no-margin product-item-holder size-medium hover">
                        <div class="product-item">
                            <div class="image">
                                <img alt="" src="http://<?php echo $data['products'][$i]->cover ?>" />
                            </div>
                            <div class="body">
                                <div class="label-discount clear"></div>
                                <div class="title">
                                    <a href="<?php echo yii\helpers\Url::to(['product/detail', 'id' => $data['products'][$i]->id]); ?>">
                                        <?php 
                                            echo $data['products'][$i]->title 
                                        ?>
                                    </a>
                                </div>
                            </div>
                            <div class="prices">
                                <div class="price-current text-right">
                                    ￥
                                    <?php 
                                        echo $data['products'][$i]->saleprice 
                                    ?>
                                </div>
                            </div>
                            <div class="hover-area">
                                <div class="add-cart-button">
                                    <a href="<?php echo yii\helpers\Url::to(['cart/add', 'productid' => $data['products'][$i]->id]) ?>" class="le-button">
                                        加入购物车
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        endfor; 
                    ?>
                </div>
                <div class="row no-margin">
                    <?php 
                        for ($i = 3;$i < 6;$i++): 
                    ?>
                    <?php 
                        if (empty($data['products'][$i])) continue; 
                    ?>
                    <div class="col-xs-12 col-sm-4 no-margin product-item-holder size-medium hover">
                        <div class="product-item">
                            <div class="image">
                                <img alt="" src="http://<?php echo $data['products'][$i]->cover ?>" />
                            </div>
                            <div class="body">
                                <div class="label-discount clear"></div>
                                <div class="title">
                                    <a href="<?php echo yii\helpers\Url::to(['product/detail', 'id' => $data['products'][$i]->id]); ?>">
                                        <?php 
                                            echo $data['products'][$i]->title 
                                        ?>
                                    </a>
                                </div>
                            </div>
                            <div class="prices">
                                <div class="price-current text-right">
                                    ￥
                                    <?php 
                                        echo $data['products'][$i]->saleprice 
                                    ?>
                                </div>
                            </div>
                            <div class="hover-area">
                                <div class="add-cart-button">
                                    <a href="<?php echo yii\helpers\Url::to(['cart/add', 'productid' => $data['products'][$i]->id]) ?>" class="le-button">
                                        加入购物车
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        endfor; 
                    ?>
                </div>
            </div>
            <div class="col-xs-12 col-md-5 no-margin">
                <div class="product-item-holder size-big single-product-gallery small-gallery">
                    <?php 
                        $last = $data['products'][count($data['products'])-1];
                    ?>
                    <div id="best-seller-single-product-slider" class="single-product-slider owl-carousel">
                        <div class="single-product-gallery-item" id="slide1">
                            <a data-rel="prettyphoto" href="<?php echo $last->cover ?>">
                                <img alt="" src="http://<?php echo $last->cover ?>" />
                            </a>
                        </div>
                        <?php 
                            foreach((array)json_decode($last->pictures, true) as $key => $picture): 
                        ?>
                        <div class="single-product-gallery-item" id="slide<?php echo (int)$key+2; ?>">
                            <a data-rel="prettyphoto" href="<?php echo $picture ?>">
                                <img alt="" src="http://<?php echo $picture ?>" />
                            </a>
                        </div>
                        <?php 
                            endforeach; 
                        ?>
                    </div>
                    <div class="gallery-thumbs clearfix">
                        <ul>
                            <li>
                                <a class="horizontal-thumb active" data-target="#best-seller-single-product-slider" data-slide="0" href="<?php echo $last->cover ?>">
                                    <img alt="" src="http://<?php echo $last->cover ?>" />
                                </a>
                            </li>
                            <?php 
                                foreach ((array)json_decode($last->pictures, true) as $key => $picture): 
                            ?>
                            <li>
                                <a class="horizontal-thumb" data-target="#best-seller-single-product-slider" data-slide="<?php echo (int)$key+1; ?>" href="#slide<?php echo (int)$key+2; ?>">
                                    <img alt="" src="http://<?php echo $picture ?>" />
                                </a>
                            </li>
                            <?php 
                                endforeach; 
                            ?>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="label-discount clear"></div>
                        <div class="title">
                            <a href="<?php echo yii\helpers\Url::to(['product/detail', 'id' => $last->id]) ?>">
                                <?php 
                                    echo $last->title 
                                ?>
                            </a>
                        </div>
                    </div>
                    <div class="prices text-right">
                        <div class="price-current inline">
                            ￥
                            <?php 
                                echo $last->saleprice 
                            ?>
                        </div>
                        <a href="<?php echo yii\helpers\Url::to(['cart/add', 'productid' => $last->id]) ?>" class="le-button big inline">
                            加入购物车
                        </a>
                    </div>
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
<section id="top-brands" class="wow fadeInUp">
    <div class="container">
        <div class="carousel-holder" >
            <div class="title-nav">
                <h1>
                    热门品牌
                </h1>
                <div class="nav-holder">
                    <a href="#prev" data-target="#owl-brands" class="slider-prev btn-prev fa fa-angle-left"></a>
                    <a href="#next" data-target="#owl-brands" class="slider-next btn-next fa fa-angle-right"></a>
                </div>
            </div>
            <div id="owl-brands" class="owl-carousel brands-carousel">
                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="/images/brands/brand-01.jpg" />
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="/images/brands/brand-02.jpg" />
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="/images/brands/brand-03.jpg" />
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="/images/brands/brand-04.jpg" />
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="/images/brands/brand-01.jpg" />
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="/images/brands/brand-02.jpg" />
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="/images/brands/brand-03.jpg" />
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="#">
                        <img alt="" src="/images/brands/brand-04.jpg" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>