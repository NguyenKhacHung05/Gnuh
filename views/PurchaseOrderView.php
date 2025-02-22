<?php
class PurchaseOrderView
{
    function purchaseOrder($purchaseOrders = null)
    {
        echo '<div class="container-fluid">
        <div class="hero-section is-width-constrained" data-type="type-1">
        <header class="entry-header">
        <h3 class="page-title">Purchase Orders</h3>
        </header>
        </div>
        <div class="w-100 d-flex">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th class="order-id">Order</th>
                                    <th class="order-date">Date</th>
                                    <th class="order-status">Status</th>
                                    <th class="order-total">Total</th>
                                    <th class="order-action">Actions</th>
                                </tr>
                            </thead>
                            <tbody>';
        foreach ($purchaseOrders as $item) {
            echo '<tr class="cart-item">
                                    <td class="">
                                        <a class="link-hover fw-bold" style="font-size: 14px;" href="user/purchase/' . $item['order_id'] . '">#' . $item['order_id'] . '</a>
                                    </td>
                                    <td class="">
                                                ' . formatDate($item['order_created_at']) . '
                                    </td>
                                    <td class="">';
                                    if ($item['order_status'] == "pending") {
                                        echo '<span class="badge rounded-pill cursor-pointer warning">' . $item['order_status'] .
                                            '</span>';
                                    } elseif ($item['order_status'] == "processing") {
                                        echo '<span class="badge rounded-pill cursor-pointer blue">' . $item['order_status'] .
                                            '</span>';
                                    } elseif ($item['order_status'] == "shipped") {
                                        echo '<span class="badge rounded-pill cursor-pointer success">' . $item['order_status'] .
                                            '</span>';
                                    } elseif ($item['order_status'] == "delivered") {
                                        echo '<span class="badge rounded-pill cursor-pointer success">' . $item['order_status'] .
                                            '</span>';
                                    } elseif ($item['order_status'] == "cancelled") {
                                        echo '<span class="badge rounded-pill cursor-pointer danger">' . $item['order_status'] .
                                            '</span>';
                                    } else {
                                        echo '<div class="status-unknown">Unknown Status</div>';
                                    }
                                    echo'</td>
                                    <td class="product-total">
                                                $' . $item['total_amount'] . '
                                    </td>
                                    <td class="product-action d-flex gap-1">
                                        <a href="user/purchase/' . $item['order_id'] . '"><button class="black-btn">View</i></button></a>
                                    </td>
                                </tr>';
        }
        echo '</tbody>
                        </table>
                    </div>
                </div>
            </div>
        ';
    }

    function purchaseOrderDetail($purchaseOrderDetail = null, $order)
    {
        echo '<div class="container-fluid">
        <div class="hero-section is-width-constrained" data-type="type-1">
        <header class="entry-header">
        <h5 class="page-title">Purchase Order Detail</h5>
        <p>Order #'.$order['order_id'].' was placed on '.formatDate($order['created_at']).' and is currently '.$order['order_status'].'.</p>
        </header>
        </div>
        <div class="w-100 d-flex">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th class="product-name-thumbnail">Product Name</th>
                                    <th class="product-price">Unit Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-action">Action</th>
                                </tr>
                            </thead>
                            <tbody>';
        foreach ($purchaseOrderDetail as $item) {
            echo '<tr class="cart-item">
                                    <td class="product-thumbnail-title">
                                        <a href="shop/product/' . $item['product_id'] . '">
                                            <img src="assets/img/products/' . $item['image'] . '" alt="">
                                        </a>
                                        <a class="product-name" href="shop/product/' . $item['product_id'] . '">' . $item['name'] . '</a>
                                    </td>
                                    <td class="product-unit-price">
                                        <div class="product-price clearfix">
                                            <span class="price">
                                                <span><span class="woocommerce-Price-currencySymbol">$</span>' . $item['price'] . '</span>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        ' . $item['quantity'] . '
                                    </td>
                                    <td class="product-total">
                                        <div class="product-price clearfix">
                                            <span class="price">
                                                <span><span class="woocommerce-Price-currencySymbol">$</span>' . $item['price']*$item['quantity'] . '</span></span>
                                        </div>
                                    </td>
                                    <td class="product-action">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="button continue-shopping center" data-bs-toggle="modal" data-bs-target=".reviewProduct' . $item['product_id'] . '" onclick="reviewProduct()"><i class="bi bi-star"></i></button>
                                            <button type="button" class="button continue-shopping center"><a href=""><i class="bi bi-chat-dots"></i></a></button>
                                            <button type="button" class="button continue-shopping center"><a class="btn-add-to-cart" href="#" data-id="' . $item['product_id'] . '"><i class="bi bi-cart"></i></a></button>
                                        </div>
                                    </td>
                                </tr>';
                                $this->modalReivewProduct($item['product_id'], $item['order_detail_id']);
        }
        echo '
        <tr>
        <td colspan="3"></td>
        <td colspan="2">
            <div class="product-price clearfix">
                <span class="price">
                    <strong>
                        <span class="woocommerce-Price-currencySymbol">Total Amount: $</span>'.$purchaseOrderDetail[0]['total_amount'].'
                    </strong>
                <p class="form-text text m-0">(which includes all fees such as tax, shipping, and service charges.)</p>
            </div></td>
        </tr>
        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        ';
        echo '<script>
        function reviewProduct(){
            setTimeout(function() {
            // Lấy danh sách tất cả các sao
        const modalShow = document.querySelector(".reviewProduct.show");
        const stars = modalShow.querySelectorAll(".star");
        const ratingValue = modalShow.querySelector("#rating-value");
        
        let currentRating = 0;
        
          // Đánh dấu sao khi click
        stars.forEach(star => {
            star.addEventListener("click", () => {
            currentRating = star.getAttribute("data-value");
            ratingValue.value = currentRating;
            highlightStars(stars, currentRating);
            });
        
            // Hiệu ứng hover
        star.addEventListener("mouseover", () => {
            const hoverValue = star.getAttribute("data-value");
            highlightStars(stars, hoverValue);
        });
        
            // Khi rời chuột, quay về trạng thái đã chọn
            star.addEventListener("mouseout", () => {
                highlightStars(stars, currentRating);
            });
        });
        }, 1000); 
        function highlightStars(stars, rating) {
            stars.forEach(star => {
                star.classList.toggle("selected", star.getAttribute("data-value") <= rating);
            });
            }}
        </script>';
    }

    function modalReivewProduct($product_id, $order_detail_id)
    {
        echo '
    <!-- Modal -->
    <div class="modal fade reviewProduct reviewProduct' . $product_id . ' w-100" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog h-100">
            <div class="modal-content container my-5">
                <div class="modal-header">
                    <h5 class="modal-title">Review Product</h5>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form">
                        <form action="review" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="product_id" value="' . $product_id . '">
                        <input type="hidden" name="order_detail_id" value="' . $order_detail_id . '">
                        <input type="hidden" name="rating" id="rating-value">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <textarea class="form-control m-0"
                                            placeholder="Enter Review"
                                            rows="4" name="comment" required></textarea>
                                    </div>
                                    <div class="mb-3">
<!-- Hiển thị ngôi sao chọn -->
<div id="star-rating">
    <span class="star" data-value="1">★</span>
    <span class="star" data-value="2">★</span>
    <span class="star" data-value="3">★</span>
    <span class="star" data-value="4">★</span>
    <span class="star" data-value="5">★</span>
</div>
                                </div>
                                </div>
                                <div class="col text-end">
                                    <button type="button"
                                        class="danger-btn" data-bs-dismiss="modal"
                        aria-label="Close"> <i
                                            class="bi bi-trash3"></i>
                                        Cancel </button>
                                    <button type="submit" 
                                        class="success-btn"><i
                                            class="bi bi-file-earmark-text"></i>
                                        Submit </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    }
}
?>