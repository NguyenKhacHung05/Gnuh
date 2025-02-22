<?php
class CategoryController
{
    private $categoryModel;  // Đối tượng categoryModel
    private $categoryView;   // Đối tượng categoryView
    private $resultView;
    private $componentView;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel(); // Khởi tạo model
        $this->categoryView = new CategoryView();   // Khởi tạo view
        $this->resultView = new ResultView();
        $this->componentView = new ComponentView();
    }
    // Hiển thị tất cả danh mục
    public function index()
    {
        $categories = $this->categoryModel->getAllCategories();
        $this->categoryView->renderCategories($categories);
    }

    public function navCategories($id = 0, $page = 1, $limit = 8)
    {
        $topCategories = $this->categoryModel->getTopCategories();
        $this->categoryView->displayCategoryList($topCategories, $id, $page, $limit);
    }
    // Hiển thị chi tiết một danh mục (kèm sản phẩm)
    public function category($id, $page = 1, $limit = 8)
    {
        // Xác định trang hiện tại
        $page = max(1, $page); // Đảm bảo page >= 1

        // Tính OFFSET
        $offset = ($page - 1) * $limit;

        $category = $this->categoryModel->getCategoryById($id);

        $total_rows = $this->categoryModel->countProductsByCategory($id);
        $products = $this->categoryModel->getProductsByPage($id, $limit, $offset);
        // Tính tổng số trang
        $total_pages = ceil($total_rows[0] / $limit);
        $this->componentView->breadcrumb('Shop');
        $this->navCategories($id, $page, $limit);
        if (!$products) {
            $message = 'This category currently has no products!';
            $this->resultView->displayError($message, '/gnuh/shop');
        } else {
            $this->categoryView->renderCategoryDetail($category, $products, $total_pages, $page, $limit);
        }
    }

    // Thêm danh mục mới (admin)
    public function store($data)
    {
        $name = $data['name'];
        $description = $data['description'];
        $this->categoryModel->addCategory($name, $description);
        header('Location: categories'); // Điều hướng về danh sách danh mục
    }

    // Sửa danh mục (admin)
    public function update($id, $data)
    {
        $name = $data['name'];
        $description = $data['description'];
        $this->categoryModel->updateCategory($id, $name, $description);
        header('Location: categories');
    }

    // Xóa danh mục (admin)
    public function delete($id)
    {
        $this->categoryModel->deleteCategory($id);
        header('Location: categories');
    }
    // Hiển thị danh mục ở trang chủ
    public function showCategoriesForHome()
    {
        // $categories = $this->categoryModel->getAllCategories(); // Lấy tất cả danh mục
        $categories = $this->categoryModel->getCategoriesForHome();
        $this->categoryView->renderCategoriesForHome($categories); // Gọi view hiển thị
    }
}
?>