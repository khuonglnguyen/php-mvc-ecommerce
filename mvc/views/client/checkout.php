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
          <li><a href="<?= URL_ROOT . "/user/register" ?>">Đăng ký <i class="fa fa-pencil-square"></i></a></li>
          <li><a href="<?= URL_ROOT . "/user/login" ?>">Đăng nhập <i class="fa fa-sign-in"></i></a></li>
          <li><a href="<?= URL_ROOT . "/product/viewed" ?>">Đã xem <i class="fa fa-history"></i></a></li>
        <?php  }
        ?>
        <li class="menu-active"><a href="<?= URL_ROOT . "/cart/checkout" ?>" id="bag">Giỏ hàng <i class="fa fa-shopping-bag"></i> (<?= is_null($total) ? 0 : $total ?>)</a></li>
      </div>
    </ul>
  </nav>
  <div class="banner">

  </div>
  <div class="title">Giỏ hàng của tôi</div>
  <table id="table">

    <?php
    $count = 0;
    $total = 0;
    if (isset($data['cart']) && count($data['cart']) > 0) { ?>
      <tr>
        <th>STT</th>
        <th>Tên sản phẩm</th>
        <th>Hình ảnh</th>
        <th>Số lượng</th>
        <th>Đơn giá</th>
        <th>Thao tác</th>
      </tr>
      <?php foreach ($data['cart'] as $key => $value) {
        $total += $value['productPrice'] * $value['quantity'];
      ?>
        <tr>
          <td><?= ++$count ?></td>
          <td><?= $value['productName'] ?></td>
          <td><img class="img-table" src="<?= URL_ROOT . '/public/images/' . $value['image'] ?>" alt=""></td>
          <td><input type="number" class="qty" name="" id="<?= $value['productId'] ?>" value="<?= $value['quantity'] ?>" onchange="update(this)"></td>
          <td><?= number_format($value['productPrice'], 0, '', ',') ?>₫</td>
          <td><a href="<?= URL_ROOT . '/cart/removeItemcart/' . $value['productId'] ?>" class="rm-item-cart"><i class="fa fa-trash"></i></a></td>
        </tr>
      <?php }
      ?>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Tổng tiền</td>
        <?php
        if (isset($_SESSION['voucher'])) { ?>
          <td>Đã áp dụng mã giảm giá: (<?= $_SESSION['voucher']['code'] . ') -' . $_SESSION['voucher']['percentDiscount'] ?>% <a href="<?= URL_ROOT ?>/cart/cancelVoucher">(Hủy)</a><br> <del><?= number_format(($total), 0, '', ',') ?>₫ <br> </del><?= number_format($total - ($total / 100 * $_SESSION['voucher']['percentDiscount']), 0, '', ',') ?>₫</td>
        <?php } else { ?>
          <td><?= number_format(($total), 0, '', ',') ?>₫</td>
        <?php }
        ?>
      </tr>
    <?php } else {  ?>
      <h3 style="text-align: center;">Giỏ hàng hiện đang trống...</h3>
    <?php }  ?>
  </table>
  <?php
  if (isset($_SESSION['cart']) && !isset($_SESSION['voucher'])) { ?>
    <div class="login">
      <form action="<?= URL_ROOT ?>/cart/voucher" class="login-container" method="post">
        <p><input type="text" placeholder="Mã giảm giá" name="code" required></p>
        <p class="<?= isset($data['cssClass']) ? $data['cssClass'] : "" ?>"><?= isset($data['message']) ? $data['message'] : "" ?></p>
        <p><input type="submit" value="Áp dụng"></p>
      </form>
    </div>
  <?php }
  ?>
  <div class="payment">
    <?php
    if (isset($_SESSION['user_id'])) {
      if (isset($_SESSION['voucher'])) { ?>
        <a href="<?= URL_ROOT . '/order/add/' . ($total - ($total / 100 * $_SESSION['voucher']['percentDiscount'])) ?>" class="cart-btn">Đặt hàng</a>
      <?php } else if (isset($_SESSION['cart'])) { ?>
        <a href="<?= URL_ROOT . '/order/add/' . $total ?>" class="cart-btn">Đặt hàng</a>
      <?php } else { ?>
        <a class="cart-btn" href="<?= URL_ROOT . '/user/login/' ?>">Đăng nhập để mua hàng</a>
      <?php } ?>
    <?php } else { ?>
      <a class="cart-btn" href="<?= URL_ROOT . '/user/login/' ?>">Đăng nhập để mua hàng</a>
    <?php }
    ?>
  </div>
  <?php require APP_ROOT . '/views/client/inc/footer.php'; ?>
  <script>
    function update(e) {
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "http://localhost/luanvan/cart/updateItemcart/" + e.id + "/" + e.value, true);
      xhr.onload = function() {
        if (xhr.readyState === 4) {
          if (xhr.readyState === 4) {
            var status = xhr.status;
            if (status === 200) {
              setTimeout(function() {
                window.location.reload();
              }, 1000);

            } else if (status === 501) {
              alert('Số lượng sản phẩm không đủ để thêm vào giỏ hàng!');
              // e.value = parseInt(e.value) - 1;
              window.location.reload();
            } else {
              alert('Cập nhật giỏ hàng thất bại!');
              window.location.reload();
            }
          }
        }
      };
      xhr.onerror = function(e) {
        console.error(xhr.statusText);
      };
      xhr.send(null);
    }
  </script>
</body>

</html>