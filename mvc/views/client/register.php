<?php require APP_ROOT . '/views/client/inc/head.php';?>
<body>
<?php
      $cart = new cart();
      $total = (isset($cart->getTotalQuantitycart()['total']) ? $cart->getTotalQuantitycart()['total'] : 0);
      
      $category = $this->model("categoryModel");
      $result = $category->getAllClient();
      $listCategory = $result->fetch_all(MYSQLI_ASSOC);
      ?>
      <nav class="navbar">
        <div class="logo">HUYPHAM STORE</div>
        <ul class="nav-links">
          <input type="checkbox" id="checkbox_toggle" />
          <label for="checkbox_toggle" class="hamburger">&#9776;</label>
          <div class="menu">
            <li><a href="<?= URL_ROOT ?>">Trang chủ <i class="fa fa-home"></i></a></li>
            <li class="cate">
              <a href="#">Danh mục <i class="fa fa-list-ul"></i></a>
              <ul class="sub-menu">
                <?php
                foreach ($listCategory as $key) { ?>
                  <li><a href="<?= URL_ROOT . '/product/category/' . $key['id'] ?>?page=1"><?= $key['name'] ?></a></li>
                <?php }
                ?>
              </ul>
            </li>
            <li><a href="#">Giới thiệu <i class="fa fa-info-circle"></i></a></li>
            <?php
            if (isset($_SESSION['user_id'])) { ?>
              <li class="cate">
                <a href="#"><?= $_SESSION['user_name'] ?> <i class="fa fa-user-circle"></i></a>
                <ul class="sub-menu">
                  <li><a href="<?= URL_ROOT . "/user/info" ?>">Thông tin tài khoản <i class="fa fa-user"></i></a></li>
                  <li><a href="<?= URL_ROOT . "/order/checkout" ?>">Đơn hàng của tôi <i class="fa fa-list-alt"></i></a></li>
                  <li><a href="<?= URL_ROOT . "/user/logout" ?>">Đăng xuất <i class="fa fa-sign-out"></i></a></li>
                </ul>
              </li>
            <?php  } else { ?>
              <li class="menu-active"><a href="<?= URL_ROOT . "/user/register" ?>">Đăng ký <i class="fa fa-pencil-square"></i></a></li>
              <li><a href="<?= URL_ROOT . "/user/login" ?>">Đăng nhập <i class="fa fa-sign-in"></i></a></li>
              <li><a href="<?= URL_ROOT . "/product/viewed" ?>">Đã xem <i class="fa fa-history"></i></a></li>
            <?php  }
            ?>
            <li><a href="<?= URL_ROOT . "/cart/checkout" ?>" id="bag">Giỏ hàng <i class="fa fa-shopping-bag"></i> (<?= is_null($total) ? 0 : $total ?>)</a></li>
          </div>
        </ul>
      </nav>
    <div class="banner">
       
    </div>
    <div class="login">
        <div class="login-triangle"></div>
        <h2 class="login-header">Đăng ký</h2>
        <form action="<?= URL_ROOT ?>/user/register" class="login-container" method="post">
            <p><input type="text" placeholder="Họ tên" name="fullName" required></p>
            <p><input type="email" placeholder="Email" name="email" required></p>
            <p class="error"><?= isset($data['messageEmail']) ? $data['messageEmail'] : "" ?></p>
            <p><input type="text" placeholder="Số điện thoại" name="phone" required></p>
            <p class="error"><?= isset($data['messagePhone']) ? $data['messagePhone'] : "" ?></p>
            <p><input type="date" name="dob" required></p>
            <p><input type="text" placeholder="Địa chỉ" name="address" required></p>
            <p><input type="password" id="password" placeholder="Mật khẩu" name="password" required></p>
            <p><input type="password" placeholder="Nhập lại mật khẩu" name="repassword" required oninput="check(this)"></p>
            <p><input type="submit" value="Đăng ký"></p>
        </form>
    </div>
    <?php require APP_ROOT . '/views/client/inc/footer.php';?>
    <script language='javascript' type='text/javascript'>
        function check(input) {
            if (input.value != document.getElementById('password').value) {
                input.setCustomValidity('Password Must be Matching.');
            }else{
                input.setCustomValidity('');
            }
        }
    </script>
</body>