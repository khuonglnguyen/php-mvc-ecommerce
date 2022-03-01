<nav class="navbar">
    <div class="logo">HUYPHAM STORE</div>
    <ul class="nav-links">
      <input type="checkbox" id="checkbox_toggle" />
      <label for="checkbox_toggle" class="hamburger">&#9776;</label>
      <div class="menu">
        <li><a href="/">Trang chủ</a></li>
        <li class="cate">
          <a href="#">Danh mục</a>
          <ul class="sub-menu">
            <li><a href="products.html">Danh mục 1</a></li>
            <li><a href="products.html">Danh mục 2</a></li>
            <li><a href="products.html">Danh mục 3</a></li>
            <li><a href="products.html">Danh mục 4</a></li>
            <li><a href="products.html">Danh mục 5</a></li>
          </ul>
        </li>
        <li><a href="#">Giới thiệu</a></li>
        <?php
          if (isset($_SESSION['user_id'])) { ?>
            <li><a href="<?= URL_ROOT . "/user/logout" ?>">Đăng xuất</a></li>
            <?php  } else { ?>
            <li><a href="<?= URL_ROOT . "/user/register" ?>">Đăng ký</a></li>
            <li><a href="<?= URL_ROOT . "/user/login" ?>">Đăng nhập</a></li>
              <?php  }
        ?>
        <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
      </div>
    </ul>
  </nav>