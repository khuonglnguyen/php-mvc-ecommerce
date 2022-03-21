<?php require APP_ROOT . '/views/client/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/client/inc/nav.php'; ?>
    <?php require_once APP_ROOT . '/core/Config.php'; ?>
    <div class="banner">

    </div>
    <div class="title">Thông báo</div>
    <div class="message-container">
        <h2 class="success"><?= $data['message'] ?></h2>
        <h3><?= isset($data['thanks']) ? $data['thanks'] : "" ?></h3>
        <a href="<?= URL_ROOT ?>" class="cart-btn">Tiếp tục mua hàng</a>
    </div>
    <?php require APP_ROOT . '/views/client/inc/footer.php'; ?>
</body>

</html>