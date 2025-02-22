<?php

class UserView
{
    public function index()
    {

    }

    public function breadcrumb($route)
    {
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
                        <img src="assets/img/banner.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>';
    }
    public function cart()
    {
        $this->breadcrumb(__FUNCTION__);
        echo '<section class="cart-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form class="woocommerce-cart-form" action="#">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th class="product-name-thumbnail">Product Name</th>
                                    <th class="product-price">Unit Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-remove">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="cart-item">
                                    <td class="product-thumbnail-title">
                                        <a href="#">
                                            <img src="assets/images/cart/1.jpg" alt="">
                                        </a>
                                        <a class="product-name" href="#">Wirless Headset</a> 
                                    </td>
                                    <td class="product-unit-price">
                                        <div class="product-price clearfix">
                                            <span class="price">
                                                <span><span class="woocommerce-Price-currencySymbol">$</span>79.00</span>
                                            </span>           
                                        </div>
                                    </td>
                                    <td class="product-quantity clearfix">
                                        <div class="quantityd clearfix">
                                            <button class="qtyBtn btnMinus"><span>-</span></button>
                                            <input name="qty" value="1" title="Qty" class="input-text qty text carqty" type="text">
                                            <button class="qtyBtn btnPlus">+</button>
                                        </div>
                                    </td>
                                    <td class="product-total">
                                        <div class="product-price clearfix">
                                            <span class="price">
                                                <span><span class="woocommerce-Price-currencySymbol">$</span>42.00</span>
                                            </span>           
                                        </div>
                                    </td>
                                    <td class="product-remove">
                                        <a href="#"></a>
                                    </td>
                                </tr>
                                <tr class="cart-item">
                                    <td class="product-thumbnail-title">
                                        <a href="#">
                                            <img src="assets/images/cart/2.jpg" alt="">
                                        </a>
                                        <a class="product-name" href="#">VRBOX Gaming</a> 
                                    </td>
                                    <td class="product-unit-price">
                                        <div class="product-price clearfix">
                                            <span class="price">
                                                <span><span class="woocommerce-Price-currencySymbol">$</span>142.00</span>
                                            </span>           
                                        </div>
                                    </td>
                                    <td class="product-quantity clearfix">
                                        <div class="quantityd clearfix">
                                            <button class="qtyBtn btnMinus"><span>-</span></button>
                                            <input name="qty" value="1" title="Qty" class="input-text qty text carqty" type="text">
                                            <button class="qtyBtn btnPlus">+</button>
                                        </div>
                                    </td>
                                    <td class="product-total">
                                        <div class="product-price clearfix">
                                            <span class="price">
                                                <span><span class="woocommerce-Price-currencySymbol">$</span>42.00</span>
                                            </span>           
                                        </div>
                                    </td>
                                    <td class="product-remove">
                                        <a href="#"></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="actions">
                                        <button type="submit" class="button clear-cart">Clear Shopping Cart</button>
                                        <button type="submit" class="button update">Update Shopping Cart</button>
                                        <button type="submit" class="btn2 continue-shopping">Continue Shopping</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="coupon">
                                    <h3>Counpon discount</h3>
                                    <p>
                                        Enter your code if you have one. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                                    </p>
                                    <input type="text" name="coupon_code" placeholder="Enter Your code Here"> 
                                    <button type="submit" class="btn2" name="apply_coupon">Apply coupon</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="cart-totals">
                                    <h2>Cart Totals</h2>
                                    <table class="shop-table">
                                        <tbody>
                                            <tr class="cart-subtotal">
                                                <th>Sub Total</th>
                                                <td data-title="Subtotal">
                                                    <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>42.00</span>
                                                </td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Grand Total</th>
                                                <td data-title="Subtotal">
                                                    <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>48.00</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="wc-proceed-to-checkout">
    <button class="btn2 w-100"><a href="/gnuh/checkout" class="checkout-button">Proceed to checkout</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>';
    }
    public function shop()
    {
        $this->breadcrumb(__FUNCTION__);
        echo '
<!-- Products  -->
<section class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="product-cate">
                <h5>Categories</h5>
                <ul>
                    <li><a class="active" href="#">All</a></li>
                    <li><a href="#">Smartphones</a></li>
                    <li><a href="#">Computers</a></li>
                    <li><a href="#">Cameras</a></li>
                    <li><a href="#">On Sale</a></li>
                    <li><a href="#">Others</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-5">
            <div class="sort-view">
                <a class="view-mode active" href="#"><i class="bi bi-grid-3x3-gap-fill"></i></a>
                <a class="view-mode" href="#"><i class="bi bi-list"></i></a>
                <div class="sorts">
                    <select name="sort">
                        <option value="">Default Sorting</option>
                        <option selected="selected" value="">low to high</option>
                        <option value="">high to low</option>
                        <option value="">Best Seller</option>
                        <option value="">Popular Products</option>
                    </select>
                    <i class="bi bi-chevron-down"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
';

        $prod = new ProductController();
        $prod->getProducts();
        for ($i = 0; $i < 5; $i++) {
            echo '
        <div class="single-product p-3 col-lg-3 col-md-6">
            <div class="sp-thumb"><a href=""><img src="assets/img/p1.jpg" alt=""></a></div>
            <div class="pro-badge">
                <p class="out-of-stock">Out of Stock</p>
            </div>
            <div class="sp-details">
                <h6>Gaming Headset</h6>
                <div class="product-price">
                    <span class="price d-flex align-items-center gap-3 text">
                        <del><span><span class="woocommerce-Price-currencySymbol">$42.00</span></del>
                        <div><span><span class="woocommerce-Price-currencySymbol">$38.00</span></div>
                    </span>
                </div>
                <div class="sp-details-hover d-flex justify-content-between align-items-center">
                    <a class="sp-cart center" href="#"><i class="bi bi-cart-plus pe-1"></i><span class="fw-bold">Add to cart</span></a>
                    <a class="sp-wishlist d-flex align-items-center justify-content-center" href="#"><i class="bi bi-heart"></i></a>
                </div>
            </div>
        </div>
    ';
        }
        echo '
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-md-12 mt-20">
                <div class="goru-pagination text-center clearfix">
                    <a class="prev" href="#"><i class="bi bi-caret-left-fill"></i></a>
                    <span class="current">1</span>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a class="next" href="#"><i class="bi bi-caret-right-fill"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Products  -->
';
    }
    public function login()
    {
        $this->breadcrumb(__FUNCTION__);
        echo '<!-- Login -->
    <section class="login-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <h3 class="sec-title">Login your account</h3>
                    <p class="sec-desc">
                        Login to your account to discovery all great features in this item
                    </p>
                    <div class="login-form">
                        <form action="#" method="post">
                            <input type="text" name="name" placeholder="User Name">
                            <input type="password" name="password" placeholder="Your Password">
                            <div class="keep-log-regi">
                                <input type="radio" id="login" name="login" value="keep-login">
                                <label for="login">Keep me logged in</label>   
                            </div>
                            <a href="#">Forgot your password?</a>
                            <div>
                                <button type="submit" class="btn2" name="submit" value="login">login</button>
                            </div>
                        </form>
                    </div>
                    <div class="social-log-regi">
                        <h5>OR LOGIN WITH</h5>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-google"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <h3 class="sec-title">Register account now</h3>
                    <p class="sec-desc">
                        Pellentesque habitant morbi tristique senectus et netus et
                    </p>
                    <div class="register-form">
                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="full-name" placeholder="Your Name">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="name" placeholder="User Name">
                                </div>
                                <div class="col-lg-6">
                                    <input type="number" name="phone" placeholder="Phone">
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" name="email" placeholder="Email">
                                </div>
                                <div class="col-lg-6">
                                    <input type="password" name="password" placeholder="Password">
                                </div>
                                <div class="col-lg-6">
                                    <input type="password" name="retype-password" placeholder="Re Password">
                                </div>
                            </div>
                            <div class="keep-log-regi">
                                <input type="radio" id="register" name="register" value="keep-register">
                                <label for="register">
                                    I accept the terms and conditions, including the Privacy Policy
                                </label>   
                            </div>
                            <div>
                                <button type="submit" class="btn2" name="submit" value="register">register</button>
                            </div>
                        </form>
                    </div>
                    <div class="social-log-regi">
                        <h5>OR Register WITH</h5>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-google"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login -->';
    }
}
?>