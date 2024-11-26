<?php
class DonHang
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB(); // Hàm kết nối database
    }

    public function getDonHangByUserId($tai_khoan_id)
    {
        $sql = "SELECT 
                dh.id AS don_hang_id,
                dh.ma_don_hang,
                dh.ten_nguoi_nhan,
                dh.email_nguoi_nhan,
                dh.sdt_nguoi_nhan,
                dh.dia_chi_nguoi_nhan,
                dh.ngay_dat,
                dh.tong_tien,
                dh.ghi_chu,
                dh.phuong_thuc_thanh_toan_id,
                dh.trang_thai_thanh_toan_id,
                ct.id AS chi_tiet_id,
                ct.don_hang_id,
                ct.san_pham_id,
                ct.don_gia,
                ct.so_luong,
                sp.ten_san_pham,
                sp.gia_san_pham,
                sp.hinh_anh,
                tk.ho_ten
            FROM don_hangs dh
            JOIN chi_tiet_don_hangs ct ON dh.id = ct.don_hang_id
            JOIN san_phams sp ON ct.san_pham_id = sp.id
            JOIN tai_khoans tk ON dh.tai_khoan_id = tk.id
            WHERE dh.tai_khoan_id = :tai_khoan_id
            ORDER BY dh.ngay_dat DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':tai_khoan_id', $tai_khoan_id, PDO::PARAM_INT);
        $stmt->execute();
        $donHangs = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $result = [];
        foreach ($donHangs as $row) {
            $donHangId = $row['don_hang_id'];

            if (!isset($result[$donHangId])) {
                $result[$donHangId] = [
                    'don_hang_id' => $row['don_hang_id'],
                    'ma_don_hang' => $row['ma_don_hang'],
                    'ten_nguoi_nhan' => $row['ten_nguoi_nhan'],
                    'email_nguoi_nhan' => $row['email_nguoi_nhan'],
                    'sdt_nguoi_nhan' => $row['sdt_nguoi_nhan'],
                    'dia_chi_nguoi_nhan' => $row['dia_chi_nguoi_nhan'],
                    'ngay_dat' => $row['ngay_dat'],
                    'tong_tien' => $row['tong_tien'],
                    'san_pham' => [],
                    'ho_ten' => $row['ho_ten']  // Lấy tên khách hàng từ bảng tai_khoans
                ];
            }

            // Gán sản phẩm vào mảng 'san_pham' của đơn hàng
            $result[$donHangId]['san_pham'][] = [
                'ten_san_pham' => $row['ten_san_pham'],
                'gia_san_pham' => $row['gia_san_pham'],
                'hinh_anh' => $row['hinh_anh'],
                'so_luong' => $row['so_luong'],
                'don_gia' => $row['don_gia']
            ];
        }

        return $result;

    }


    // Lấy chi tiết đơn hàng theo ID và tài khoản
    public function getChiTietDonHang($don_hang_id)
    {
        $sql = "SELECT 
            dh.ma_don_hang, 
            dh.ngay_dat, 
            ttt.ten_trang_thai AS trang_thai,
            kh.ho_ten, 
            kh.dia_chi, 
            kh.so_dien_thoai, 
            kh.email AS email_nguoi_nhan,  -- Lấy email người nhận
            dh.ghi_chu,  -- Lấy ghi chú
            dh.phuong_thuc_thanh_toan_id, 
            ptth.ten_phuong_thuc AS phuong_thuc_thanh_toan,  -- Lấy tên phương thức thanh toán
            ct.san_pham_id, 
            sp.ten_san_pham, 
            ct.so_luong, 
            sp.gia_san_pham,  
            (ct.so_luong * sp.gia_san_pham) AS thanh_tien,  
            sp.hinh_anh
        FROM 
            don_hangs AS dh
        INNER JOIN 
            tai_khoans AS kh ON dh.tai_khoan_id = kh.id
        INNER JOIN 
            chi_tiet_don_hangs AS ct ON dh.id = ct.don_hang_id
        INNER JOIN 
            san_phams AS sp ON ct.san_pham_id = sp.id
        INNER JOIN 
            trang_thai_don_hangs AS ttt ON dh.trang_thai_id = ttt.id
        INNER JOIN 
            phuong_thuc_thanh_toans AS ptth ON dh.phuong_thuc_thanh_toan_id = ptth.id  -- JOIN với bảng phương thức thanh toán
        WHERE 
            dh.id = :don_hang_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':don_hang_id', $don_hang_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }



}


