<?php
class ProductModel extends connect
{
    private $id;
    private $name;
    private $price;
    private $description;
    private $stock;
    private $image;
    private $category_id;
    private $views;
    private $sold;
    private $created_at;
    private $updated_at;

    public function __construct()
    {
        parent::__construct();
        if (func_num_args() > 0) {
            $params = func_get_args(); // Lấy tất cả tham số dưới dạng mảng

            // Gán giá trị cho các thuộc tính của đối tượng
            $this->id = $params[0] ?? null;
            $this->name = $params[1] ?? null;
            $this->price = $params[2] ?? null;
            $this->description = $params[3] ?? null;
            $this->stock = $params[4] ?? null;
            $this->image = $params[5] ?? null;
            $this->category_id = $params[6] ?? null;
            $this->views = $params[7] ?? null;
            $this->sold = $params[8] ?? null;
            $this->created_at = $params[9] ?? null;
            $this->updated_at = $params[10] ?? null;
        }
    }
    public function getAllProducts()
    {
        $sql = "SELECT * FROM products";
        $result = $this->getlist($sql);
        $products = [];
        if ($result) {
            foreach ($result as $row) {
                $product = new ProductModel($row['product_id'], $row['name'], $row['price'], $row['description'], $row['stock'], $row['image'], $row['category_id'], $row['views'], $row['sold'], $row['created_at'], $row['updated_at']);
                array_push($products, $product);
            }
            return $products;
        }
    }
    public function getProductById($id)
    {
        $sql = "SELECT * FROM products WHERE product_id = $id";
        $result = $this->getInstance($sql);
        if ($result) {
            $product = new ProductModel($result['product_id'], $result['name'], $result['price'], $result['description'], $result['stock'], $result['image'], $result['category_id'], $result['views'], $result['sold'], $result['created_at'], $result['updated_at']);
        }
        if (!isset($product) || empty($product)) {
            return null;
        }
        return $product;
    }
    public function getProductPopular()
    {
        $sql = "SELECT p.product_id, p.name, p.image, p.price, p.stock, p.views, SUM(od.quantity) AS total_sold
FROM products p
JOIN order_details od ON p.product_id = od.product_id
GROUP BY p.product_id, p.name
ORDER BY total_sold DESC
LIMIT 3
";
        return $this->getlist($sql);
    }
    public function getRelatedProduct($cateogry_id)
    {
        $sql = "SELECT * FROM products WHERE category_id = $cateogry_id LIMIT 3";
        $result = $this->getList($sql);
        $products = [];
        if ($result) {
            foreach ($result as $row) {
                $product = new ProductModel($row['product_id'], $row['name'], $row['price'], $row['description'], $row['stock'], $row['image'], $row['category_id'], $row['views'], $row['sold'], $row['created_at'], $row['updated_at']);
                array_push($products, $product);
            }
            return $products;
        }

    }
    function getProductsByPage($limit, $offset)
    {
        $sql = "SELECT * FROM products LIMIT $limit OFFSET $offset";
        $result = $this->getList($sql);
        $products = [];
        if ($result) {
            foreach ($result as $row) {
                $product = new ProductModel($row['product_id'], $row['name'], $row['price'], $row['description'], $row['stock'], $row['image'], $row['category_id'], $row['views'], $row['sold'], $row['created_at'], $row['updated_at']);
                array_push($products, $product);
            }
            return $products;
        }
    }
    function getSortedProducts($where, $orderBy, $limit, $offset)
    {
        $sql = "SELECT * FROM products $where $orderBy Limit $limit OFFSET $offset";
        $result = $this->getList($sql);
        $products = [];
        if ($result) {
            foreach ($result as $row) {
                $product = new ProductModel($row['product_id'], $row['name'], $row['price'], $row['description'], $row['stock'], $row['image'], $row['category_id'], $row['views'], $row['sold'], $row['created_at'], $row['updated_at']);
                array_push($products, $product);
            }
            return $products;
        }
    }
    public function increaseViewCount($productId)
    {
        // Xây dựng câu truy vấn SQL
        $query = "UPDATE products SET views = views + 1 WHERE product_id = $productId";

        // Sử dụng hàm exec để thực thi
        $result = $this->db->exec($query);

        return $result; // Trả về số dòng bị ảnh hưởng
    }
    function getRow()
    {
        $sql = "SELECT COUNT(*) FROM products";
        return $this->getInstance($sql);
    }

    function searchProduct($keyword, $limit, $offset)
    {
        $sql = "SELECT * FROM products WHERE name like '%$keyword%' LIMIT $limit OFFSET $offset";
        $result = $this->getList($sql);
        $products = [];
        if ($result) {
            foreach ($result as $row) {
                $product = new ProductModel($row['product_id'], $row['name'], $row['price'], $row['description'], $row['stock'], $row['image'], $row['category_id'], $row['views'], $row['sold'], $row['created_at'], $row['updated_at']);
                array_push($products, $product);
            }
            return $products;
        }
    }

    function getRowSearchProduct($keyword)
    {
        $sql = "SELECT count(*) FROM products WHERE name like '%$keyword%'";
        return $this->getInstance($sql);
    }

    function getImageById($id)
    {
        $sql = "SELECT image FROM products WHERE product_id = $id";
        return $this->getInstance($sql);
    }

    function getProductsByPageAdmin($limit, $offset)
    {
        $sql = "SELECT * FROM products ORDER BY product_id DESC LIMIT $limit OFFSET $offset";
        $result = $this->getList($sql);
        $products = [];
        if ($result) {
            foreach ($result as $row) {
                $product = new ProductModel($row['product_id'], $row['name'], $row['price'], $row['description'], $row['stock'], $row['image'], $row['category_id'], $row['views'], $row['sold'], $row['created_at'], $row['updated_at']);
                array_push($products, $product);
            }
            return $products;
        }
    }

    function searchAdminProduct($field, $name, $limit, $offset)
    {
        $sql = "SELECT * FROM products WHERE $field like '%$name%' LIMIT $limit OFFSET $offset";
        $result = $this->getList($sql);
        $products = [];
        if ($result) {
            foreach ($result as $row) {
                $product = new ProductModel($row['product_id'], $row['name'], $row['price'], $row['description'], $row['stock'], $row['image'], $row['category_id'], $row['views'], $row['sold'], $row['created_at'], $row['updated_at']);
                array_push($products, $product);
            }
            return $products;
        }
    }
    public function insertProduct()
    {
        try {
            $sql = "INSERT INTO products (name, price, description, stock, image, category_id) VALUES ('$this->name', $this->price, '$this->description', $this->stock, '$this->image', $this->category_id)";
            return $this->exec($sql);
        } catch (Exception $e) {
            throw $e;
            return false;
        }

    }
    public function deleteProduct($id)
    {
        $sql = "DELETE FROM products WHERE product_id = $id";
        return $this->exec($sql);
    }

    public function updateProduct($id, $name, $description, $price, $stock, $category_id, $image)
    {
        $sql = "UPDATE products SET name = '$name', description = '$description', price = '$price', stock = '$stock',category_id = $category_id, image = '$image', updated_at = current_timestamp() WHERE product_id = $id";
        return $this->exec($sql);
    }
    public function getProductId()
    {
        return $this->id;
    }
    public function getProductName()
    {
        return $this->name;
    }
    public function getProductPrice()
    {
        return $this->price;
    }
    public function getProductDescription()
    {
        return $this->description;
    }
    public function getProductStock()
    {
        return $this->stock;
    }
    public function getProductImage()
    {
        return $this->image;
    }
    public function getViews()
    {
        return $this->views;
    }
    public function getSold()
    {
        return $this->sold;
    }
    public function getProductCreated_at()
    {
        return $this->created_at;
    }
    public function getProductUpdated_at()
    {
        return $this->updated_at;
    }
    public function getCategoryId(){
        return $this->category_id;
    }
    public function setProductName($name)
    {
        $this->name = $name;
    }
    public function setProductPrice($price)
    {
        $this->price = $price;
    }
    public function setProductDescription()
    {
        return $this->description;
    }
    public function setProductStock()
    {
        return $this->stock;
    }
    public function setProductImage()
    {
        return $this->image;
    }
    public function setProductCreated_at()
    {
        return $this->created_at;
    }
    public function setProductUpdated_at()
    {
        return $this->updated_at;
    }
}
?>