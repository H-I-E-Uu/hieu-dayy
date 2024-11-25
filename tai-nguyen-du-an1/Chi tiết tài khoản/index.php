<?php
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
// require_once './controllers/TaiKhoanController.php';
require_once './controllers/HomeController.php';
require_once './controllers/TaiKhoanController.php';
require_once './controllers/LienHeController.php'; // Controller liên hệ
require_once './controllers/TinTucController.php';
require_once './controllers/DonHangController.php';

// require_once './controllers/AdminTaiKhoanController.php';

// Require toàn bộ file Models
require_once './models/SanPham.php';
require_once './models/TaiKhoan.php';
require_once './models/GioHang.php';
require_once './models/TinTuc.php';
require_once './models/LienHe.php';
require_once './models/DonHang.php';
// require_once './models/AdminTaiKhoan.php';


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


    'list-tai-khoan' => (new TaiKhoanController())->danhSach(),
    'form-them' => (new TaiKhoanController())->formAdd(),
    'them' => (new TaiKhoanController())->postAdd(),

    // Quản lý liên hệ
    'form-them-lien-he' => (new LienHeController())->formAdd(), // Hiển thị form thêm liên hệ
    'them-lien-he' => (new LienHeController())->postAdd(),      // Xử lý thêm liên hệ
// 'danh-sach-lien-he' => (new LienHeController())->danhSach() 

    /// quanr lí tin tức 
    'danh-sach-tin-tuc' => (new TinTucController())->danhSachTinTuc(),
    'chi-tiet-tin-tuc' => (new TinTucController())->detailTinTuc(),

    /// quản lý tài khoản cá nhân 
    'detail-tai-khoan' => (new TaiKhoanController())->detailTaiKhoan(),
    // 'sua-mat-khau-ca-nhan-quan-tri' => (new TaiKhoanController())->postEditMatKhauCaNhan(),

    /// quanr lí tin tức 
    'don-hang' => (new DonHangController())->donHang(),
    'chi-tiet-don-hang' => (new DonHangController())->detailDonHang(),
};