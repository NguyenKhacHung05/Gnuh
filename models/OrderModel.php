<?php class OrderModel extends connect
{
    private $order_id;
    private $user_id;
    private $total_amount;
    private $order_status;
    private $created_at;
    private $updated_at;
    private $discount_value;
    private $discount_code;

    public function __construct()
    {
        parent::__construct();
        if (func_num_args() > 0) {
            $params = func_get_args(); // Lấy tất cả tham số dưới dạng mảng

            // Gán giá trị cho các thuộc tính của đối tượng
            $this->order_id = $params[0] ?? null;
            $this->user_id = $params[1] ?? null;
            $this->total_amount = $params[2] ?? null;
            $this->order_status = $params[3] ?? null;
            $this->created_at = $params[4] ?? null;
            $this->updated_at = $params[5] ?? null;
            $this->discount_value = $params[6] ?? null;
            $this->discount_code = $params[7] ?? null;
        }
    }
    public function getAllOrders()
    {
        $sql = "SELECT * FROM orders";
        $result = $this->getlist($sql);
        $orders = [];
        if ($result) {
            foreach ($result as $row) {
                $order = new OrderModel($row['order_id'], $row['user_id'], $row['total_amount'], $row['order_status'], $row['created_at'], $row['updated_at'], $row['discount_value'], $row['discount_code']);
                array_push($orders, $order);
            }
            return $orders;
        }
    }

    function getOrdersByPageAdmin($limit, $offset)
    {
        $sql = "SELECT o.order_id, created_at as order_created_at, o.order_status, o.total_amount FROM orders o
        ORDER BY FIELD(o.order_status, 'pending','processing','shipped','delivered','cancelled'), order_created_at LIMIT $limit OFFSET $offset";
        return $this->getList($sql);
        }

    function getOrderDetailsByOrderId($order_id){
        $sql = "SELECT od.*, o.total_amount, o.order_status, o.created_at, o.discount_value, u.fullname as user_name, u.email, u.phone, u.address, p.name as product_name, p.price as product_price FROM order_details od
        JOIN products p ON p.product_id = od.product_id
        JOIN orders o ON o.order_id = od.order_id
        JOIN users u ON u.user_id = o.user_id
        WHERE od.order_id = $order_id
        ORDER BY FIELD(o.order_status, 'pending','processing','shipped','delivered','cancelled'), o.created_at";
        $result = $this->getList($sql);
        return $result;
    }
    function searchOrderAdmin($field, $keyword, $limit, $offset)
    {
        $sql = "SELECT o.order_id, created_at as order_created_at, o.order_status, o.total_amount FROM orders o
        WHERE $field like '%$keyword%' ORDER BY FIELD(o.order_status, 'pending','processing','shipped','delivered','cancelled'), order_created_at LIMIT $limit OFFSET $offset";
        $result = $this->getList($sql);
        return $result;
    }

    function countOrdersByUserId($id)
    {
        $sql = "SELECT count(*) FROM orders WHERE user_id = $id";
        return $this->getInstance($sql);
    }
    // 🟡 Lấy danh sách trạng thái từ ENUM
    public function getStatusOptions() {
        $sql = "SHOW COLUMNS FROM orders LIKE 'order_status'";
        $row = $this->getInstance($sql);
        // Lấy nội dung ENUM: enum('pending','processing','shipped','completed','cancelled')
        preg_match("/^enum\((.*)\)$/", $row['Type'], $matches);
        $enum = str_getcsv($matches[1], ",", "'");
        return $enum; // Trả về mảng ['pending','processing','shipped','completed','cancelled']
    }

    public function changeStatus($order_id, $order_status){
        $sql = "UPDATE `orders` SET `order_status` = '$order_status' WHERE `orders`.`order_id` = $order_id";
        $this->exec($sql);
    }

    function getRow()
    {
        $sql = "SELECT COUNT(*) FROM orders";
        return $this->getInstance($sql);
    }

    function getOrderId()
    {
        return $this->order_id;
    }
    function getUserId()
    {
        return $this->user_id;
    }
    function getTotalAmount()
    {
        return $this->total_amount;
    }
    function getOrderStatus()
    {
        return $this->order_status;
    }
    function getCreatedAt()
    {
        return $this->created_at;
    }
    function getUpdatedAt()
    {
        return $this->updated_at;
    }
    function getDiscountValue()
    {
        return $this->discount_value;
    }
    function getDiscountCode()
    {
        return $this->discount_code;
    }
} ?>