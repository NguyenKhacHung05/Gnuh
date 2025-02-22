<?php
class PurchaseOrderModel extends connect
{
    private $user_id;
    private $order_id;
    private $product_name;
    private $product_image;
    private $unit_price;
    private $quantity;
    private $total_price;
    public function __construct()
    {
        parent::__construct();
        if (func_num_args() > 0) {
            $params = func_get_args(); // Lấy tất cả tham số dưới dạng mảng

            // Gán giá trị cho các thuộc tính của đối tượng
            $this->user_id = $params[0] ?? null;
            $this->order_id = $params[1] ?? null;
            $this->product_name = $params[2] ?? null;
            $this->product_image = $params[3] ?? null;
            $this->unit_price = $params[4] ?? null;
            $this->quantity = $params[5] ?? null;
            $this->total_price = $params[6] ?? null;
        }
    }
    function getAllPurchaseOrder($userId)
    {
        $sql = "SELECT 
                    o.order_id,
                    o.total_amount,
                    p.product_id,
                    p.name,
                    p.image,
                    p.price,
                    od.quantity,
                    od.order_detail_id
                FROM 
                    orders o
                JOIN 
                    order_details od ON o.order_id = od.order_id
                JOIN 
                    products p ON od.product_id = p.product_id
                WHERE 
                    o.user_id = $userId
                ORDER BY 
                    o.created_at DESC";
        return $this->getList($sql);
    }
    function getOrdersByPage($userId)
    {
        $sql = "SELECT o.order_id, created_at as order_created_at, o.order_status, o.total_amount FROM orders o
        WHERE o.user_id = $userId
        ORDER BY order_created_at DESC";
        return $this->getList($sql);
    }
    function getPurchaseOrderDetail($userId, $order_id)
    {
        $sql = "SELECT 
                    o.order_id,
                    o.total_amount,
                    p.product_id,
                    p.name,
                    p.image,
                    od.price,
                    od.quantity,
                    od.order_detail_id
                FROM 
                    orders o
                JOIN 
                    order_details od ON o.order_id = od.order_id
                JOIN 
                    products p ON od.product_id = p.product_id
                WHERE 
                    o.order_id = $order_id
                ORDER BY 
                    o.created_at DESC";
        return $this->getList($sql);
    }
    function getOrderById($id){
        $sql = "SELECT order_id, order_status, created_at FROM orders
        WHERE order_id = $id";
        return $this->getInstance($sql);
    }
}
?>