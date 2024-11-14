<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="../../index3.html" class="brand-link">
    <img src="./assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">longvtph49910</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="./assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?= BASE_URL_ADMIN ?>" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              Trang chủ
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= BASE_URL_ADMIN . '?act=danh-muc' ?>" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Danh mục sản phẩm
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= BASE_URL_ADMIN . '?act=san-pham' ?>" class="nav-link">
            <i class="nav-icon fas fa-paw"></i>
            <p>
              Sản phẩm
            </p>
          </a>
        </li>


        <li class="nav-item">
          <a href="<?= BASE_URL_ADMIN . '?act=don-hang' ?>" class="nav-link">
            <i class="nav-icon fas fa-file-invoice-dollar"></i>
            <p>
              Đơn hàng
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= BASE_URL_ADMIN . '?act=lien-he' ?>" class="nav-link">
            <i class="nav-icon fas fa-phone-square-alt"></i>
            <p>
              Liên hệ
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= BASE_URL_ADMIN . '?act=don-hang' ?>" class="nav-link">
            <i class="nav-icon fas fa-newspaper"></i>
            <p>
              Tin tức
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= BASE_URL_ADMIN . '?act=binh-luan' ?>" class="nav-link">
            <i class="nav-icon fas fa-newspaper"></i>
            <p>
              Bình luận
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= BASE_URL_ADMIN . '?act=trang-thai-don-hang' ?>" class="nav-link">
            <i class="nav-icon fas fa-newspaper"></i>
            <p>
              trang thái đơn hàng
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= BASE_URL_ADMIN . '?act=trang-thai-thanh-toan' ?>" class="nav-link">
            <i class="nav-icon fas fa-newspaper"></i>
            <p>
              trang thái thanh toán
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>Quản lý tài khoản</p>
            <i class="fas fa-angle-left right"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri' ?>" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>Tài khoản quản trị</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang' ?>" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>Tài khoản khách hàng</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= BASE_URL_ADMIN . '?act=form-sua-thong-tin-ca-nhan-quan-tri' ?>" class="nav-link">
                <i class="nav-icon far fa-user"></i>
                <p>Tài khoản cá nhân</p>
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>