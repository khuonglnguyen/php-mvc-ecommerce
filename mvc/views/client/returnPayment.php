<?php require APP_ROOT . '/views/client/inc/head.php'; ?>

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
    <div class="search-container">
      <form action="<?= URL_ROOT ?>/product/search" method="get">
        <input type="text" class="search" placeholder="Tìm kiếm.." name="keyword">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div>
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

        <?php
        if (isset($_SESSION['user_id'])) { ?>
          <li class="cate">
            <a href="#"><?= $_SESSION['user_name'] ?> <i class="fa fa-user-circle"></i></a>
            <ul class="sub-menu">
              <li><a href="<?= URL_ROOT . "/user/info" ?>">Thông tin tài khoản <i class="fa fa-user"></i></a></li>
              <li><a href="<?= URL_ROOT . "/product/favorite" ?>">Sản phẩm yêu thích <i class="fa fa-heart"></i></a></li>
              <li><a href="<?= URL_ROOT . "/product/viewed" ?>">Đã xem <i class="fa fa-history"></i></a></li>
              <li><a href="<?= URL_ROOT . "/order/checkout" ?>">Đơn hàng của tôi <i class="fa fa-list-alt"></i></a></li>
              <li><a href="<?= URL_ROOT . "/user/logout" ?>">Đăng xuất <i class="fa fa-sign-out"></i></a></li>
            </ul>
          </li>
        <?php  } else { ?>
          <li><a href="<?= URL_ROOT . "/user/register" ?>">Đăng ký <i class="fa fa-pencil-square"></i></a></li>
          <li><a href="<?= URL_ROOT . "/user/login" ?>">Đăng nhập <i class="fa fa-sign-in"></i></a></li>
        <?php  }
        ?>
        <li><a href="<?= URL_ROOT . "/cart/checkout" ?>" id="bag">Giỏ hàng <i class="fa fa-shopping-bag"></i> (<?= is_null($total) ? 0 : $total ?>)</a></li>
      </div>
    </ul>
  </nav>
  <?php require_once APP_ROOT . '/core/Config.php'; ?>
  <div class="banner">

  </div>
  <div class="title">Thông báo</div>
  <?php

  $vnp_HashSecret = "OOSMDHRGUXTNDDQGJTPWOLYDPFXHQMYE"; //Secret key
  $vnp_SecureHash = $_GET['vnp_SecureHash'];
  $inputData = array();
  foreach ($_GET as $key => $value) {
    if (substr($key, 0, 4) == "vnp_") {
      $inputData[$key] = $value;
    }
  }

  unset($inputData['vnp_SecureHash']);
  ksort($inputData);
  $i = 0;
  $hashData = "";
  foreach ($inputData as $key => $value) {
    if ($i == 1) {
      $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
    } else {
      $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
      $i = 1;
    }
  }

  $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
  ?>
  <div class="login">
    <div class="login-container">
      <div>
        <label>Mã đơn hàng:</label>
        <label><?php echo $_GET['vnp_TxnRef'] ?></label>
      </div>
      <div>

        <label>Số tiền:</label>
        <label><?php echo $_GET['vnp_Amount'] / 100 ?></label>
      </div>
      <div>
        <label>Nội dung thanh toán:</label>
        <label><?php echo isset($_GET['vnp_orderInfo']) ? $_GET['vnp_orderInfo'] : "None" ?></label>
      </div>
      <div>
        <label>Mã phản hồi (vnp_ResponseCode):</label>
        <label><?php echo $_GET['vnp_ResponseCode'] ?></label>
      </div>
      <div>
        <label>Mã GD Tại VNPAY:</label>
        <label><?php echo $_GET['vnp_TransactionNo'] ?></label>
      </div>
      <div>
        <label>Mã Ngân hàng:</label>
        <label><?php echo $_GET['vnp_BankCode'] ?></label>
      </div>
      <div>
        <label>Thời gian thanh toán:</label>
        <label><?php echo $_GET['vnp_PayDate'] ?></label>
      </div>
      <div>
        <label>Kết quả:</label>
        <label>
          <?php
          if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
              echo "<h2 style='color:green'>Thanh toán thành công</h2>";
            } else {
              echo "<h2 style='color:red'>Thanh toán thất bại</h2>";
            }
          } else {
            echo "<h2 style='color:red'>Chữ ký không hợp lệ</h2>";
          }
          ?>

        </label>
      </div>
      <a href="<?= URL_ROOT . '/order/checkout' ?>">Xem đơn hàng</a>
    </div>
  </div>

  <?php require APP_ROOT . '/views/client/inc/footer.php'; ?>
</body>

</html>