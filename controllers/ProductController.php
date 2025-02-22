<?php
class ProductController
{
    private $productModel;  // Đối tượng ProductModel
    private $productView;   // Đối tượng ProductView
    private $reviewModel;

    public function __construct()
    {
        $this->productModel = new ProductModel(); // Khởi tạo model
        $this->productView = new ProductView();   // Khởi tạo view
        $this->reviewModel = new ReviewModel();   // Khởi tạo view
    }
    public function getProducts()
    {
        $product = new Product();
        $products = $product->getAllProduct();
        $productView = new ProductView();
        $productView->renderProducts($products);
    }

    public function getProductById($id)
    {
        $this->productModel->increaseViewCount($id);
        // Load chi tiết sản phẩm tại đây...
        $product = $this->productModel->getProductById($id); // Lấy thông tin sản phẩm theo ID
        if ($product) {
            // $related_products = $this->productModel->getRelatedProduct($product->getCategoryId());
            $related_products = null;
            $reviews = $this->reviewModel->getReviewByProductId($id);
            $this->productView->displayProductDetail($product, $reviews, $related_products); // Hiển thị chi tiết sản phẩm
        } else {
            $this->productView->showError("Sản phẩm không tồn tại!"); // Thông báo lỗi
        }
    }

    public function getProductPopular(){
        $products = $this->productModel->getProductPopular();
        $this->productView->displayProductPopular($products);
    }
}
?>