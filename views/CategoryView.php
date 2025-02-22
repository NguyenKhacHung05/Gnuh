<?php
class CategoryView extends ProductView
{
    public function displayCategoryList($categories, $id = null, $page = 1, $limit = 8)
    {
        echo '
        <section class="container">
        <div class="row">
        <div class="col-md-10">
            <div class="product-cate">
                <h5>Categories</h5>
                <ul>
                    <li class="p-0 m-0"><a class="m-0 px-2 ' . ($id == null ? 'active' : '') . '" href="shop">All</a></li>
                    ';
        foreach ($categories as $c) {
            echo '<li class="p-0 m-0"><a class="m-0 px-2 ' . ($c->getCategoryId() == $id ? 'active' : '') . '" href="shop/category/' . $c->getCategoryId() . '/' . $page . '/' . $limit . '">' . $c->getCategoryName() . '</a></li>';
        }

        echo '
                </ul>
            </div>
        </div>
        <div class="col-md-2">
            <div class="sort-view">
                <a class="view-mode active" href="#"><i class="bi bi-grid-3x3-gap-fill"></i></a>
                <a class="view-mode" href="#"><i class="bi bi-list"></i></a>
                <div class="sorts">
                    ' . $this->sortForm() . '
                </div>
            </div>
        </div>
    </div>
    </section>
    ';
    }

    // Hiển thị chi tiết danh mục (kèm sản phẩm)
    public function renderCategoryDetail($categories, $products, $total_pages, $current_page = 1, $limit = 8)
    {
        echo '<!-- Products  -->
        <section class="container">
        <div class="row">';
        $this->renderProducts($products);
        echo '</div>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-md-12 mt-20">
                    <div class="goru-pagination text-center clearfix">';
        // Nút "Prev" (Trang Trước)
        if ($current_page > 1) {
            echo '<a class="prev" href="shop/category/' . $categories->getCategoryId() . '/' . (max(1, (int) $current_page - 1)) . '/' . $limit . '"><i class="bi bi-caret-left-fill"></i></a>';
        }

        // Nếu tổng số trang <= 20, hiển thị tất cả
        if ($total_pages <= 20) {
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $current_page) {
                    echo '<span class="current">' . $i . '</span>';
                } else {
                    echo '<a href="/gnuh/shop/category/' . $categories->getCategoryId() . '/' . $i . '/' . $limit . '">' . $i . '</a>';
                }
            }
        } else {
            // Hiển thị 5 trang đầu tiên
            for ($i = 1; $i <= 5; $i++) {
                if ($i == $current_page) {
                    echo '<span class="current">' . $i . '</span>';
                } else {
                    echo '<a href="/gnuh/shop/category/' . $categories->getCategoryId() . '/' . $i . '/' . $limit . '">' . $i . '</a>';
                }
            }

            // Hiển thị dấu "..." nếu trang hiện tại > 7
            if ($current_page > 7) {
                echo '<span class="dots">...</span>';
            }

            // Hiển thị 2 trang trước & sau trang hiện tại
            $start = max(6, $current_page - 2);
            $end = min($total_pages - 5, $current_page + 2);
            for ($i = $start; $i <= $end; $i++) {
                if ($i == $current_page) {
                    echo '<span class="current">' . $i . '</span>';
                } else {
                    echo '<a href="/gnuh/shop/category/' . $categories->getCategoryId() . '/' . $i . '/' . $limit . '">' . $i . '</a>';
                }
            }

            // Hiển thị dấu "..." nếu trang hiện tại < tổng số trang - 6
            if ($current_page < $total_pages - 6) {
                echo '<span class="dots">...</span>';
            }

            // Hiển thị 5 trang cuối cùng
            for ($i = $total_pages - 4; $i <= $total_pages; $i++) {
                if ($i == $current_page) {
                    echo '<span class="current">' . $i . '</span>';
                } else {
                    echo '<a href="/gnuh/shop/category/' . $categories->getCategoryId() . '/' . $i . '/' . $limit . '">' . $i . '</a>';
                }
            }
        }

        // Nút "Next" (Trang Sau)
        if ($current_page < $total_pages) {
            echo '<a class="next" href="/gnuh/shop/category/' . $categories->getCategoryId() . '/' . ($current_page + 1) . '/' . $limit . '"><i class="bi bi-caret-right-fill"></i></a>';
        }
        echo '
</div>

                </div>
            </div>
        </div>
        </section>
        <!-- Products  -->
        ';
    }
    // Hiển thị danh mục ở trang chủ
    public function renderCategoriesForHome($categories, $page = 1, $limit = 8)
    {
        echo '
<!-- Category -->
<section class="category container position-relative py-5" id="category">
<div class="sec-heading rotate-rl">Product <span> Categories</span></div>
<h3 class="heading-title fw-bolder mt-5 text-dark">Product Categories</h3>
<p class="text sub-title">
    Find quality products across all categories <br> from electronics to fashion and more.</p>
<div class="row">';
        foreach ($categories as $c) {
            echo '<div class="col col-lg-2 col-md-4">
        <div class="bsd m-2 p-5 rounded">
            <a href="shop/category/' . $c->getCategoryId() . '/' . $page . '/' . $limit . '" class="single-cate">
                <img src="assets/img/categories/' . $c->getCategoryImage() . '"></img>
            </a>
        </div>
    </div>';
        }
        echo '</div>
</section>
<!-- Category -->';
    }

    function sortForm()
    {
        $options = [
            '' => 'Default Sorting',
            'low-high' => 'Low to High',
            'high-low' => 'High to Low',
            'best-seller' => 'Best Seller',
            'popular' => 'Popular Products'
        ];

        $form = '<form method="post" action="shop' . (isset($_SESSION['keyword']) ? '/search' : '') . '">
                    <select name="sort" onchange="this.form.submit()">';

        foreach ($options as $value => $label) {
            $selected = (isset($_SESSION['sort']) && $_SESSION['sort'] == $value) ? 'selected' : '';
            $form .= "<option value=\"$value\" $selected>$label</option>";
        }

        $form .= '</select>
                </form>
                <i class="bi bi-chevron-down"></i>';
        return $form;
    }

}
?>