<?php
class DonHangController
{
    private $model;

    public function __construct()
    {
        $this->model = new DonHang(); // Khởi tạo model DonHang
    }

    public function donHang()
    {
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (empty($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '?act=login');
            exit();
        }

        $tai_khoan_id = $_SESSION['user']['id'];
        $donhang = $this->model->getDonHangByUserId($tai_khoan_id); // Lấy danh sách đơn hàng

        require_once './views/donhang/DonHang.php';
    }

    public function chiTietDonHang()
    {
        // Kiểm tra nếu người dùng chưa đăng nhập
        if (empty($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '?act=login');
            exit();
        }

        // Lấy ID đơn hàng từ URL
        $don_hang_id = $_GET['id'];

        // Lấy chi tiết đơn hàng
        $chitietdonhang = $this->model->getChiTietDonHang($don_hang_id);

        // Hiển thị chi tiết đơn hàng
        require_once './views/donhang/detailDonHang.php';
    }

}


