<?php require APP_ROOT . '/views/client/inc/head.php'; ?>

<body>
  <?php
  $cart = new cart();
  if (!isset($_SESSION['cart'])) {
    $total = (isset($cart->getTotalQuantitycart()['total']) ? $cart->getTotalQuantitycart()['total'] : 0);
  } else {
    $total = $cart->getTotal();
  }

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
        <li class="cate menu-active">
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
  <div class="banner">

  </div>
  <div class="title">Sản phẩm</div>
  <main class="container">
    <div class="left-column">
      <img src="<?= URL_ROOT ?>/public/images/<?= $data['product']['image'] ?>" alt="">
    </div>
    <div class="right-column">
      <div class="product-description">
        <h1><?= $data['product']['name'] ?></h1>
        Đánh giá:
        <?php
        if ($data['star'] > 0) {
          for ($i = 0; $i < $data['star']; $i++) { ?>
            <i class="fa fa-star" style="color: orange;"></i>
            <?php }
          echo $data['star'];
            ?>/5
          <?php } else { ?>
            Chưa có đánh giá
          <?php } ?> <br>
          <?php
          if ($data['loved']) { ?>
            <a href="#">Đã thêm vào DS yêu thích <i class="fa fa-heart"></i></a>
          <?php } else { ?>
            <a href="<?= URL_ROOT . '/product/addFavorite/' .  $data['product']['id']  ?>">Thêm vào DS yêu thích <i class="fa fa-heart"></i></a>
          <?php }
          ?>
          <p><?= $data['product']['des'] ?></p>
      </div>
      <div class="product-price">
        <span><?= number_format($data['product']['promotionPrice'], 0, '', ',')  ?>₫</span>
        <a href="<?= URL_ROOT . '/cart/addItemcart/' .  $data['product']['id']  ?>" class="cart-btn">Thêm vào giỏ</a>
      </div>
    </div>
  </main>
  <div class="title2">Đánh giá</div>
  <div class="rating">
    <?php
    if (count($data['productRatingContent']) > 0) {
      foreach ($data['productRatingContent'] as $key => $value) { ?>
        <div class="rate">
          <div class="user-name">
            Khách hàng <b><?= $value['fullName'] ?> </b> (<?= $value['time'] ?>)
          </div>
          <div class="user-star">
            <?php
            for ($i = 0; $i < $value['star']; $i++) { ?>
              <i class="fa fa-star" style="color: orange;"></i>
            <?php }
            ?>
          </div>
          <div class="user-content">
            <?= $value['content'] ?>
          </div>
          <div class="reply">
            <div class="user-name">
              <i class="fa fa-reply" aria-hidden="true"></i>
              Phản hồi từ <b>Nguyễn Văn A </b>(Quản trị viên) 1/1/2022
            </div>
            <div class="user-content">
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eveniet aut maxime autem dignissimos voluptate necessitatibus laborum aliquam eligendi reiciendis quisquam, quam illum sit adipisci obcaecati sint ullam earum quo delectus?
            </div>
          </div>
        </div>
      <?php }
    } else { ?>
      Chưa có đánh giá
    <?php } ?>
  </div>
  <div class="title2">Sản phẩm cùng loại</div>
  <div class="content">
    <?php
    if (count($data['productByCate']) > 0) {
      foreach ($data['productByCate'] as $key) { ?>
        <div class="card">
          <?php
          if ($key['promotionPrice'] < $key['originalPrice']) { ?>
            <div class="discount">
              -<?= ceil((($key['originalPrice'] / $key['promotionPrice']) * 100) - 100) ?>%
            </div>
          <?php }
          ?>
          <div class="card-img">
            <a href="<?= URL_ROOT . '/product/single/' . $key['id'] ?>"><img src="<?= URL_ROOT ?>/public/images/<?= $key['image'] ?>" class="product-image" alt=""></a>
          </div>
          <a href="<?= URL_ROOT . '/product/single/' . $key['id'] ?>">
            <h1><?= $key['name'] ?></h1>
          </a>
          <?php
          if ($key['promotionPrice'] < $key['originalPrice']) { ?>
            <p class="promotion-price"><del><?= number_format($key['originalPrice'], 0, '', ',') ?>₫</del></p>
          <?php }
          ?>
          <p class="original-price"><?= number_format($key['promotionPrice'], 0, '', ',') ?>₫</p>
          <p class="qty-card">Kho: <?= $key['qty'] ?></p>
          <p class="sold-count">Đã bán: <?= $key['soldCount'] ?></p>
          <p><a href="<?= URL_ROOT . '/cart/addItemcart/' . $key['id'] ?>"><button>Thêm vào giỏ</button></a></p>
        </div>
      <?php }
    } else { ?>
      <h3>Không tìm thấy sản phẩm...</h3>
    <?php }
    ?>
  </div>
  <?php require APP_ROOT . '/views/client/inc/footer.php'; ?>
</body>

</html>