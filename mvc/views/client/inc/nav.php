      <?php
      $cart = new cart();
      $total = $cart->getTotalQuantitycart();
      
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
            <li><a href="<?= URL_ROOT ?>">Trang chủ</a></li>
            <li class="cate">
              <a href="#">Danh mục</a>
              <ul class="sub-menu">
                <?php
                foreach ($listCategory as $key) { ?>
                  <li><a href="<?= URL_ROOT . '/product/category/' . $key['id'] ?>"><?= $key['name'] ?></a></li>
                <?php }
                ?>
              </ul>
            </li>
            <li><a href="#">Giới thiệu</a></li>
            <?php
            if (isset($_SESSION['user_id'])) { ?>
              <li class="cate">
                <a href="#">Tài khoản</a>
                <ul class="sub-menu">
                  <li><a href="<?= URL_ROOT . "/user/info" ?>">Thông tin tài khoản</a></li>
                  <li><a href="<?= URL_ROOT . "/order/checkout" ?>">Đơn hàng của tôi</a></li>
                  <li><a href="<?= URL_ROOT . "/user/logout" ?>">Đăng xuất</a></li>
                </ul>
              </li>
            <?php  } else { ?>
              <li><a href="<?= URL_ROOT . "/user/register" ?>">Đăng ký</a></li>
              <li><a href="<?= URL_ROOT . "/user/login" ?>">Đăng nhập</a></li>
            <?php  }
            ?>
            <li><a href="<?= URL_ROOT . "/cart/checkout" ?>"><i class="fa fa-shopping-bag"></i> (<?= $total ?>)</a></li>
          </div>
        </ul>
      </nav>