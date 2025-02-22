<?php

class HomeController {
    protected $categoryController;
    protected $productController;
    protected $componentView;
    public function __construct()
    {
        $this->productController = new ProductController();
        $this->categoryController = new CategoryController();
        $this->componentView = new ComponentView();
    }
    public function index() {
        $this->componentView->slideShow();
        $this->categoryController->showCategoriesForHome();
        $this->componentView->service();
        $this->componentView->trendingProduct();
        $this->productController->getProductPopular();
        // $this->componentView->mostPopular();
        $this->componentView->deals();
    }
    public function about(){
        $this->componentView->breadcrumb(__FUNCTION__);
        require_once 'views/pages/about.php';
    }
    public function contact(){
        $this->componentView->breadcrumb(__FUNCTION__);
        require_once 'views/pages/contact.php';
    }
    public function cart(){
        $this->componentView->breadcrumb(__FUNCTION__);
        require_once 'views/pages/cart.php';
    }
}