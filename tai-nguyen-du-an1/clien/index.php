<?php
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
// require_once './controllers/TaiKhoanController.php';
require_once './controllers/HomeController.php';
require_once './controllers/TaiKhoanController.php';

// Require toàn bộ file Models
require_once './models/SanPham.php';
require_once './models/TaiKhoan.php';
require_once './models/GioHang.php';


// Route
$act = $_GET['act'] ?? '/';
// var_dump($_GET['act']);die();

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/' => (new HomeController())->home(),
    // Trường hợp đặc biệt


    'chi-tiet-san-pham' => (new HomeController())->chiTietSanPham(),
    // Base URL/?act=dnah-sach-san-pham
    'them-gio-hang' => (new HomeController())->addGioHang(),
    'gio-hang' => (new HomeController())->gioHang(),

    // +
    'login' => (new HomeController())->formLogin(),
    'check-login' => (new HomeController())->postLogin(),
    'logout' => (new HomeController())->Logout(),
    // 'dangky' => (new HomeController())->formAddDangky(),
    // 'check-dangky' => (new HomeController())->postAddDangKy(),

    /// danh sách tài khoản
    // Thêm route cho việc thêm tài khoản
    // 'taikhoan' => (new HomeController())->TaiKhoan(),
    // 'form-them-tai-khoan' => (new HomeController())->formThemTaiKhoan(),
    // 'check-them-tai-khoan' => (new HomeController())->postThemTaiKhoan(),
// 'form-them-tai-khoan' => (new TaiKhoanController())->formThemTaiKhoan(),
// 'check-them-tai-khoan' => (new TaiKhoanController())->postThemTaiKhoan(),



    'list-tai-khoan' => (new TaiKhoanController())->danhSach(),
    'form-them' => (new TaiKhoanController())->formAdd(),
    'them' => (new TaiKhoanController())->postAdd(),
};
