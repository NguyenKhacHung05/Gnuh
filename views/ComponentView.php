<?php 
class ComponentView{
    public function breadcrumb($route){
        echo '<section class="page-banner shop-full-banner m-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 position-relative">
                        <div class="circle-top"></div>
                        <h2 class="banner-title">' . ucwords($route) . '</h2>
                        <ol class="breadcrumb">
                            <li class="bread-crumb-item"><a href="/gnuh">Home</a></li>
                            <li class="bread-crumb-item active"><a href="/gnuh/' . $route . '">' . $route . '</a></li>
                        </ol>
                        <div class="banner-img position-absolute">
                            <img src="assets/img/banners/banner.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>';
        }

public function service()
    {
        echo '
<!-- Service -->
<section class="service-section position-relative text">
    <div class="circle-top"></div>
    <div class="container position-relative">
        <div class="circle-bottom"></div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-service">
                    <img src="assets/img/truck.png" alt="">
                    <h4>100% Free Shipping</h4>
                    <p>We ship all our products for free as long as you buying within the USA.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-service">
                    <img src="assets/img/support.png" alt="">
                    <h4>24/7 Support</h4>
                    <p>Our support team is extremely active, you will get response within 2 minutes.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-service">
                    <img src="assets/img/undo.png" alt="">
                    <h4>30 Day Return</h4>
                    <p>Our 30 day return program is open from customers, just fill up a simple form.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Service -->
';
}
public function trendingProduct()
{
    echo ' 
<!-- Trending product -->
<section class="container position-relative">
<div class="sec-heading rotate-tb">Trending<span> Products</span></div>
<h3 class="heading-title fw-bolder mt-5 text-dark">Trending Products</h3>
<p class="text sub-title">
    Explore the most popular <br> and in-demand products everyone is talking about!</p>
<div class="row">
    <div class="col-lg-7 col-md-7">
        <div class="single-trending-product">
            <div class="trend-thumb">
                <img src="assets/img/products/t1.jpg" alt="">
            </div>
            <div class="tr-pro-detail">
                <h3 class="d-flex justify-content-between align-items-center mt-3">
                    <a href="shop/product/32">TV Remove Controller</a>
                    <div class="product-price clearfix">
                        <span class="price">
                            <span><span class="woocommerce-Price-currencySymbol">$</span>112.00</span>
                        </span>
                    </div>
                </h3>
                <p>
                    A TV Remote Controller is a handheld device used to wirelessly operate a television.
                </p>
                <a class="tr-atc link" href="shop">Buy Now</a>
            </div>
        </div>
    </div>
    <div class="col-lg-5 col-md-5">
        <div class="single-trending-product">
            <div class="trend-thumb">
                <img src="assets/img/products/t2.jpg" alt="">
            </div>
            <div class="tr-pro-detail">
                <h3 class="d-flex justify-content-between align-items-center mt-3">
                    <a href="shop/product/34">Camera Lenses</a>
                    <div class="product-price clearfix">
                        <span class="price">
                            <span><span class="woocommerce-Price-currencySymbol">$</span>72.00</span>
                        </span>
                    </div>
                </h3>
                <p>
                    Camera lenses are optical devices that focus light onto a camera sensor to capture images.
                </p>
                <a class="tr-atc link" href="shop">Buy Now</a>
            </div>
        </div>
    </div>
</div>
</section>
<!-- Trending product -->';
}
public function mostPopular()
{
    echo '
<!-- Most popular  -->
<section class="popular-section position-relative">
<div class="sec-heading rotate-rl">Most <span>Popular</span></div>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="heading-title">Most Popular</h3>
            <nav class="mt-3">
                <ul class="product-tab nav gap-5">
                    <li><a class="active text" href="#" style="font-size: 16px;">All</a></li>
                    <li><a class="text" href="#" style="font-size: 16px;">Smartphones</a></li>
                    <li><a class="text" href="#" style="font-size: 16px;">Camera</a></li>
                    <li><a class="text" href="#" style="font-size: 16px;">Gadgets</a></li>
                    <li><a class="text" href="#" style="font-size: 16px;">Others</a></li>
                </ul>
            </nav>
            <div class="row mt-5 mb-3 position-relative">
                <div class="circle-top"></div>
                <div class="circle-bottom"></div>
                <div class="single-product p-3 col-lg-4 col-sm-6">
                    <div class="sp-thumb"><a href=""><img src="assets/img/products/p1.jpg" alt=""></a></div>
                    <div class="pro-badge">
                        <p class="sale">Sale</p>
                    </div>
                    <div class="sp-details">
                        <h6>Gaming Headset</h6>
                        <div class="product-price">
                            <span class="price d-flex align-items-center gap-3 text">
                                <del><span><span class="woocommerce-Price-currencySymbol">$42.00</del>
                                <div><span><span class="woocommerce-Price-currencySymbol">$38.00</div>
                            </span>
                        </div>
                        <div class="sp-details-hover d-flex justify-content-between align-items-center">
                            <a class="sp-cart center" href="#"><i class="bi bi-cart-plus pe-1"></i><span
                                    class="fw-bold">Add to
                                    cart</span></a>
                            <a class="sp-wishlist d-flex align-items-center justify-content-center" href="#"><i
                                    class="bi bi-heart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="single-product p-3 col-lg-4 col-sm-6">
                    <div class="sp-thumb"><a href=""><img src="assets/img/products/p1.jpg" alt=""></a></div>
                    <div class="pro-badge">
                        <p class="hot">Hot</p>
                    </div>
                    <div class="sp-details">
                        <h6>Gaming Headset</h6>
                        <div class="product-price">
                            <span class="price d-flex align-items-center gap-3 text">
                                <del><span><span class="woocommerce-Price-currencySymbol">$42.00</del>
                                <div><span><span class="woocommerce-Price-currencySymbol">$38.00</div>
                            </span>
                        </div>
                        <div class="sp-details-hover d-flex justify-content-between align-items-center">
                            <a class="sp-cart center" href="#"><i class="bi bi-cart-plus pe-1"></i><span
                                    class="fw-bold">Add to
                                    cart</span></a>
                            <a class="sp-wishlist d-flex align-items-center justify-content-center" href="#"><i
                                    class="bi bi-heart"></i></a>
                        </div>
                    </div>
                </div>
                <div class="single-product p-3 col-lg-4 col-sm-6">
                    <div class="sp-thumb"><a href=""><img src="assets/img/products/p1.jpg" alt=""></a></div>
                    <div class="pro-badge">
                        <p class="out-of-stock">Out of Stock</p>
                    </div>
                    <div class="sp-details">
                        <h6>Gaming Headset</h6>
                        <div class="product-price">
                            <span class="price d-flex align-items-center gap-3 text">
                                <del><span><span class="woocommerce-Price-currencySymbol">$42.00</del>
                                <div><span><span class="woocommerce-Price-currencySymbol">$38.00</div>
                            </span>
                        </div>
                        <div class="sp-details-hover d-flex justify-content-between align-items-center">
                            <a class="sp-cart center" href="#"><i class="bi bi-cart-plus pe-1"></i><span
                                    class="fw-bold">Add to
                                    cart</span></a>
                            <a class="sp-wishlist d-flex align-items-center justify-content-center" href="#"><i
                                    class="bi bi-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- Most popular -->';
}
public function deals()
{
    echo '
<!-- Deals  -->
<section class="coupone-discount-sec" id="coupone">
<div class="container position-relative">
    <!-- Section Heading -->
    <div class="sec-heading rotate-tb">Coupon <span>Deals</span></div>
    <!-- Section Heading -->
    <div class="row">
        <div class="col-lg-6 col-md-5">
            <div class="dis-product-detail">
                <h4>Weekly Deal</h4>
                <div class="product-price clearfix">
                    <span class="price">
                        <span><span class="woocommerce-Price-currencySymbol">$179.00
                        </span>
                </div>
                <div id="countdown-coupone" class="clearfix is-countdown" data-day="01" data-month="10"
                    data-year="2020"><span class="countdown-row countdown-show4"><span
                        class="countdown-section"><span class="countdown-amount" id="days">0</span><span
                        class="countdown-period">Days</span></span><span class="countdown-section"><span
                        class="countdown-amount" id="hours">0</span><span
                        class="countdown-period">Hours</span></span><span
                    class="countdown-section"><span class="countdown-amount" id="minutes">0</span><span
                    class="countdown-period">Minutes</span></span><span
                class="countdown-section"><span class="countdown-amount" id="seconds">0</span><span
                    class="countdown-period">Seconds</span></span></span></div>
                <a href="shop"><button class="btn btn1">Shop Now</button></a>
            </div>
        </div>
        <div class="col-lg-6 col-md-7">
            <div class="dis-pro-thumb">
                <img src="assets/img/deals.jpg" alt="">
            </div>
        </div>
    </div>
</div>
</section>
<!-- Deals  -->';
}
public function slideShow()
{
    echo '<!-- slideshow -->
<section class="slideshow">
<div class="list-images">
    <img class="slideshow-banner-img" src="assets/img/banners/banner-1.jpg" alt="">
    <img class="slideshow-banner-img" src="assets/img/banners/banner-2.jpg" alt="">
    <img class="slideshow-banner-img" src="assets/img/banners/banner-3.jpg" alt="">
    <img class="slideshow-banner-img" src="assets/img/banners/banner-4.jpg" alt="">
    <img class="slideshow-banner-img" src="assets/img/banners/banner-5.jpg" alt="">
    <img class="slideshow-banner-img" src="assets/img/banners/banner-6.jpg" alt="">
</div>
<div class="btn-change-img">
    <div class="btn-left"><i class="bi bi-arrow-left-short"></i></div>
    <div class="btn-right"><i class="bi bi-arrow-right-short"></i></div>
</div>
<div class="index-imgs">
    <div class="index-item active" onclick="indexImgs(0);"></div>
    <div class="index-item" onclick="indexImgs(1);"></div>
    <div class="index-item" onclick="indexImgs(2);"></div>
    <div class="index-item" onclick="indexImgs(3);"></div>
    <div class="index-item" onclick="indexImgs(4);"></div>
    <div class="index-item" onclick="indexImgs(5);"></div>
</div>
</section>
<!-- slideshow -->';
}
function displaySidebarUser($page){
    echo '
    <div class="container d-flex gap-3 mt-5">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a href="user/account/profile"><button class="nav-link d-flex justify-content-start gap-1 ';
    echo ($page == 'profile') ? 'active' : '';
    echo '"><i class="bi bi-person-circle"></i>My Account </button><a>
            <a href="user/purchase"><button class="nav-link d-flex justify-content-start gap-1 ';
    echo ($page == 'purchaseOrder') ? 'active' : '';
    echo '"><i class="bi bi-bag"></i> Purchase Order</button><a>
            <a href="user/account/logout"><button class="nav-link d-flex justify-content-start gap-1"><i class="bi bi-box-arrow-left"></i>Logout</button></a>
        </div>';
}
} ?>