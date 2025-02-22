<?php

class ShopController
{
    private $productModel;  // Đối tượng ProductModel
    private $productView;   // Đối tượng ProductView
    private $resultView;
    private $componentView;

    public function __construct()
    {
        $this->productModel = new ProductModel(); // Khởi tạo model
        $this->productView = new ProductView();   // Khởi tạo view
        $this->resultView = new ResultView();
        $this->componentView = new ComponentView();
    }

    // Hiển thị trang shop với danh sách sản phẩm
    public function index($page = 1, $limit = 8)
    {
        // Xác định trang hiện tại
        $page = max(1, $page); // Đảm bảo page >= 1

        // Tính OFFSET
        $offset = ($page - 1) * $limit;
        $total_rows = $this->productModel->getRow();
        $total_pages = ceil($total_rows[0] / $limit);
        if (isset($_SESSION['sort'])) {
            $products = $this->sort($limit, $offset);
        } else {
            $products = $this->productModel->getProductsByPage($limit, $offset);
        }
        $this->componentView->breadcrumb('Shop');
        $categoryController = new CategoryController();
        $categoryController->navCategories();
        $this->productView->displayProductList($products, $total_pages, $page, $limit); // Hiển thị sản phẩm trên view
    }

    // Hiển thị chi tiết sản phẩm khi người dùng click vào sản phẩm
    public function detail($id)
    {
        $product = $this->productModel->getProductById($id); // Lấy chi tiết sản phẩm
        if ($product) {
            $this->productView->displayProductDetail($product); // Hiển thị chi tiết sản phẩm
        } else {
            $this->productView->showError("Sản phẩm không tồn tại!");
        }
    }
    function search($page = 1, $limit = 8)
    {
        // Xác định trang hiện tại
        $page = max(1, $page); // Đảm bảo page >= 1
        $offset = ($page - 1) * $limit;
        if (!isset($_SESSION['keyword']) || $_SESSION['keyword'] == '') {
            header('location: /gnuh/shop');
            exit();
        } else {
            $keyword = $_SESSION['keyword'];
            $total_pages = ceil($this->productModel->getRowSearchProduct($keyword)[0] / $limit);
        }
        if (isset($_SESSION['sort'])) {
            $products = $this->sort($limit, $offset);
        } else {
            $products = $this->productModel->searchProduct($keyword, $limit, $offset);
        }
        if (!$products) {
            $message = 'Product "<span class="fw-bolder color-danger">' . $keyword . '</span>" does not exist!';
            $this->resultView->displayErrorAdmin($message, 'shop');
        } else {
            $this->componentView->breadcrumb('Shop');
            $categoryController = new CategoryController();
            $categoryController->navCategories();
            $this->productView->displayProductList($products, $total_pages, $page, $limit); // Hiển thị sản phẩm trên view
        }
    }

    function clearKeyword()
    {
        unset($_SESSION['keyword']);
        header('location: /gnuh/shop');
        exit();
    }

    function sort($limit, $offset)
    {
        if (isset($_SESSION['sort'])) {
            $sort = $_SESSION['sort'];
            $orderBy = "";
            switch ($sort) {
                case 'low-high':
                    $orderBy = "ORDER BY price ASC";
                    break;
                case 'high-low':
                    $orderBy = "ORDER BY price DESC";
                    break;
                case 'best-seller':
                    $orderBy = "ORDER BY sold DESC"; // Giả sử có cột `sold` trong DB
                    break;
                case 'popular':
                    $orderBy = "ORDER BY views DESC"; // Giả sử có cột `views`
                    break;
                default:
                    $orderBy = "";
                    unset($_SESSION['sort']);
                    break;
            }
        }
        $keyword = "";
        if (isset($_SESSION['keyword'])) {
            $keyword = $_SESSION['keyword'];
        }
        $where = "";
        switch ($keyword) {
            case 'low-high':
                $where = "WHERE name = '%$keyword%'";
                break;
            case 'high-low':
                $where = "WHERE name = '%$keyword%'";
                break;
            case 'best-seller':
                $where = "WHERE name = '%$keyword%'";
                break;
            case 'popular':
                $where = "WHERE name = '%$keyword%'";
                break;
            default:
                $where = "";
                break;
        }

        return $this->productModel->getSortedProducts($where, $orderBy, $limit, $offset);
    }
}
