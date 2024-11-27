<?php require_once 'views/layout/header.php'; ?>
<?php require_once 'views/layout/menu.php'; ?>

<?php require_once 'views/layout/header.php'; ?>
<?php require_once 'views/layout/menu.php'; ?>

<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đơn hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <div class="container">
        <?php if (!empty($donhang)): ?>
            <?php foreach ($donhang as $item): ?>
                <div class="order-item">
                    <h3><strong>Khách hàng:</strong> <?= htmlspecialchars($item['ho_ten']) ?></h3>
                    <h4>Mã đơn hàng: <?= htmlspecialchars($item['ma_don_hang']) ?></h4>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Trạng thái</th> <!-- Thêm cột trạng thái -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($item['san_pham'] as $san_pham): ?>
                                <tr>
                                    <td><img src="<?= htmlspecialchars($san_pham['hinh_anh']) ?>" alt="Hình ảnh sản phẩm"></td>
                                    <td><?= htmlspecialchars($san_pham['ten_san_pham']) ?></td>
                                    <td><?= htmlspecialchars(number_format($san_pham['gia_san_pham'], 0, ',', '.')) ?> đ</td>
                                    <td><?= htmlspecialchars($san_pham['so_luong']) ?></td>
                                    <td><?php echo htmlspecialchars(number_format($san_pham['gia_san_pham'] * $san_pham['so_luong'], 0, ',', '.')) ?>
                                        đ</td>
                                    <td><?= htmlspecialchars($item['trang_thai']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <p><strong>Ngày đặt:</strong> <?= htmlspecialchars($item['ngay_dat']) ?></p>
                    <div class="action-buttons">
                        <a href="index.php?act=chi-tiet-don-hang&id=<?= htmlspecialchars($item['don_hang_id']) ?>"
                            class="detail-btn">Xem chi tiết</a>

                        <?php if ($item['trang_thai_id'] === 4): ?> <!-- Trạng thái bằng 1: Nút khả dụng -->
                            <a href="index.php?act=huy-don-hang&id=<?= htmlspecialchars($item['don_hang_id']) ?>" class="delete-btn"
                                onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">
                                Hủy đơn hàng
                            </a>
                        <?php elseif ($item['trang_thai_id'] === 5): ?> <!-- Trạng thái 5: Đơn hàng đã hủy -->
                            <span class="cancel-btn-disabled">Đơn hàng đã hủy</span>
                        <?php else: ?> <!-- Trạng thái khác 1 hoặc 5 -->
                            <span class="cancel-btn-disabled">Hủy đơn hàng</span>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php else: ?>  
            <p>Không có đơn hàng nào!</p>
        <?php endif; ?>
    </div>
</main>
<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f4f4f4;
        color: #444;
        padding: 40px 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .breadcrumb-area {
        background-color: #3498db;
        padding: 15px 0;
        color: #fff;
    }

    .breadcrumb-wrap nav ul.breadcrumb {
        list-style: none;
        display: flex;
        gap: 10px;
        align-items: center;
        justify-content: center;
    }

    .breadcrumb-item a {
        color: #fff;
        text-decoration: none;
    }

    .breadcrumb-item.active {
        font-weight: bold;
    }

    .order-item {
        border-bottom: 2px solid #ddd;
        padding-bottom: 30px;
        margin-bottom: 30px;
    }

    .order-item h3,
    .order-item h4 {
        color: #34495e;
    }

    .order-item h3 {
        font-size: 26px;
        font-weight: 600;
    }

    .order-item h4 {
        font-size: 22px;
        color: #2c3e50;
    }

    .order-item p {
        font-size: 18px;
        color: #333;
        margin-bottom: 15px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table thead {
        background-color: #3498db;
        color: #fff;
        font-weight: bold;
    }

    .table th,
    .table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .table th {
        background-color: #3498db;
    }

    .table td img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
    }

    .detail-btn {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 25px;
        background-color: #33FFFF;
        color: #fff;
        font-size: 18px;
        text-transform: uppercase;
        border-radius: 5px;
        text-decoration: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .cancel-btn-disabled {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 25px;
        background-color: #999999;
        color: #fff;
        font-size: 18px;
        text-transform: uppercase;
        border-radius: 5px;
        text-decoration: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .delete-btn {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 25px;
        background-color: #DD0000;
        color: #fff;
        font-size: 18px;
        text-transform: uppercase;
        border-radius: 5px;
        text-decoration: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }



    .delete-btn:hover {
        background-color: #CC0000;
    }

    .detail-btn:hover {
        background-color: #33CCFF;
    }

    @media screen and (max-width: 768px) {
        .breadcrumb-wrap nav ul.breadcrumb {
            flex-direction: column;
            text-align: center;
        }

        .order-item h3 {
            font-size: 22px;
        }

        .order-item h4 {
            font-size: 18px;
        }

        .table th,
        .table td {
            padding: 10px;
            font-size: 14px;
        }

        .table td img {
            width: 60px;
            height: 60px;
        }

        .detail-btn {
            padding: 8px 20px;
            font-size: 16px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            /* Khoảng cách giữa các nút */
            margin-top: 10px;
        }

        .action-buttons .detail-btn,
        .action-buttons .cancel-btn {
            display: inline-block;
            padding: 10px 25px;
            font-size: 16px;
            text-transform: uppercase;
            border-radius: 5px;
            text-decoration: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .action-buttons .detail-btn {
            background-color: #3498db;
            color: #fff;
        }

        .action-buttons .detail-btn:hover {
            background-color: #2980b9;
        }

        .action-buttons .cancel-btn {
            background-color: #e74c3c;
            color: #fff;
        }

        .action-buttons .cancel-btn:hover {
            background-color: #c0392b;
        }

        .action-buttons .cancel-btn.disabled {
            background-color: #bdc3c7;
            color: #7f8c8d;
            cursor: not-allowed;
            pointer-events: none;
        }
    }
</style>

<?php require_once 'views/layout/footer.php'; ?>


<?php require_once 'views/layout/footer.php'; ?>