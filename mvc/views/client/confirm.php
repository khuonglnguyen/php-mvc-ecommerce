<?php require APP_ROOT . '/views/client/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/client/inc/nav.php'; ?>
    <div class="banner">
       
    </div>
    <div class="login">
    <div class="login-triangle"></div>
    <h2 class="login-header">Xác minh tài khoản</h2>
    <form action="<?= URL_ROOT ?>/user/confirm/<?= $data['email'] ?>" class="login-container" method="post">
        <p>Mã xác minh đã được gửi đến: <?= $data['email'] ?></p>
      <p><input type="text" placeholder="Mã xác minh" name="captcha" required></p>
      <p class="<?= isset($data["cssClass"]) ? $data["cssClass"] : "" ?>"><?= isset($data['message']) ? $data['message'] : "" ?></p>
      <p><input type="submit" value="Xác minh"></p>
    </form>
  </div>
        <?php require APP_ROOT . '/views/client/inc/footer.php'; ?>
</body>

</html>