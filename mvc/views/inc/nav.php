<nav class="navbar">
  <div class="logo">HUYPHAM STORE</div>
  <ul class="nav-links">
    <input type="checkbox" id="checkbox_toggle" />
    <label for="checkbox_toggle" class="hamburger">&#9776;</label>
    <div class="menu">
      <li><a href="<?= URL_ROOT ?>">Trang chủ</a></li>
      <li class="cate">
        <a href="#">Danh mục</a>
        <ul class="sub-menu">
          <?php
          foreach ($data['cates'] as $key) { ?>
            <li><a href="<?= URL_ROOT . '/product/category/' . $key['id'] ?>"><?= $key['name'] ?></a></li>
          <?php }
          ?>
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