<?php
class ProductView
{
    public function renderProducts($products)
    {
        foreach ($products as $p) {
            echo '<div class="single-product p-3 col-lg-3 col-md-6">
            <div class="sp-thumb"><a href="shop/product/' . $p->getProductId() . '"><img src="assets/img/products/' . ($p->getProductImage()) . '" alt="' . ($p->getProductImage()) . '"></a></div>
            <div class="pro-badge">';
            if (($p->getProductStock()) < 1) {
                echo '<p class="out-of-stock">Out of Stock</p>';
            } else {
                echo '<p class="hot">Hot</p>';
            }
            ;
            echo '
            </div>
            <div class="sp-details">
            <div class="d-flex justify-content-between"><h6>' . ($p->getProductName()) . '</h6><span class"total-sold d-flex align-items-center gap-1 text" style="font-size: 14px;">Views: <b style="font-size: 15px;">' . $p->getViews() . '</b></span></div>
                <div class="product-price d-flex justify-content-between">
                    <span class="price d-flex align-items-center gap-3 text">
                        <del><span><span class="woocommerce-Price-currencySymbol">$' . ($p->getProductPrice()) . '</span></del>
                        <div><span><span class="woocommerce-Price-currencySymbol">$' . ($p->getProductPrice()) . '</span></div>
                    </span>
                    <span class="total-sold d-flex align-items-center gap-1 text" style="font-size: 14px;">Sold:<b style="font-size: 15px;">' . $p->getSold() . '</b></span>
                </div>
                <div class="sp-details-hover d-flex justify-content-between align-items-center">
                    <a class="sp-cart btn-add-to-cart center" href="#" data-id="' . $p->getProductId() . '"><i class="bi bi-cart-plus pe-1"></i><span class="fw-bold">Add to cart</span></a>
                    <a class="sp-wishlist d-flex align-items-center justify-content-center" href="#"><i class="bi bi-heart"></i></a>
                </div>
            </div>
        </div>';
        }
    }
    public function renderProduct($p, $reviews, $related_products)
    {
        if (empty($reviews)) {
            $reviews = [
                [
                    "review_id" => 7,
                    0 => 7,
                    "product_id" => 30,
                    1 => 30,
                    "user_id" => 12,
                    2 => 12,
                    "order_detail_id" => 21,
                    3 => 21,
                    "rating" => 5,
                    4 => 5,
                    "comment" => "Fast delivery and well-packaged. Highly recommended!",
                    5 => "Fast delivery and well-packaged. Highly recommended!",
                    "created_at" => "2025-02-17 07:57:39",
                    6 => "2025-02-17 07:57:39",
                    "fullname" => "Nguyễn Khắc Hưng",
                    7 => "Nguyễn Khắc Hưng"
                ]
            ];
        }
        echo ' <section class="single-product-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div id="product-slider" class="carousel slide product-slider" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active carousel-item-left">
                                <div class="ps-img">
                                    <img src="assets/img/products/' . $p->getProductImage() . '" alt="">
                                </div>
                            </div>
                            <div class="carousel-item carousel-item-next carousel-item-left">
                                <div class="ps-img">
                                    <img src="assets/img/products/' . $p->getProductImage() . '" alt="">
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="ps-img">
                                    <img src="assets/img/products/' . $p->getProductImage() . '" alt="">
                                </div>
                            </div>
                        </div>
                        <ol class="carousel-indicators clearfix">
                            <li data-target="#product-slider" data-slide-to="0" class=""><img
                                    src="assets/img/products/' . $p->getProductImage() . '" alt=""></li>
                            <li data-target="#product-slider" data-slide-to="1" class="active"><img
                                    src="assets/img/products/' . $p->getProductImage() . '" alt=""></li>
                            <li data-target="#product-slider" data-slide-to="2" class=""><img
                                    src="assets/img/products/' . $p->getProductImage() . '" alt=""></li>
                        </ol>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="sin-product-details">
                        <h3>' . $p->getProductName() . '</h3>
                        <div class="woocommerce-product-rating">
                            <div class="star-rating center gap-1">';
        $avg_rating = 0;
        foreach ($reviews as $review) {
            $avg_rating += $review['rating'];
        }
            $avg_rating /= count($reviews);
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= floor($review['rating'])) {
                echo '<i class="bi bi-star-fill"></i>';
            } else {
                echo '<i class="bi bi-star"></i>';
            }
        }
        echo '
                            </div>
                            <a href="#" class="woocommerce-review-link" onclick="event.preventDefault();scrollToElement(`reviews`, 300)"><span class="count">' . count($reviews) . '</span> customer reviews
                            </a>
                        </div>
                        <div class="product-price clearfix">
                            <span class="price">
                                <span><span class="woocommerce-Price-currencySymbol">$' . $p->getProductPrice() . '</span></span>
                            </span>
                        </div>
                        <div class="product-cart-qty">
                            <!-- <div class="quantityd clearfix">
                                <button class="qtyBtn btnMinus"><span>-</span></button>
                                <input name="qty" value="1" title="Qty" class="input-text qty text carqty" type="text">
                                <button class="qtyBtn btnPlus">+</button>
                            </div> -->
                            <a href="#" class="add-to-cart-btn btn-add-to-cart" data-id="' . $p->getProductId() . '">Add To Cart</a>
                            <a href="#" class="Whislist"><i class="bi bi-heart-fill"></i></a>
                            <a href="#" class="compare"><i class="bi bi-share-fill"></i></a>
                        </div> 
                        <div class="pro-excerp">
                        <p>
                        <strong>Description: </strong>
                                ' . $p->getProductDescription() . '
                            </p>
                        </div>
                        <!-- <div class="product-color">
                            <h5>Color</h5>
                            <div class="color-1"></div>
                            <div class="color-2"></div>
                            <div class="color-3"></div>
                        </div>
                        <div class="product-size">
                            <h5>Size:</h5>
                            <div class="size-wrapper">
                                <div class="size-btn clearfix">
                                    <input type="radio" id="x" name="size" value="x">
                                    <label for="x">x</label>
                                </div>
                                <div class="size-btn clearfix">
                                    <input type="radio" id="xr" name="size" value="xr">
                                    <label for="xr">XR</label>
                                </div>
                                <div class="size-btn clearfix">
                                    <input checked="checked" type="radio" id="xs" name="size" value="xs">
                                    <label for="xs">xs</label>
                                </div>
                                <div class="size-btn clearfix">
                                    <input type="radio" id="xm" name="size" value="xm">
                                    <label for="xm">xm</label>
                                </div>
                            </div>
                        </div>-->
                        <!-- btn add to cart -->
                        <div class="pro-socila">
                            <a href="#"><i class="twi-facebook"></i></a>
                            <a href="#"><i class="twi-twitter-square"></i></a>
                            <a href="#"><i class="twi-pinterest-square"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="divider"></div>
                </div>
            </div>
            <div class="row">
    <div class="col-lg-8 col-md-8">
        <div class="product-tabarea">
            <ul class="nav nav-tabs productTabs" id="productTab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link" id="descriptions-tab" data-bs-toggle="tab" 
                            data-bs-target="#descriptions" type="button" role="tab" 
                            aria-controls="descriptions" aria-selected="false">
                        Description
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link active" id="reviews-tab" data-bs-toggle="tab" 
                            data-bs-target="#reviews" type="button" role="tab" 
                            aria-controls="reviews" aria-selected="true">
                        Reviews (' . count($reviews) . ')
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="productTabContent">
                <div class="tab-pane fade" id="descriptions" role="tabpanel" aria-labelledby="descriptions-tab">
                    <div class="descriptionContent">
                        <p>
                            ' . $p->getProductDescription() . '
                        </p>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                    <div class="comment-area">
                        <h4 class="comment-title">' . count($reviews) . ' Reviews to “' . $p->getProductName() . '”</h4>
                        <ol class="comment-list">
                            ';
        foreach ($reviews as $review) {
            echo '<li>
                                <div class="single-comment">
                                    <img src="assets/img/products/' . $p->getProductImage() . '" alt="">
                                    <h5 class="d-flex justify-content-between align-items-center"><a href="#">' . $review['fullname'] . '</a><span> ' . formatDate($review['created_at']) . ' </span></h5>
                                    <div class="comment">
                                        <p>' . $review['comment'] . '</p>
                                    </div>
                                    <div class="mb-3">
<!-- Hiển thị ngôi sao chọn -->
<div class="sin-product-details">
    <div class="woocommerce-product-rating">
        <div class="star-rating center gap-1">
    ';
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= floor($review['rating'])) {
                    echo '<i class="bi bi-star-fill"></i>';
                } else {
                    echo '<i class="bi bi-star"></i>';
                }
            }
            ;
            echo '
        </div>
    </div>
</div>
                                </div>
                                </div>
                            </li>';
        }
        echo '
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="product-speciality">
            <h5>Specifications</h5>
            <ul>
                <li>5.5“ screen size</li>
                <li>170 x 80 x15 cm</li>
                <li>IOS 13 pre-installed</li>
                <li>3 Cameras Installed</li>
            </ul>
        </div>
    </div>
</div>
        </div>
    </section>';
    }
    public function displayProductList($products, $total_pages, $current_page = 1, $limit = 8)
    {
        echo '<!-- Products  -->
        <section class="container">
        <div class="row">';
        $this->renderProducts($products);
        echo '</div>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-md-12 mt-20">
                    <div class="goru-pagination text-center clearfix">';
        // Hiển thị nút "Prev" nếu không phải trang đầu
        if ($current_page > 1) {
            echo '<a class="prev" href="/gnuh/shop/' . ($current_page - 1) . '/' . $limit . '"><i class="bi bi-caret-left-fill"></i></a>';
        }

        // Nếu tổng số trang <= 20, hiển thị toàn bộ
        if ($total_pages <= 20) {
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $current_page) {
                    echo '<span class="current">' . $i . '</span>';
                } else {
                    echo '<a href="/gnuh/shop/' . $i . '/' . $limit . '">' . $i . '</a>';
                }
            }
        } else {
            // Hiển thị 5 trang đầu tiên
            for ($i = 1; $i <= 5; $i++) {
                if ($i == $current_page) {
                    echo '<span class="current">' . $i . '</span>';
                } else {
                    echo '<a href="/gnuh/shop/' . $i . '/' . $limit . '">' . $i . '</a>';
                }
            }

            // Nếu trang hiện tại > 7, hiển thị "..."
            if ($current_page > 7) {
                echo '<span class="dots">...</span>';
            }

            // Hiển thị 2 trang gần trang hiện tại
            $start = max(6, $current_page - 2);
            $end = min($total_pages - 5, $current_page + 2);
            for ($i = $start; $i <= $end; $i++) {
                if ($i == $current_page) {
                    echo '<span class="current">' . $i . '</span>';
                } else {
                    echo '<a href="/gnuh/shop/' . $i . '/' . $limit . '">' . $i . '</a>';
                }
            }

            // Nếu trang hiện tại < tổng số trang - 6, hiển thị "..."
            if ($current_page < $total_pages - 6) {
                echo '<span class="dots">...</span>';
            }

            // Hiển thị 5 trang cuối
            for ($i = $total_pages - 4; $i <= $total_pages; $i++) {
                if ($i == $current_page) {
                    echo '<span class="current">' . $i . '</span>';
                } else {
                    echo '<a href="/gnuh/shop/' . $i . '/' . $limit . '">' . $i . '</a>';
                }
            }
        }

        // Hiển thị nút "Next" nếu không phải trang cuối
        if ($current_page < $total_pages) {
            echo '<a class="next" href="/gnuh/shop/' . ((int) $current_page + 1) . '/' . $limit . '"><i class="bi bi-caret-right-fill"></i></a>';
        }
        echo '</div>

                </div>
            </div>
        </div>
        </section>
        <!-- Products  -->
        ';
    }
    // Hiển thị chi tiết sản phẩm
    public function displayProductDetail($product, $reviews, $related_products = '')
    {
        $this->renderProduct($product, $reviews, $related_products);
    }
    public function displayProductPopular($products)
    {
        echo '
        <!-- Most popular  -->
        <section class="popular-section position-relative">
        <div class="sec-heading rotate-rl">Most <span>Popular</span></div>
        
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="heading-title">Most Popular</h3>
                    <div class="row mt-5 mb-3 position-relative">
                        <div class="circle-top"></div>
                        <div class="circle-bottom"></div>';
        foreach ($products as $p) {
            echo '<div class="single-product p-3 col-lg-4 col-sm-6">
                            <div class="sp-thumb"><a href="shop/product/' . $p['product_id'] . '"><img src="assets/img/products/' . $p['image'] . '" alt=""></a></div>
                            <div class="pro-badge">
                                <p class="hot">hot</p>
                            </div>
                            <div class="sp-details">
                                <div class="d-flex justify-content-between"><h6>' . $p['name'] . ' </h6><span class"total-sold d-flex align-items-center gap-1 text" style="font-size: 14px;">Views: <b style="font-size: 15px;">' . $p['views'] . '</b></span></div>
                                <div class="product-price d-flex justify-content-between">
                                    <span class="price d-flex align-items-center gap-3 text">
                                        <del><span><span class="woocommerce-Price-currencySymbol">$' . ($p['price'] - 2) . '</del>
                                        <div><span><span class="woocommerce-Price-currencySymbol">$' . $p['price'] . '</div>
                                    </span>
                                    <span class="total-sold d-flex align-items-center gap-1 text" style="font-size: 14px;">Sold:<b style="font-size: 15px;">' . $p['total_sold'] . '</b></span>
                                </div>
                                <div class="sp-details-hover d-flex justify-content-between align-items-center">
                                    <a class="sp-cart center btn-add-to-cart" href="#" data-id="' . $p['product_id'] . '"><i class="bi bi-cart-plus pe-1"></i><span
                                            class="fw-bold">Add to
                                            cart</span></a>
                                    <a class="sp-wishlist d-flex align-items-center justify-content-center" href="#"><i
                                            class="bi bi-heart"></i></a>
                                </div>
                            </div>
                        </div>';
        }
        echo '
                        
                        
                    </div>
                </div>
            </div>
        </div>
        </section>
        <!-- Most popular -->';
    }

    public function showError($message)
    {
        echo '<p class="center text"">' . $message . '</p>';
    }
}
?>