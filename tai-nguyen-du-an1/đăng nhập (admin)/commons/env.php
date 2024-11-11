<?php 

// Biến môi trường, dùng chung toàn hệ thống
// Khai báo dưới dạng HẰNG SỐ để không phải dùng $GLOBALS

define('BASE_URL'       , 'http://localhost/Du_an_mau/Du_an_xuong/base-xuong-thu-cung/');

// Đường dẫn vào phần admin
define('BASE_URL_ADMIN'       , 'http://localhost/Du_an_mau/Du_an_xuong/base-xuong-thu-cung/admin/');
// Đường dẫn đến client

define('DB_HOST'    , 'localhost');
define('DB_PORT'    , 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
// Tên database
// define('DB_NAME'    , 'xuong-thu-cung');
define('DB_NAME'    , 'du_an_1'); 

// define('PATH_ROOT'    , __DIR__ );
define('PATH_ROOT'    , __DIR__ . '/../');
    