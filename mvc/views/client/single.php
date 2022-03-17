<?php require APP_ROOT . '/views/client/inc/head.php';?>

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
        <span><?= number_format($data['product']['promotionPrice'], 0, '', ',')  ?>VND</span>
        <a href="<?= URL_ROOT . '/cart/addItemcart/' .  $data['product']['id']  ?>" class="cart-btn">Thêm vào giỏ</a>
      </div>
    </div>
  </main>
        <?php require APP_ROOT . '/views/client/inc/footer.php'; ?>
</body>
</html>