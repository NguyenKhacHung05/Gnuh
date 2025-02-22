<?php class ReviewController{
    private $reviewModel;
    public function __construct()
    {
        $this->reviewModel = new ReviewModel();
    }
    public function addReview() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'];
            $userId = $_SESSION['user_id']; // Đảm bảo đã đăng nhập
            $order_detail_id = $_POST['order_detail_id'];
            $rating = $_POST['rating'];
            
            $comment = addslashes($_POST['comment']);
            if ($this->reviewModel->addReview($productId, $userId, $order_detail_id, $rating, $comment)) {
                $_SESSION['success'] = "Đánh giá thành công!";
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra!";
            }
            header("Location: /gnuh/shop/product/$productId");
            exit;
        }
    }

} ?>