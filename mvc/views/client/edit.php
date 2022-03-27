<?php require APP_ROOT . '/views/client/inc/head.php'; ?>

<body>
  <?php require APP_ROOT . '/views/client/inc/nav.php'; ?>
  <div class="banner">

  </div>
  <div class="login">
    <div class="login-triangle"></div>
    <h2 class="login-header">Thông tin tài khoản</h2>
    <form action="<?= URL_ROOT ?>/user/edit" class="login-container" method="post">
      <p><input type="text" placeholder="Họ tên" name="fullName" required value="<?= $data['user']['fullName'] ?>"></p>
      <p><input type="email" placeholder="Email" name="email" required readonly value="<?= $data['user']['email'] ?>"></p>
      <p class="error"><?= isset($data['messageEmail']) ? $data['messageEmail'] : "" ?></p>
      <p><input type="text" placeholder="Số điện thoại" name="phone" required value="<?= $data['user']['phone'] ?>"></p>
      <p class="error"><?= isset($data['messagePhone']) ? $data['messagePhone'] : "" ?></p>
      <p><input type="date" name="dob" required value="<?= $data['user']['dob'] ?>"></p>
      <p><input type="text" placeholder="Địa chỉ" name="address" required value="<?= $data['user']['address'] ?>"></p>
      <p><input type="submit" value="Lưu"></p>            
    </form>
  </div>
  <?php require APP_ROOT . '/views/client/inc/footer.php'; ?>
</body>

</html>