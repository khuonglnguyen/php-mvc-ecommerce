<?php require APP_ROOT . '/views/inc/head.php';?>

<body>
    <?php require APP_ROOT . '/views/inc/nav.php'; ?>
    <div class="banner">
        <h1>SHOPPING ONLINE</h1>
        <p>Đặt hàng bất kì nơi đâu;)</p>
    </div>
    <div class="title">Sản phẩm</div>
    <main class="container">

    <!-- Left Column / Headphones Image -->
    <div class="left-column">
      <img src="<?= URL_ROOT ?>/public/images/R.jpg" alt="">
    </div>


    <!-- Right Column -->
    <div class="right-column">

      <!-- Product Description -->
      <div class="product-description">
        <h1><?= $data['product']['name'] ?></h1>
        <p><?= $data['product']['des'] ?></p>
      </div>
      <!-- Product Pricing -->
      <div class="product-price">
        <span><?= $data['product']['promotionPrice'] ?></span>
        <a href="#" class="cart-btn">Thêm vào giỏ</a>
      </div>
    </div>
  </main>
        <?php require APP_ROOT . '/views/inc/footer.php'; ?>
</body>
</html>