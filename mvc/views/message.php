<?php require APP_ROOT . '/views/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/inc/nav.php'; ?>
    <div class="banner">
        <h1>SHOPPING ONLINE</h1>
        <p>Đặt hàng bất kì nơi đâu;)</p>
    </div>
    <div class="title">Thông báo</div>
    <h2><?= $data['message'] ?></h2>
    <?php require APP_ROOT . '/views/inc/footer.php'; ?>
</body>

</html>