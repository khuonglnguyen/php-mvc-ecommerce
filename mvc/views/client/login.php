<?php require APP_ROOT . '/views/client/inc/head.php'; ?>

<body>
  <?php require APP_ROOT . '/views/client/inc/nav.php'; ?>
  <div class="banner">

  </div>
  <div class="login">
    <div class="login-triangle"></div>
    <h2 class="login-header">Đăng nhập</h2>
    <form action="<?= URL_ROOT ?>/user/login" class="login-container" method="post">
      <p><input type="email" placeholder="Email" name="email" required></p>
      <p><input type="password" placeholder="Mật khẩu" name="password" required></p>
      <p class="error"><?= isset($data['message']) ? $data['message'] : "" ?></p>
      <p><input type="submit" value="Đăng nhập"></p>
    </form>
  </div>
  <?php require APP_ROOT . '/views/client/inc/footer.php'; ?>
</body>

</html>