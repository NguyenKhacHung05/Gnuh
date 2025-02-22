<?php

// Danh sách các route
return [
    '' => [
        'controller' => 'HomeController',
        'method' => 'index',
    ],
    'admin' => [
        'controller' => 'AdminController',
        'method' => 'displayAdminDashboard'
    ],
    'admin/dashboard/order/:page/:limit' => [
        'controller' => 'AdminController',
        'method' => 'displayAdminDashboard'
    ],
    'admin/search/:page' => [
        'controller' => 'AdminController',
        'method' => 'search'
    ],
    'admin/dashboard' => [
        'controller' => 'AdminController',
        'method' => 'displayAdminDashboard'
    ],
    'admin/category' => [
        'controller' => 'AdminController',
        'method' => 'displayAdminCategory'
    ],
    'admin/category/search' => [
        'controller' => 'AdminController',
        'method' => 'searchAdminCategory'
    ],
    'admin/category/insert' => [
        'controller' => 'AdminController',
        'method' => 'categoryInsert'
    ],
    'admin/category/edit/:id' => [
        'controller' => 'AdminController',
        'method' => 'categoryEdit'
    ],
    'admin/category/delete/:id' => [
        'controller' => 'AdminController',
        'method' => 'categoryDelete'
    ],
    'admin/category/:page/:limit' => [
        'controller' => 'AdminController',
        'method' => 'displayAdminCategory'
    ],
    'admin/product' => [
        'controller' => 'AdminController',
        'method' => 'displayAdminProduct'
    ],
    'admin/product/search' => [
        'controller' => 'AdminController',
        'method' => 'searchAdminProduct'
    ],
    'admin/product/insert' => [
        'controller' => 'AdminController',
        'method' => 'productInsert'
    ],
    'admin/product/delete/:id' => [
        'controller' => 'AdminController',
        'method' => 'productDelete'
    ],
    'admin/product/edit/:id' => [
        'controller' => 'AdminController',
        'method' => 'productEdit'
    ],
    'admin/product/:page/:limit' => [
        'controller' => 'AdminController',
        'method' => 'displayAdminProduct'
    ],
    'admin/order' => [
        'controller' => 'AdminController',
        'method' => 'displayAdminOrder'
    ],
    'admin/order/changestatus' => [
        'controller' => 'AdminController',
        'method' => 'changeStatus'
    ],
    'admin/order/:page/:limit' => [
        'controller' => 'AdminController',
        'method' => 'displayAdminOrder'
    ],
    'admin/member' => [
        'controller' => 'AdminController',
        'method' => 'displayAdminMember'
    ],
    'admin/member/:page/:limit' => [
        'controller' => 'AdminController',
        'method' => 'displayAdminMember'
    ],
    'admin/review' => [
        'controller' => 'AdminController',
        'method' => 'displayAdminReview'
    ],
    'admin/discount' => [
        'controller' => 'AdminController',
        'method' => 'displayAdminDiscount'
    ],
    'admin/shipping' => [
        'controller' => 'AdminController',
        'method' => 'displayAdminShipping'
    ],
    'cart' => [
        'controller' => 'CartController',
        'method' => 'index',
    ],
    'cart/addtocart' => [
        'controller' => 'CartController',
        'method' => 'addToCart',
    ],
    'cart/update' => [
        'controller' => 'CartController',
        'method' => 'updateCart',
    ],
    'cart/del/:id' => [
        'controller' => 'CartController',
        'method' => 'delCart',
    ],
    'cart/checkout' => [
        'controller' => 'CartController',
        'method' => 'checkout',
    ],
    'shop' => [
        'controller' => 'ShopController',
        'method' => 'index',
    ],
    'review' => [
        'controller' => 'ReviewController',
        'method' => 'addReview',
    ],

    'shop/search' => [
        'controller' => 'ShopController',
        'method' => 'search',
    ],
    'shop/clearKeyword' => [
        'controller' => 'ShopController',
        'method' => 'clearKeyword',
    ],
    
    'shop/:page' => [
        'controller' => 'ShopController',
        'method' => 'index',
    ],
    'shop/product/:id' => [
        'controller' => 'ProductController',
        'method' => 'getProductById'
    ],
    'shop/category/:id' => [
        'controller' => 'CategoryController',
        'method' => 'category'
    ],
    'shop/category/:id/:page/:limit' => [
        'controller' => 'CategoryController',
        'method' => 'category'
    ],
    'shop/:page/:limit' => [
        'controller' => 'ShopController',
        'method' => 'index',
    ],
    'about' => [
        'controller' => 'HomeController',
        'method' => 'about',
    ],
    'contact' => [
        'controller' => 'HomeController',
        'method' => 'contact'
    ],
    'user/account/logout' => [
        'controller' => 'AuthController',
        'method' => 'logout'
    ],
    'user/purchase' => [
        'controller' => 'PurchaseOrderController',
        'method' => 'purchaseOrder'
    ],
    'user/purchase/:order_id' => [
        'controller' => 'PurchaseOrderController',
        'method' => 'purchaseOrderDetail'
    ],
    'user/account/profile' => [
        'controller' => 'AuthController',
        'method' => 'myProfile'
    ],
    'user/account/update' => [
        'controller' => 'AuthController',
        'method' => 'updateProfile'
    ],
    'login' => [
        'controller' => 'AuthController',
        'method' => 'showLogin'
    ],
    'checkLogin' => [
        'controller' => 'AuthController',
        'method' => 'checkLogin'
    ],
    'register' => [
        'controller' => 'AuthController',
        'method' => 'showRegister'
    ],
    'checkRegister' => [
        'controller' => 'AuthController',
        'method' => 'checkRegister'
    ],
];