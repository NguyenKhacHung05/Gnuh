<?php
ob_start();
session_start();
include_once 'include.php';
include_once 'function.php';
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_me'])) {
    $userModel = new AuthModel();
    $user = $userModel->getUserByToken($_COOKIE['remember_me']);
    if ($user) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
    }
}
if (isset($_SESSION['user_id'])) {
    $cartModel = new CartModel();
    $total_cart = $cartModel->countRowByUserId($_SESSION['user_id'])[0];
}
if (isset($_POST['keyword'])) {
    $_SESSION['keyword'] = $_POST['keyword'];
}
if (isset($_POST['sort'])) {
    $_SESSION['sort'] = $_POST['sort'];
}
$route = str_replace('/gnuh/', '', $_SERVER['REQUEST_URI']);
$route = trim($route, '/');
$route = explode('/', $route);
if (isset($route[0])) {
    $route = $route[0];
} else {
    $route = 'home';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/gnuh/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $route == '' ? 'Home' : ucfirst($route) ?></title>
    <link rel="stylesheet" href="assets/bootstrap-5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/keyframes.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/css/style.css" />
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- icon -->
    <!-- font chữ -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="assets/img/Gnuh.png" sizes="64x64">
</head>

<body>
    <!-- header -->
    <header class="header">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-lg-2 col-md-2">
                    <div class="logo col row-cols-2">
                        <a href="/gnuh"><span class="brain fs-1">G</span><span class=" fs-3">nuh</span></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav>
                        <ul class="nav gap-3">
                            <li class="nav-item">
                                <a class="nav-link <?php echo $route == '' ? 'active' : '' ?>" href="">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $route == 'shop' ? 'active' : '' ?>" href="shop">SHOP</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $route == 'about' ? 'active' : '' ?>"
                                    href="about">ABOUT</a>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $route == 'contact' ? 'active' : '' ?>"
                                    href="contact">CONTACT</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="header-cogs">
                        <ul class="nav justify-content-end">
                            <li class="nav-item position-relative">
                                <form class="search-form position-relative center" action="shop/search" method="post">
                                    <input type="text" class="search-input" placeholder="Search..." name="keyword"
                                        value="<?php if (isset($_SESSION['keyword']))
                                            echo $_SESSION['keyword']; ?>">
                                    <?php if (isset($_SESSION['keyword']))
                                        echo '<a href="shop/clearKeyword" class="nav-link close"><i class="bi bi-x center"></i></a>'; ?>
                                    <button type="submit" class="nav-link search center"><i
                                            class="bi bi-search center"></i></button>
                                </form>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link select-currency" href="#"><i
                                        class="bi bi-currency-dollar"></i>USD</a>
                            </li>
                            <li class="nav-item cursor-pointer">
                                <?php if (!isset($_SESSION['user_id'])) { ?>
                                    <a class="nav-link user-login" href="login">
                                        <i class="bi bi-person-circle pe-1"></i><?= 'ACCOUNT'; ?>
                                    </a>
                                <?php } else { ?>
                                    <a class="nav-link user-login <?php echo $route == 'user' ? 'active' : '' ?><?php echo $route == 'admin' ? 'active' : '' ?>"
                                        data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom"
                                        data-bs-content="">
                                        <i class="bi bi-person-circle pe-1"></i><?= mb_strtoupper($_SESSION['username']); ?>
                                    </a>
                                <?php } ?>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link carts <?php echo $route == 'cart' ? 'active' : '' ?>" href="cart"><i
                                        class="bi bi-cart position-relative">
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill <?php echo $route == 'cart' ? 'bg-primary' : 'bg-dark' ?>"
                                            style="font-size: 10px;"><?php echo isset($total_cart) ? $total_cart : '·' ?></span>
                                    </i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <script>

    </script>
    <div class="boxAlert">
    </div>
    <!-- show alert  -->
    <script>
        function showAlert(type, alertMessage) {
            let boxAlert = document.querySelector(".boxAlert");
            let alertType = ""; // Khai báo biến alertType

            // Xác định loại alert
            switch (type) {
                case "success":
                    alertType = "alert-success";
                    break;
                case "error":
                    alertType = "alert-danger";
                    break;
                case "warning":
                    alertType = "alert-warning";
                    break;
                default:
                    console.error("Loại alert không hợp lệ!");
                    return; // Dừng function nếu type không hợp lệ
            }

            // Tạo alert mới
            let alertDiv = document.createElement("div");
            alertDiv.className = `alert ${alertType} alert-dismissible fade show`;
            alertDiv.setAttribute("role", "alert");
            alertDiv.innerHTML = `
        ${alertMessage}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;

            // Thêm vào boxAlert
            boxAlert.appendChild(alertDiv);

            // Xóa alert sau 5 giây
            setTimeout(() => {
                alertDiv.classList.remove("show");
                alertDiv.classList.add("fade");
                setTimeout(() => {
                    alertDiv.remove(); // Xóa khỏi DOM
                }, 500); // Chờ hiệu ứng fade hoàn tất
            }, 5000);

            // Xóa khi ấn nút close
            alertDiv.querySelector(".btn-close").addEventListener("click", function () {
                alertDiv.remove();
            });
        }
    </script>
    <main>
        <?php include_once 'main.php' ?>
    </main>
    <div id="btnScrollToTop" hidden><i class="bi bi-chevron-double-up" style="font-size: 16px;"></i>
    </div>
    <footer>
        <div class="w-100 border-top border-secondary border-2 p-2">
            <div class="container d-flex justify-content-sm-between justify-content-center align-items-center">
                <div class=bold">HwCoder © 2025. All rights reserved.</div>
                <div>
                    <ul class="justify-content-center align-items-center d-none d-sm-flex text-secondary">
                        <li>Follow us: </li>
                        <li class="mx-1"><a href=""><i class="p-1 bi bi-facebook"></i></a></li>
                        <li class="mx-1"><a href=""><i class="p-1 bi bi-instagram"></i></a></li>
                        <li class="mx-1"><a href=""><i class="p-1 bi bi-linkedin"></i></a></li>
                        <li class="mx-1"><a href=""><i class="p-1 bi bi-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- //Add to cart -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Lắng nghe sự kiện click trên tất cả nút "Add to cart"
            document.querySelectorAll('.btn-add-to-cart').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault(); // Ngăn chặn tải lại trang
                    <?php $_SESSION['success'] = "Add product successfully!" ?>
                    const productId = this.getAttribute('data-id'); // Lấy ID sản phẩm

                    // Gửi yêu cầu AJAX bằng Fetch API
                    fetch('cart/addtocart', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ product_id: productId })
                    })
                        .then(response => response.text()) // Lấy dữ liệu dạng text trước
                        .then(data => {
                            try {
                                const jsonData = JSON.parse(data);  // Thử chuyển đổi JSON

                                if (jsonData.success) {
                                    showAlert('success', 'Add product successfully!');
                                } else {
                                    showAlert('error', 'Add product error!');

                                    // Nếu server trả về lỗi yêu cầu đăng nhập
                                    if (jsonData.message && jsonData.message.includes('Bạn cần đăng nhập')) {
                                        setTimeout(() => {
                                            window.location.href = 'login'; // Chuyển hướng đăng nhập
                                        }, 1500);
                                    }
                                }
                            } catch (error) {
                                // Nếu phản hồi không phải JSON hợp lệ
                                console.warn('Error parsing JSON:', error);
                                // showAlert('warning', 'Sản phẩm đã được thêm vào giỏ hàng!');
                            }
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                            showAlert('error', 'Lỗi kết nối đến server!');

                            // Nếu lỗi có thể do chưa đăng nhập, chuyển hướng đăng nhập sau 1.5s
                            setTimeout(() => {
                                window.location.href = 'login';
                            }, 1500);
                        });
                });
            });
        });

    </script>
    <!-- update quantity  -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const updateCart = (cartId, quantity) => {
                fetch('cart/update', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ cart_id: cartId, quantity: quantity })
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('HTTP error! Status: ' + response.status);
                        }
                        return response.json(); // Chỉ phân tích JSON nếu phản hồi là JSON
                    })
                    .then(data => {
                        if (data.success) {
                            // const row = document.querySelector(`tr[data-cart-id="${cartId}"]`);
                            // row.querySelector('.subtotal').textContent = data.subtotal;
                            // document.getElementById('total').textContent = data.total;
                            // console.log('update success')
                        } else {
                            alert('Cập nhật thất bại!');
                        }
                    })
                    .catch(error => {
                        console.error('Có lỗi xảy ra:', error.message);
                    });
            };

            document.querySelectorAll('.btnMinus').forEach(button => {
                button.addEventListener('click', function () {
                    const row = this.closest('tr');
                    const cartId = row.dataset.cartId;
                    const input = row.querySelector('.carqty');
                    let quantity = parseInt(input.value, 10);
                    if (quantity > 1) {
                        quantity -= 1;
                        input.value = quantity;
                        updateCart(cartId, quantity);
                    }
                    const productPrice = row.querySelector('.product-unit-price .woocommerce-Price-currencySymbol').innerHTML.slice(1);
                    const productTotal = row.querySelector('.product-total .woocommerce-Price-currencySymbol');
                    productTotal.innerHTML = formatCurrency(productPrice * quantity);

                    // subTotal
                    const productTotals = document.querySelectorAll('.product-total .woocommerce-Price-currencySymbol');
                    let subTotalPrice = 0;
                    productTotals.forEach(priceElement => {
                        let priceString = priceElement.innerHTML;
                        priceString = priceString.replace(/[^\d.-]/g, ''); // Loại bỏ ký hiệu và dấu phẩy
                        subTotalPrice += parseFloat(priceString); // Cộng vào subTotalPrice
                    })
                    const subTotal = document.querySelector('.cart-subtotal .woocommerce-Price-currencySymbol');
                    subTotal.innerHTML = formatCurrency(subTotalPrice);
                    // subTotal

                    // Grand Total
                    const taxRate = 0.1; // Thuế 10%
                    const shippingFee = 5; // Phí vận chuyển

                    const tax = subTotalPrice * taxRate; // Tính thuế
                    const totalAmount = subTotalPrice + tax + shippingFee; // Tính tổng cuối cùng
                    const orderTotals = document.querySelector('.order-total .woocommerce-Price-currencySymbol');
                    orderTotals.innerHTML = formatCurrency(totalAmount);
                    // Grand Total

                });
            });

            document.querySelectorAll('.btnPlus').forEach(button => {
                button.addEventListener('click', function () {
                    const row = this.closest('tr');
                    const cartId = row.dataset.cartId;
                    const input = row.querySelector('.carqty');
                    let quantity = parseInt(input.value, 10);
                    quantity += 1;
                    input.value = quantity;
                    updateCart(cartId, quantity);
                    const productPrice = row.querySelector('.product-unit-price .woocommerce-Price-currencySymbol').innerHTML.slice(1);
                    const productTotal = row.querySelector('.product-total .woocommerce-Price-currencySymbol');
                    productTotal.innerHTML = formatCurrency(productPrice * quantity);

                    // subTotal
                    const productTotals = document.querySelectorAll('.product-total .woocommerce-Price-currencySymbol');
                    let subTotalPrice = 0;
                    productTotals.forEach(priceElement => {
                        let priceString = priceElement.innerHTML;
                        priceString = priceString.replace(/[^\d.-]/g, ''); // Loại bỏ ký hiệu và dấu phẩy
                        subTotalPrice += parseFloat(priceString); // Cộng vào subTotalPrice
                    })
                    const subTotal = document.querySelector('.cart-subtotal .woocommerce-Price-currencySymbol');
                    subTotal.innerHTML = formatCurrency(subTotalPrice);
                    // subTotal

                    // Grand Total
                    const taxRate = 0.1; // Thuế 10%
                    const shippingFee = 5; // Phí vận chuyển

                    const tax = subTotalPrice * taxRate; // Tính thuế
                    const totalAmount = subTotalPrice + tax + shippingFee; // Tính tổng cuối cùng
                    const orderTotals = document.querySelector('.order-total .woocommerce-Price-currencySymbol');
                    orderTotals.innerHTML = formatCurrency(totalAmount);
                    // Grand Total
                });
            });


            function formatCurrency(amount, currency = 'USD') {
                return new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: currency
                }).format(amount);
            }



            const cartTable = document.getElementById('cart');
            const totalPriceElement = document.getElementById('total-price');

            // Hàm cập nhật tổng giá
            const updateTotalPrice = () => {
                let total = 0;
                cartTable.querySelectorAll('tr').forEach(row => {
                    const quantity = parseInt(row.querySelector('.qtyInput').value, 10);
                    const price = parseFloat(row.dataset.price);
                    const subtotal = quantity * price;

                    // Cập nhật cột tổng của mỗi sản phẩm
                    row.querySelector('.subtotal').textContent = subtotal.toLocaleString();

                    // Cộng vào tổng giá
                    total += subtotal;
                });

                // Cập nhật tổng cộng
                totalPriceElement.textContent = total.toLocaleString();
            };
            // Gắn sự kiện khi người dùng nhập trực tiếp vào ô số lượng
            if (cartTable) {
                cartTable.addEventListener('input', function (event) {
                    if (event.target.classList.contains('qtyInput')) {
                        let quantity = parseInt(event.target.value, 10);

                        // Đảm bảo số lượng không nhỏ hơn 1
                        if (isNaN(quantity) || quantity < 1) {
                            event.target.value = 1;
                            quantity = 1;
                        }

                        // Cập nhật tổng giá
                        updateTotalPrice();
                    }
                });
            }
            // Tính tổng giá khi trang được tải
            updateTotalPrice();
        });
    </script>

    <script src="assets/bootstrap-5.3.3/dist/js/bootstrap.bundle.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        const popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    </script>
    <script>
        const button = document.querySelector('[data-bs-toggle="popover"]');
        new bootstrap.Popover(button, {
            content: '<a class="user-link" href="user/account/profile">My Profile</a> <a class="user-link" href="user/purchase">Purchase Orders</a><?php if ($_SESSION['role'] == 'admin')
                echo '<a class="user-link" href="admin">Admin</a>'; ?><a class="user-link" href="user/account/logout">Log Out</a>',
            html: true
        });
    </script>
    <script>
        // Hàm cuộn mượt tới phần tử theo id
        function scrollToElement(targetId, offset = 0) {
            const target = document.getElementById(targetId);
            if (target) {
                const position = target.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({
                    top: position,
                    behavior: 'smooth'
                });
            } else {
                console.error(`Không tìm thấy phần tử có id: ${targetId}`);
            }
        }
    </script>
</body>

</html>