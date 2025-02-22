<?php
class CartModel extends connect
{
    private $id;
    private $user_id;
    private $product_id;
    private $quantity;
    private $created_at;

    public function __construct()
    {
        parent::__construct();
        if (func_num_args() > 0) {
            $params = func_get_args(); // Lấy tất cả tham số dưới dạng mảng

            // Gán giá trị cho các thuộc tính của đối tượng
            $this->id = $params[0] ?? null;
            $this->user_id = $params[1] ?? null;
            $this->product_id = $params[2] ?? null;
            $this->quantity = $params[3] ?? null;
            $this->created_at = $params[4] ?? null;
        }
    }
    public function getCartsById($userId)
    {
        $sql = "SELECT * FROM cart WHERE user_id = $userId";
        $results = $this->getList($sql);
        $carts = [];
        foreach ($results as $row) {
            $cart = new CartModel($row['cart_id'], $row['user_id'], $row['product_id'], $row['quantity'], $row['created_at']);
            array_push($carts, $cart);
        }
        ;
        return $carts;
    }

    public function addToCart($userId, $productId)
    {
        // Kiểm tra sản phẩm đã tồn tại trong giỏ chưa
        $query = "SELECT * FROM cart WHERE user_id = $userId AND product_id = $productId";
        $cartItem = $this->getInstance($query);
        if ($cartItem) {
            // Nếu sản phẩm đã tồn tại, tăng số lượng
            $query = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = $userId AND product_id = $productId";
        } else {
            // Nếu sản phẩm chưa tồn tại, thêm mới
            $query = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($userId, $productId, 1)";
        }
        return $this->exec($query);
    }

    public function updateQuantity($cartId, $quantity)
    {
        // Kiểm tra xem số lượng có hợp lệ không (không âm)
        if ($quantity < 1) {
            return false; // Nếu số lượng <= 0, không cho phép cập nhật
        }

        // Cập nhật số lượng sản phẩm trong giỏ hàng
        $query = "UPDATE cart SET quantity = $quantity WHERE cart_id = $cartId";

        return $this->exec($query);
    }

    public function addOrder($userId, $totalAmount, $discountCode, $discountValue)
    {
        if ($discountCode !== null && $discountValue !== null) {
            $query = "INSERT INTO orders (user_id, total_amount, discount_code, discount_value) values ($userId, $totalAmount, $discountCode, $discountValue)";
        }else{
            $query = "INSERT INTO orders (user_id, total_amount) values ($userId, $totalAmount)";
        }
        $this->exec($query);
        $orderId = $this->db->lastInsertId();
        return $orderId;
    }
    public function addOrderDetail($orderId, $productId, $quantity, $price)
    {
        $query = "INSERT INTO order_details (order_id, product_id, quantity, price) values ($orderId, $productId, $quantity, $price)";
        return $this->exec($query);
    }

    function countRowByUserId($user_id){
        $sql = "SELECT count(*) FROM cart WHERE user_id = $user_id";
        return $this->getInstance($sql);
    }
    function delAllCartsByUserId($userId){
        $query = "DELETE FROM cart";
        $this->exec($query);
    }
    public function delCart($id)
    {
        $query = "DELETE FROM cart WHERE cart_id = '$id'";
        $this->exec($query);
    }
    public function getCartId()
    {
        return $this->id;
    }
    public function getUserId()
    {
        return $this->user_id;
    }
    public function getProductId()
    {
        return $this->product_id;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }
    public function getCreateAt()
    {
        return $this->created_at;
    }
}
?>