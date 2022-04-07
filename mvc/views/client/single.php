<?php require APP_ROOT . '/views/client/inc/head.php'; ?>

<body>
  <?php require APP_ROOT . '/views/client/inc/nav.php'; ?>
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
        <p><?= $data['product']['des'] ?></p>
      </div>
      <div class="product-price">
        <span><?= number_format($data['product']['promotionPrice'], 0, '', ',')  ?>₫</span>
        <a href="<?= URL_ROOT . '/cart/addItemcart/' .  $data['product']['id']  ?>" class="cart-btn">Thêm vào giỏ</a>
      </div>
    </div>
  </main>
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