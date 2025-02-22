<?php
class CartController
{
    private $cartModel;
    private $cartView;
    private $componentView;
    public function __construct()
    {
        $this->cartModel = new CartModel(); // Khởi tạo model
        $this->cartView = new CartView();   // Khởi tạo view
        $this->componentView = new ComponentView();

    }
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header('location: login');
            exit();
        };
        $this->componentView->breadcrumb('cart');
        $carts = $this->cartModel->getCartsById($_SESSION['user_id']);
        $products = [];
        $productModel = new ProductModel();
        foreach ($carts as $cart) {
            $product = $productModel->getProductById($cart->getProductId());
            array_push($products, $product);
        }
        if(count($carts)>0){
            $this->cartView->index($carts, $products);
        }else{
            $this->cartView->cartEmpty();
        }
    }
    public function addToCart()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user_id'])) {
            // Nếu chưa đăng nhập, chuyển hướng tới trang đăng nhập
            echo json_encode(['success' => false, 'message' => 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.']);
            exit; // Đảm bảo không thực hiện tiếp các mã dưới đây
        }
        // Lấy dữ liệu từ AJAX
        $data = json_decode(file_get_contents('php://input'), true);
        if (!$data) {
            echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ.']);
            exit;
        }
        $productId = $data['product_id'] ?? null;
        $userId = $_SESSION['user_id'];

        if (!$productId || !$userId) {
            echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ.']);
            return;
        }
        // Thêm vào giỏ hàng qua Model
        if ($this->cartModel->addToCart($userId, $productId)) {
            return json_encode(['success' => true, 'message' => 'Sản phẩm đã được thêm vào giỏ hàng.']);
        } else {
            return json_encode(['success' => false, 'message' => 'Thêm vào giỏ hàng thất bại.']);
        }
    }

    public function updateCart()
    {
        // Lấy dữ liệu từ AJAX
        $data = json_decode(file_get_contents('php://input'), true);
        $cartId = $data['cart_id'];
        $quantity = (int) $data['quantity'];

        $result = $this->cartModel->updateQuantity($cartId, $quantity);
        // if ($result) {
        //     // Lấy thông tin giỏ hàng để tính lại tổng tiền
        //     $cartItems = $this->cartModel->getCartsById($_POST['user_id']);
        //     $total = array_reduce($cartItems, function ($carry, $item) {
        //         return $carry + $item['price'] * $item['quantity'];
        //     }, 0);

        //     $subtotal = $result['price'] * $quantity;   

        //     echo json_encode([
        //         'success' => true,
        //         'subtotal' => number_format($subtotal, 0, ',', '.'),
        //         'total' => number_format($total, 0, ',', '.')
        //     ]);
        // } else {
        //     echo json_encode(['success' => false]);
        // }
    }
    public function delCart($id)
    {
        $this->cartModel->delCart($id);
        header('location: /gnuh/cart');
    }

    public function checkout()
    {
        if (!isset($_SESSION['user_id'])) {
            header('location: login');
            exit();
        };
        $userId = $_SESSION['user_id'];
        $carts = $this->cartModel->getCartsById($userId);
        $totalAmount = $_POST['total-amount'] ?? null;
        $discountValue = $_POST['discount-value'] ?? null;
        $discountCode = $_POST['discount-code'] ?? null;
        $orderId = $this->cartModel->addOrder($userId, $totalAmount, $discountCode, $discountValue);

        $products = new ProductModel();
        foreach($carts as $cart){
            $product = $products->getProductById($cart->getProductId());
            $this->cartModel->addOrderDetail($orderId, $cart->getProductId(), $cart->getQuantity(), $product->getProductPrice());
        }
        $this->cartModel->delAllCartsByUserId($userId);
        header('location: /gnuh/user/purchase');
    }
}
?>