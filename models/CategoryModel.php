<?php
class CategoryModel extends connect
{
    private $id;
    private $name;
    private $image;
    private $description;
    private $created_at;
    private $updated_at;
    private $parent_id;


    public function __construct()
    {
        parent::__construct();
        if (func_num_args() > 0) {
            $params = func_get_args(); // Lấy tất cả tham số dưới dạng mảng

            // Gán giá trị cho các thuộc tính của đối tượng
            $this->id = $params[0] ?? null;
            $this->name = $params[1] ?? null;
            $this->image = $params[2] ?? null;
            $this->description = $params[3] ?? null;
            $this->created_at = $params[4] ?? null;
            $this->updated_at = $params[5] ?? null;
            $this->parent_id = $params[6] ?? null;
        }
    }
    // Lấy tất cả danh mục
    public function getAllCategories()
    {
        $sql = "SELECT * FROM categories";
        $result = $this->getlist($sql);
        $categories = array();
        if ($result) {
            foreach ($result as $row) {
                $category = new CategoryModel($row['category_id'], $row['name'], $row['image'], $row['description'], $row['created_at'], $row['updated_at'], $row['parent_id']);
                array_push($categories, $category);
            }
            return $categories;
        }
    }
    function getCategoriesForHome(){
        $sql = "SELECT * FROM categories LIMIT 12";
        $result = $this->getlist($sql);
        $categories = array();
        if ($result) {
            foreach ($result as $row) {
                $category = new CategoryModel($row['category_id'], $row['name'], $row['image'], $row['description'], $row['created_at'], $row['updated_at'], $row['parent_id']);
                array_push($categories, $category);
            }
            return $categories;
        }
    }


    function getRow()
    {
        $sql = "SELECT COUNT(*) FROM categories";
        return $this->getInstance($sql);
    }

    public function getTopCategories($limit = 6)
    {
        $sql = "SELECT * FROM categories LIMIT $limit";
        $result = $this->getlist($sql);
        $categories = array();
        if ($result) {
            foreach ($result as $row) {
                $category = new CategoryModel($row['category_id'], $row['name'], $row['image'], $row['description'], $row['created_at'], $row['updated_at'], $row['parent_id']);
                array_push($categories, $category);
            }
            return $categories;
        }
    }


    // Lấy thông tin danh mục theo ID
    public function getCategoryById($id)
    {
        $sql = "SELECT * FROM categories WHERE category_id = $id";
        $result = $this->getInstance($sql);
        if ($result) {
            $category = new CategoryModel($result['category_id'], $result['name'], $result['image'], $result['description'], $result['created_at'], $result['updated_at'], $result['parent_id']);
        }
        return $category;
    }

    // Lấy tất cả sản phẩm thuộc danh mục
    public function getProductsByCategory($id)
    {
        $sql = "SELECT * FROM products WHERE category_id = $id";
        $result = $this->getList($sql); // Lấy danh sách sản phẩm trong danh mục
        $products = array();
        if ($result) {
            foreach ($result as $row) {
                $product = new ProductModel($row['product_id'], $row['name'], $row['price'], $row['description'], $row['stock'], $row['image'], $row['category_id'], $row['views'], $row['sold'], $row['created_at'], $row['updated_at']);
                array_push($products, $product);
            }
            return $products;
        }
    }
    public function countProductsByCategory($id)
    {
        $sql = "SELECT count(*) as total_product FROM products WHERE category_id = $id";
        return $this->getInstance($sql);
    }

    public function getProductsByPage($id, $limit, $offset)
    {
        $sql = "SELECT * FROM products WHERE category_id = $id LIMIT $limit OFFSET $offset";
        $result = $this->getList($sql);
        $products = [];
        if ($result) {
            foreach ($result as $row) {
                $product = new ProductModel($row['product_id'], $row['name'], $row['price'], $row['description'], $row['stock'], $row['image'], $row['category_id'], $row['views'], $row['sold'], $row['created_at'], $row['updated_at']);
                array_push($products, $product);
            }
        }
        return $products;
    }

    function getCategoriesByPageAdmin($limit, $offset)
    {
        $sql = "SELECT * FROM categories ORDER BY category_id DESC LIMIT $limit OFFSET $offset";
        $result = $this->getList($sql);
        $categories = [];
        if ($result) {
            foreach ($result as $row) {
                $category = new CategoryModel($row['category_id'], $row['name'], $row['image'], $row['description'], $row['created_at'], $row['updated_at'], $row['parent_id']);
                array_push($categories, $category);
            }
            return $categories;
        }
    }

    function searchCategoryAdmin($field, $name, $limit, $offset)
    {
        $sql = "SELECT * FROM categories WHERE $field like '%$name%' LIMIT $limit OFFSET $offset";
        $result = $this->getList($sql);
        $categories = [];
        if ($result) {
            foreach ($result as $row) {
                $category = new CategoryModel($row['category_id'], $row['name'], $row['image'], $row['description'], $row['created_at'], $row['updated_at'], $row['parent_id']);
                array_push($categories, $category);
            }
            return $categories;
        }
    }
    // Thêm danh mục mới
    public function insertCategory()
    {
        try {
            $sql = "INSERT INTO categories (name, image, description, parent_id) VALUES ('$this->name', '$this->image', '$this->description', $this->parent_id)";
            return $this->exec($sql);
        } catch (Exception $e) {
            throw $e;
            return false;
        }

    }

    // Cập nhật danh mục
    public function updateCategory($id, $name, $image, $description, $parent_id)
    {
        $sql = "UPDATE categories SET name = '$name', image = '$image', description = '$description', parent_id = $parent_id, updated_at = current_timestamp() WHERE category_id = $id";
        return $this->exec($sql);
    }

    // Xóa danh mục
    function getImageById($id)
    {
        $sql = "SELECT image FROM categories WHERE category_id = $id";
        return $this->getInstance($sql);
    }
    public function deleteCategory($id)
    {
        $sql = "DELETE FROM categories WHERE category_id = $id";
        return $this->exec($sql);
    }

    public function getCategoryId()
    {
        return $this->id;
    }
    public function getCategoryName()
    {
        return $this->name;
    }
    public function getCategoryImage()
    {
        return $this->image;
    }
    public function getCategoryDescription()
    {
        return $this->description;
    }
    public function getCategoryCreatedAt()
    {
        return $this->created_at;
    }
    public function getCategoryUpdatedAt()
    {
        return $this->updated_at;
    }
    public function getCategoryParentId()
    {
        return $this->parent_id;
    }

} ?>