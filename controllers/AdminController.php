<?php class AdminController
{
    private $categoryModel;
    private $productModel;
    private $orderModel;
    private $authModel;
    private $reviewModel;
    private $adminView;
    private $resultView;
    public function __construct()
    {
        $this->checkAdmin();
        $this->categoryModel = new CategoryModel();
        $this->productModel = new ProductModel();
        $this->orderModel = new OrderModel();
        $this->authModel = new AuthModel();
        $this->reviewModel = new ReviewModel();
        $this->adminView = new AdminView();
        $this->resultView = new ResultView();
    }
    //admin
    function checkAdmin()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: /gnuh/"); // Chuyển hướng nếu không có quyền
            exit();
        }
    }
    function displayAdminDashboard($page = 1, $limit = 8)
    {

        // Xác định trang hiện tại
        $page = max(1, $page); // Đảm bảo page >= 1

        // Tính OFFSET
        $offset = ($page - 1) * $limit;

        $total_rows = $this->orderModel->getRow();

        // Tính tổng số trang
        $total_pages = ceil($total_rows[0] / $limit);
        $orders = $this->orderModel->getOrdersByPageAdmin($limit, $offset);
        foreach ($orders as &$order) {
            $order['order_details'] = $this->orderModel->getOrderDetailsByOrderId($order['order_id']);
        }
        $this->adminView->displaySidebar('dashboard');
        // $order = $this->productModel
        $statusOption = $this->orderModel->getStatusOptions();
        $this->adminView->displayAdminDashboard($orders,$statusOption, $total_pages, $page, $limit);
    }
    function displayAdminCategory($page = 1, $limit = 10)
    {
        // Xác định trang hiện tại
        $page = max(1, $page); // Đảm bảo page >= 1

        // Tính OFFSET
        $offset = ($page - 1) * $limit;

        $total_rows = $this->categoryModel->getRow();

        // Tính tổng số trang
        $total_pages = ceil($total_rows[0] / $limit);

        $this->adminView->displaySidebar('category');
        $categories = $this->categoryModel->getCategoriesByPageAdmin($limit, $offset);
        foreach ($categories as $c) {
            $c->total_product = $this->categoryModel->countProductsByCategory($c->getCategoryId())[0];
        }
        $allCategory = $this->categoryModel->getAllCategories();
        $this->adminView->displayAdminCategory($allCategory, $categories, $total_pages, $page, $limit);
    }

    function searchAdminCategory($page = 1, $limit = 10)
    {
        // Xác định trang hiện tại
        $page = max(1, $page); // Đảm bảo page >= 1
        $offset = ($page - 1) * $limit;
        if (!isset($_POST['search']) || $_POST['search'] == '') {
            header('location: /gnuh/admin/category');
            exit();
        } else {
            $keyword = $_POST['search'];
            $field = $_POST['search_field'];
        }
        $this->adminView->displaySidebar('category');
        $categories = $this->categoryModel->searchCategoryAdmin($field, $keyword, $limit, $offset);
        if (!$categories) {
            $message = 'Category "<span class="fw-bolder color-danger">' . $keyword . '</span>" does not exist!';
            $this->resultView->displayError($message, 'admin/category');
        } else {
            $total_pages = ceil(count($categories) / $limit);
            foreach ($categories as $c) {
                $c->total_product = $this->categoryModel->countProductsByCategory($c->getCategoryId())[0];
            }
            $allCategory = $this->categoryModel->getAllCategories();
            $this->adminView->displayAdminCategory($allCategory, $categories, $total_pages, $page, $limit);
        }
    }
    function categoryInsert()
    {
        $target_dir = "assets/img/categories/";
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

        // Tạo tên file ngẫu nhiên
        $newFileName = uniqid("img_", true) . "." . $imageFileType;

        // Đường dẫn file
        $target_file = $target_dir . $newFileName;

        // Kiểm tra và di chuyển file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $name = $_POST['category-name'];
            $image = $newFileName;
            $description = $_POST['description'] ?? null;
            $parent_id = $_POST['parent-id'] ?? null;
            $category = new CategoryModel(null, $name, $image, $description, null, null, $parent_id);
            $result = $category->insertCategory();
            if ($result) {
                echo 'Added successfully!';
                header('location: /gnuh/admin/category');
                exit();
            }
        } else {
            echo "Lỗi khi tải lên!";
        }
    }
    function categoryDelete($id)
    {
        $totalProduct = $this->categoryModel->countProductsByCategory($id)['total_product'];
        if ($totalProduct > 0) {
            $this->adminView->displaySidebar('category');
            $this->resultView->displayError("This category cannot be removed because related products are still available!", "/gnuh/admin/category");
            return false;
        }
        // Lấy đường dẫn ảnh trước khi xóa sản phẩm
        $result = $this->categoryModel->getImageById($id);
        $image = $result['image'];
        if ($image) {
            $imagePath = 'assets/img/categories/' . $image; // Đường dẫn file ảnh
            // Xóa ảnh nếu tồn tại
            if (file_exists($imagePath) && !empty($image)) {
                unlink($imagePath);
            }

            $this->categoryModel->deleteCategory($id);
            echo "Xóa thành công!";
            header('location: /gnuh/admin/category');
            exit();
        } else {
            echo "Không tìm thấy sản phẩm!";
        }
    }
    function categoryEdit($id)
    {
        $target_dir = "assets/img/categories/";
        $fileKey = "new-image-" . $id;
        // Lấy thông tin danh mục cũ
        $oldImage = $this->categoryModel->getImageById($id)['image'];
        if (!$oldImage) {
            return false;
        }

        // Kiểm tra xem có tải ảnh mới không
        if (!empty($_FILES["new-image-$id"]["name"])) {
            // Lấy phần mở rộng file
            $imageFileType = strtolower(pathinfo($_FILES["new-image-$id"]["name"], PATHINFO_EXTENSION));
            // Tạo tên file mới
            $newFileName = uniqid("img_", true) . "." . $imageFileType;
            // Đường dẫn file
            $target_file = $target_dir . $newFileName;
            // Di chuyển file mới vào thư mục
            if (move_uploaded_file($_FILES["new-image-$id"]["tmp_name"], $target_file)) {
                $image = $newFileName;

                // Xóa ảnh cũ nếu có
                if (!empty($oldImage) && file_exists($target_dir . $oldImage)) {
                    unlink($target_dir . $oldImage);
                }
            } else {
                return false; // Lỗi khi upload file
            }
        } else {
            // Giữ ảnh cũ nếu không có ảnh mới
            $image = $oldImage;
        }
        $name = $_POST['category-name'] ?? '';
        $description = $_POST['description'] ?? '';
        $parent_id = !empty($_POST['parent-id']) ? $_POST['parent-id'] : NULL;
        $result = $this->categoryModel->updateCategory($id, $name, $image, $description, $parent_id);
        if ($result) {
            header('location: /gnuh/admin/category');
            exit();
        } else {
            echo 'Fail!';
        }
    }
    function displayAdminProduct($page = 1, $limit = 10)
    {
        // Xác định trang hiện tại
        $page = max(1, $page); // Đảm bảo page >= 1
        $offset = ($page - 1) * $limit;
        $this->adminView->displaySidebar('product');
        $total_rows = $this->productModel->getRow();
        $products = $this->productModel->getProductsByPageAdmin($limit, $offset);
        if (!$products) {
            echo 'khong co san pham';
        } else {
            $total_pages = ceil($total_rows[0] / $limit);
            $categories = $this->categoryModel->getAllCategories();
            $this->adminView->displayAdminProduct($products, $total_pages, $page, $limit, $categories);
        }
    }
    function searchAdminProduct($page = 1, $limit = 10)
    {
        // Xác định trang hiện tại
        $page = max(1, $page); // Đảm bảo page >= 1
        $offset = ($page - 1) * $limit;
        if (!isset($_POST['search']) || $_POST['search'] == '') {
            header('location: /gnuh/admin/product');
            exit();
        } else {
            $keyword = $_POST['search'];
            $field = $_POST['search_field'];
        }

        $this->adminView->displaySidebar('product');
        $products = $this->productModel->searchAdminProduct($field, $keyword, $limit, $offset);
        if (!$products) {
            $message = 'Product "<span class="fw-bolder color-danger">' . $keyword . '</span>" does not exist!';
            $this->resultView->displayError($message, 'admin/product');
        } else {
            $total_pages = ceil(count($products) / $limit);
            $this->adminView->displayAdminProduct($products, $total_pages, $page, $limit);
        }
    }

    function productInsert()
    {
        $target_dir = "assets/img/products/";
        // Lấy phần mở rộng của file (jpg, png, ...)
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

        // Tạo tên file ngẫu nhiên
        $newFileName = uniqid("img_", true) . "." . $imageFileType;

        // Đường dẫn file
        $target_file = $target_dir . $newFileName;

        // Kiểm tra và di chuyển file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $name = $_POST['product-name'];
            $image = $newFileName;
            $price = $_POST['product-price'];
            $stock = $_POST['product-stock'];
            $description = str_replace("'", "", $_POST['description']) ?? null;
            $category_id = $_POST['category-id'] ?? null;
            $product = new ProductModel(null, $name, $price, $description, $stock, $image, $category_id, null, null, null, null);
            $result = $product->insertProduct();
            if ($result) {
                echo 'Added successfully!';
                header('location: /gnuh/admin/product');
                exit();
            }
        } else {
            echo "Lỗi khi tải lên!";
        }
    }

    function productDelete($id)
    {
        // Lấy đường dẫn ảnh trước khi xóa sản phẩm
        $result = $this->productModel->getImageById($id);
        $image = $result['image'];
        if ($image) {
            $imagePath = 'assets/img/products/' . $image; // Đường dẫn file ảnh

            // Xóa ảnh nếu tồn tại
            if (file_exists($imagePath) && !empty($image)) {
                unlink($imagePath);
                echo 'Xóa ảnh thành công';
            }
            $this->productModel->deleteProduct($id);
            header('location: /gnuh/admin/product');
            exit();
        } else {
            echo "Không tìm thấy sản phẩm!";
        }
    }

    function productEdit($id)
    {
        $target_dir = "assets/img/products/";
        $fileKey = "new-image-product-" . $id;

        // Lấy thông tin danh mục cũ
        $oldImage = $this->productModel->getImageById($id)['image'];
        if (!$oldImage) {
            return false;
        }

        // Kiểm tra xem có tải ảnh mới không
        if (!empty($_FILES[$fileKey]["name"])) {
            // Lấy phần mở rộng file
            $imageFileType = strtolower(pathinfo($_FILES[$fileKey]["name"], PATHINFO_EXTENSION));
            // Tạo tên file mới
            $newFileName = uniqid("img_", true) . "." . $imageFileType;
            // Đường dẫn file
            $target_file = $target_dir . $newFileName;

            // Di chuyển file mới vào thư mục
            if (move_uploaded_file($_FILES[$fileKey]["tmp_name"], $target_file)) {
                // Lưu tên ảnh mới
                $image = $newFileName;

                // Xóa ảnh cũ nếu có
                if (!empty($oldImage) && file_exists($target_dir . $oldImage)) {
                    unlink($target_dir . $oldImage);
                }
            } else {
                return false; // Lỗi khi upload file
            }
        } else {
            // Giữ ảnh cũ nếu không có ảnh mới
            $image = $oldImage;
        }

        $name = $_POST['product-name'];
        $price = $_POST['product-price'];
        $stock = $_POST['product-stock'];
        $description = $_POST['description'] ?? null;
        $category_id = $_POST['category-id'] ?? null;

        // Cập nhật sản phẩm
        $result = $this->productModel->updateProduct($id, $name, $description, $price, $stock, $category_id, $image);

        if ($result) {
            header('location: /gnuh/admin/product');
            exit();
        } else {
            echo 'Fail!';
        }
    }

    function displayAdminOrder($page = 1, $limit = 10)
    {
        // Xác định trang hiện tại
        $page = max(1, $page); // Đảm bảo page >= 1

        // Tính OFFSET
        $offset = ($page - 1) * $limit;

        $total_rows = $this->orderModel->getRow();

        // Tính tổng số trang
        $total_pages = ceil($total_rows[0] / $limit);

        $this->adminView->displaySidebar('order');
        $orders = $this->orderModel->getOrdersByPageAdmin($limit, $offset);
        foreach ($orders as &$order) {
            $order['order_details'] = $this->orderModel->getOrderDetailsByOrderId($order['order_id']);
        }
        $statusOption = $this->orderModel->getStatusOptions();
        $this->adminView->displayAdminOrder($orders, $statusOption,  $total_pages, $page, $limit);
    }
    function searchAdminOrder($page = 1, $limit = 10)
    {
        // Xác định trang hiện tại
        $page = max(1, $page); // Đảm bảo page >= 1
        $offset = ($page - 1) * $limit;
        if (!isset($_POST['search']) || $_POST['search'] == '') {
            header('location: /gnuh/admin/order');
            exit();
        } else {
            $keyword = $_POST['search'];
            $field = $_POST['search_field'];
        }
        $this->adminView->displaySidebar('order');
        $orders = $this->orderModel->searchOrderAdmin($field, $keyword, $limit, $offset);
        if (!$orders) {
            $message = 'Order "<span class="fw-bolder color-danger">' . $keyword . '</span>" does not exist!';
            $this->resultView->displayError($message, 'admin/order');
        } else {
            $total_pages = ceil(count($orders) / $limit);
            foreach ($orders as &$order) {
                $order['order_details'] = $this->orderModel->getOrderDetailsByOrderId($order['order_id']);
            }
            $statusOption = $this->orderModel->getStatusOptions();
            $this->adminView->displayAdminOrder($orders, $statusOption, $total_pages, $page, $limit);
        }
    }
    function changeStatus(){
        if(isset($_POST['order_id']) && isset($_POST['order_status'])){
            $this->orderModel->changeStatus($_POST['order_id'], $_POST['order_status']);
            $_SESSION['success'] = "Updated order status successfully";
        }
        header("location: /gnuh/admin/order");
    }
    function displayAdminMember($page = 1, $limit = 10)
    {
        // Xác định trang hiện tại
        $page = max(1, $page); // Đảm bảo page >= 1
        $offset = ($page - 1) * $limit;
        $this->adminView->displaySidebar('member');
        $total_rows = $this->authModel->getRow();
        $members = $this->authModel->getMembersByPageAdmin($limit, $offset);
        // Tính tổng số trang
        $total_pages = ceil($total_rows[0] / $limit);
        foreach ($members as $m) {
            $m->total_order = $this->orderModel->countOrdersByUserId($m->getUserId())[0];
        }
        $this->adminView->displayAdminMember($members, $total_pages, $page, $limit);
    }
    function searchAdminMember($page = 1, $limit = 10)
    {
        // Xác định trang hiện tại
        $page = max(1, $page); // Đảm bảo page >= 1
        $offset = ($page - 1) * $limit;
        if (!isset($_POST['search']) || $_POST['search'] == '') {
            header('location: /gnuh/admin/member');
            exit();
        } else {
            $keyword = $_POST['search'];
            $field = $_POST['search_field'];
        }
        $this->adminView->displaySidebar('member');
        $members = $this->authModel->searchMemberAdmin($field, $keyword, $limit, $offset);
        if (!$members) {
            $message = 'Member "<span class="fw-bolder color-danger">' . $keyword . '</span>" does not exist!';
            $this->resultView->displayError($message, 'admin/member');
        } else {
            foreach ($members as $m) {
                $m->total_order = $this->orderModel->countOrdersByUserId($m->getUserId())[0];
            }
            $total_pages = ceil(count($members) / $limit);
            $this->adminView->displayAdminMember($members, $total_pages, $page, $limit);
        }
    }
    function displayAdminReview($page = 1, $limit = 10)
    {
        // Xác định trang hiện tại
        $page = max(1, $page); // Đảm bảo page >= 1
        $offset = ($page - 1) * $limit;
        $total_rows = $this->reviewModel->getRow();
        $reviews = $this->reviewModel->getReviewsByPageAdmin($limit, $offset);
        // Tính tổng số trang
        $total_pages = ceil($total_rows[0] / $limit);
        $this->adminView->displaySidebar('review');
        $this->adminView->displayAdminReview($reviews, $total_pages, $page, $limit);
    }
    function searchAdminReview($page = 1, $limit = 10)
    {
        // Xác định trang hiện tại
        $page = max(1, $page); // Đảm bảo page >= 1
        $offset = ($page - 1) * $limit;
        if (!isset($_POST['search']) || $_POST['search'] == '') {
            header('location: /gnuh/admin/review');
            exit();
        } else {
            $keyword = $_POST['search'];
            $field = $_POST['search_field'];
        }
        $this->adminView->displaySidebar('review');
        $reviews = $this->reviewModel->searchReviewAdmin($field, $keyword, $limit, $offset);
        if (!$reviews) {
            $message = 'Review "<span class="fw-bolder color-danger">' . $keyword . '</span>" does not exist!';
            $this->resultView->displayError($message, 'admin/review');
        } else {
            $total_pages = ceil(count($reviews) / $limit);
            $this->adminView->displayAdminReview($reviews, $total_pages, $page, $limit);
        }
    }
    function displayAdminDiscount()
    {
        $this->adminView->displaySidebar('discount');
        $this->adminView->displayAdminDiscount();
    }
    function displayAdminShipping()
    {
        $this->adminView->displaySidebar('shipping');
        $this->adminView->displayAdminShipping();
    }

    function search($page)
    {
        switch ($page) {
            case "category":
                $this->searchAdminCategory();
                break;
            case "product":
                $this->searchAdminProduct();
                break;
            case "order":
                $this->searchAdminOrder();
                break;
            case "member":
                $this->searchAdminMember();
                break;
            case "review":
                $this->searchAdminReview();
                break;
        }
    }
} ?>