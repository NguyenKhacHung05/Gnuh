<?php class ReviewModel extends connect
{
    private $review_id;
    private $product_id;
    private $order_detail_id;
    private $rating;
    private $comment;
    private $created_at;
    public function __construct()
    {
        parent::__construct();
        if (func_num_args() > 0) {
            $params = func_get_args(); // Lấy tất cả tham số dưới dạng mảng

            // Gán giá trị cho các thuộc tính của đối tượng
            $this->review_id = $params[0] ?? null;
            $this->product_id = $params[1] ?? null;
            $this->order_detail_id = $params[2] ?? null;
            $this->rating = $params[3] ?? null;
            $this->comment = $params[4] ?? null;
            $this->created_at = $params[5] ?? null;
        }
    }
    public function addReview($productId, $userId, $order_detail_id, $rating, $comment)
    {
        try {
            $sql = "INSERT INTO reviews (product_id, user_id, order_detail_id, rating, comment) 
                    VALUES ($productId, $userId, $order_detail_id, $rating, '$comment')";
            $result = $this->exec($sql);
            if($result){
                $_SESSION['success'] = "Review successfully!";
                return $result;
            }
        } catch (Exception $e) {
            if ($e->getCode() == 23000) {
                $_SESSION['error'] = "Bạn đã đánh giá đơn hàng này rồi!";
            } else {
                $_SESSION['error'] = "Lỗi khi thêm đánh giá: " . $e->getMessage();
            }
            throw $e; // Ném lỗi sau khi đã thông báo
        }
    }

    function getRow()
    {
        $sql = "SELECT COUNT(*) FROM reviews";
        return $this->getInstance($sql);
    }
    public function getReviewByProductId($id)
    {
        $sql = "SELECT r.*, u.fullname FROM reviews r
        JOIN users u ON r.user_id = u.user_id
        WHERE product_id = $id
        ORDER BY r.created_at DESC";
        return $this->getList($sql);
    }
    function getReviewsByPageAdmin($limit, $offset)
    {
        $sql = "SELECT reviews.review_id, reviews.product_id as product_id, users.fullname as fullname, reviews.created_at, reviews.rating, reviews.comment, products.name as product_name FROM reviews
        JOIN users ON users.user_id = reviews.user_id
        JOIN products ON products.product_id = reviews.product_id
        ORDER BY review_id DESC LIMIT $limit OFFSET $offset";
        $result = $this->getList($sql);
        return $result;
    }
    
    function searchReviewAdmin($field, $keyword, $limit, $offset)
    {
        $sql = "SELECT reviews.review_id, reviews.product_id as product_id, users.fullname as fullname, reviews.created_at, reviews.rating, reviews.comment, products.name as product_name FROM reviews
        JOIN users ON users.user_id = reviews.user_id
        JOIN products ON products.product_id = reviews.product_id
        WHERE $field like '%$keyword%'
        ORDER BY review_id DESC LIMIT $limit OFFSET $offset";
        $result = $this->getList($sql);
        return $result;
    }

    function getReviewId()
    {
        return $this->review_id;
    }
    function getProductId()
    {
        return $this->product_id;
    }
    function getOrderDetailId()
    {
        return $this->order_detail_id;
    }
    function getRating()
    {
        return $this->rating;
    }
    function getCommemt()
    {
        return $this->comment;
    }
    function getCreatedAt()
    {
        return $this->created_at;
    }
} ?>