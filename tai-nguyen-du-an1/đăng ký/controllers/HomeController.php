<?php

class HomeController
{
    public $modelSanPham;

    public $modelTaiKhoan;
    public $modelGioHang;
    // public $modelDangKy;
    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelGioHang = new GioHang();
    }

    public function home()
    {
        // echo 'Đây là home';
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/home.php';
    }


    public function chiTietSanPham()
    {
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        // var_dump($sanPham); die();
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        // var_dump($listAnhSanPham); die();
        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);

        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamDanhMuc($sanPham['danh_muc_id']);
        // var_dump($listSanPhamCungDanhMuc); die;
        if ($sanPham) {
            require_once './views/detailSanPham.php';
        } else {
            header('location: ' . BASE_URL);
            exit();
        }
    }


    // login
    public function formLogin()
    {
        require_once './views/auth/formLogin.php';
        // require_once './base-xuong-thu-cung/views/auth/formLogin.php';

        deleteSessionError();
        exit();
    }



    public function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Kiểm tra thông tin đăng nhập
            $user = $this->modelTaiKhoan->checkLogin($email, $password);

            if (is_array($user)) {
                // Lưu thông tin người dùng vào session
                $_SESSION['user_client'] = $user;  // Lưu toàn bộ thông tin người dùng vào session

                // Kiểm tra vai trò người dùng để chuyển hướng
                if ($user['vai_tro'] == 1) {
                    // Nếu là admin, chuyển đến trang quản trị
                    $_SESSION['user_admin'] = $user;  // Lưu thông tin admin
                    header('Location:' . BASE_URL_ADMIN);  // Chuyển đến trang quản trị
                    exit();
                } else {
                    // Nếu là khách hàng, chuyển đến trang chủ
                    header('Location:' . BASE_URL);  // Chuyển đến trang chủ
                    exit();
                }
            } else {
                // Lỗi đăng nhập
                $_SESSION['error'] = $user;
                $_SESSION['flash'] = true;
                header('Location:' . BASE_URL . '?act=login');
                exit();
            }
        }
    }






    public function Logout()
    {
        // Kiểm tra nếu người dùng là admin hoặc client
        if (isset($_SESSION['user_client'])) {
            // Đăng xuất người dùng client
            session_destroy();

            // Hiển thị thông báo và chuyển hướng về trang client
            echo "<script>
                    alert('Đăng xuất thành công');
                    window.location.href = '" . BASE_URL . "';
                  </script>";
            exit();
        } elseif (isset($_SESSION['user_admin'])) {
            // Đăng xuất người dùng admin
            session_destroy();

            // Hiển thị thông báo và chuyển hướng về trang admin
            echo "<script>
                    alert('Đăng xuất thành công');
                    window.location.href = '" . BASE_URL_ADMIN . "';
                  </script>";
            exit();
        } else {
            // Nếu không có session, chuyển hướng về trang chủ hoặc login
            header('Location: ' . BASE_URL);
            exit();
        }
    }



    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset(($_SESSION['user_client']))) {
                $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
                // var_dump($mail['id']); die;

                $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);
                if (!$gioHang) {
                    $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
                    $gioHang = ['id' => $gioHangId];
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                } else {
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                }

                $san_pham_id = $_POST['san_pham_id'];
                $so_luong = $_POST['so_luong'];

                $checkSanPham = false;

                // Lấy dữ liệu từ giỏ hàng của người dùng

                foreach ($chiTietGioHang as $detail) {
                    if ($detail['san_pham_id'] == $san_pham_id) {
                        $newSoLuong = $detail['so_luong'] + $so_luong;
                        $this->modelGioHang->updateSoLuong($gioHang['id'], $san_pham_id, $newSoLuong);
                        $checkSanPham = true;
                    }
                }
                // Nếu sản phẩm chưa có trong giỏ hàng thì thêm vào
                if (!$checkSanPham) {
                    $this->modelGioHang->addDetailGioHang($gioHang['id'], $san_pham_id, $so_luong);
                }
                header('location:' . BASE_URL . '?act=gio-hang');
                die;
            } else {
                var_dump('Chưa đăng nhập');
                die;
            }
        }
    }

    public function gioHang()
    {
        if (isset(($_SESSION['user_client']))) {
            $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            // var_dump($mail['id']); die;

            $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);
            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            } else {
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }
            // var_dump($chiTietGioHang); 
            require_once './views/gioHang.php';
        } else {
            var_dump('Chưa đăng nhập');
            die;
        }
    }


}
