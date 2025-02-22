<?php
class CartView
{
    public function index($carts, $products, $subTotal = 0)
    {
        echo '<section class="cart-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                        <!-- <form class="woocommerce-cart-form" action="#"> -->
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
                                ';
        // Duyệt qua mảng CartModel
        foreach ($carts as $cart) {
            // Lấy product_id từ cart
            $productId = $cart->getProductId();

            // Tìm sản phẩm tương ứng trong mảng ProductModel
            foreach ($products as $product) {
                if ($product->getProductId() == $productId) {
                    // Nếu tìm thấy sản phẩm, hiển thị thông tin
                    echo '<tr class="cart-item" data-cart-id="' . $cart->getCartId() . '">
                                    <td class="product-thumbnail-title">
                                        <a href="shop/product/' . $cart->getProductId() . '">
                                            <img src="assets/img/products/' . $product->getProductImage() . '" alt="">
                                        </a>
                                        <a class="product-name" href="shop/product/' . $cart->getProductId() . '">' . $product->getProductName() . '</a> 
                                    </td>
                                    <td class="product-unit-price">
                                        <div class="product-price clearfix">
                                            <span class="price">
                                                <span><span class="woocommerce-Price-currencySymbol">$' . $product->getProductPrice() . '</span></span>
                                            </span>           
                                        </div>
                                    </td>
                                    <td class="product-quantity clearfix">
                                        <div class="quantityd clearfix">
                                            <button class="qtyBtn btnMinus"><span>-</span></button>
                                            <input class="carqty" name="qty" value="' . $cart->getQuantity() . '" title="Qty" class="input-text qty text carqty" type="text">
                                            <button class="qtyBtn btnPlus">+</button>
                                        </div>
                                    </td>
                                    <td class="product-total">
                                        <div class="product-price clearfix">
                                            <span class="price">
                                                <span><span class="woocommerce-Price-currencySymbol">$' . $product->getProductPrice() * $cart->getQuantity() . '</span></span>  
                                            </span>           
                                        </div>
                                    </td>
                                    <td class="product-remove">
                                        <a  href="cart/del/' . $cart->getCartId() . '"></a>
                                    </td>
                                </tr>';
                    $subTotal += $product->getProductPrice() * $cart->getQuantity();
                    break;
                }
            }
        }

        echo '</tbody>
                        </table>
                        <div class="row mt-5">
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
                                                    <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$' . $subTotal . '</span></span>
                                                </td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Grand Total</th>
                                                <td data-title="Subtotal">
                                                    <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">';
        $taxRate = 0.1; // Thuế 10%
        $shippingFee = 5; // Phí vận chuyển (USD)

        // Tính thuế
        $tax = $subTotal * $taxRate;

        // Tính tổng cuối cùng
        $totalAmount = $subTotal + $tax + $shippingFee;

        // Định dạng số tiền với dấu phân cách hàng nghìn và đơn vị USD
        echo "$" . number_format($totalAmount, 2, '.', ',');

        echo '</span></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="wc-proceed-to-checkout">
                                    <form action="cart/checkout" method="post">
                                        <input type="number" name="total-amount" value="'.$totalAmount.'" hidden>
                                        <button class="btn2 w-100"><a class="checkout-button">Proceed to checkout</a></button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    ';
    }

    function cartEmpty(){
        echo '<section class="cart-section">
        <div class="empty-cart"><img src="assets/img/shoppingcart.png">
        <p class="text-center pt-5 fs-5">
You haven\'t added any products to your cart yet!</p>
        
        <a href="shop"><button class="btn1">Shop Now</button></a>
            </div>
            </section>
            ';
    }
}
?>