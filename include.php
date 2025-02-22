<?php

function autoload($class) {
    // Cấu hình đường dẫn đến các thư mục chứa class
    $paths = [
        'controllers/', // Thư mục controller
        'models/',      // Thư mục model
        'views/'        // Thư mục view
    ];

    // Duyệt qua các thư mục và include các file class
    foreach ($paths as $path) {
        $file = __DIR__ . '/' . $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
}

// Đăng ký autoload
spl_autoload_register('autoload');
