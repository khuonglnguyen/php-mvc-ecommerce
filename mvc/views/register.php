<?php require APP_ROOT . '/views/inc/head.php';?>
<body>
    <?php require APP_ROOT . '/views/inc/nav.php';?>
    <div class="banner">
        <h1>SHOPPING ONLINE</h1>
        <p>Đặt hàng bất kì nơi đâu;)</p>
    </div>
    <div class="login">
        <div class="login-triangle"></div>
        <h2 class="login-header">Đăng ký</h2>
        <form action="<?= URL_ROOT ?>/user/register" class="login-container" method="post">
            <p><input type="text" placeholder="Họ tên" name="fullName" required></p>
            <p><input type="email" placeholder="Email" name="email" required></p>
            <p class="error"><?= isset($data['messageEmail']) ? $data['messageEmail'] : "" ?></p>
            <p><input type="text" placeholder="Số điện thoại" name="phone" required></p>
            <p class="error"><?= isset($data['messagePhone']) ? $data['messagePhone'] : "" ?></p>
            <p><input type="date" name="dob" required></p>
            <p><input type="text" placeholder="Địa chỉ" name="address" required></p>
            <p><input type="password" id="password" placeholder="Mật khẩu" name="password" required></p>
            <p><input type="password" placeholder="Nhập lại mật khẩu" name="repassword" required oninput="check(this)"></p>
            <p><input type="submit" value="Đăng ký"></p>
        </form>
    </div>
    <?php require APP_ROOT . '/views/inc/footer.php';?>
    <script language='javascript' type='text/javascript'>
        function check(input) {
            if (input.value != document.getElementById('password').value) {
                input.setCustomValidity('Password Must be Matching.');
            }else{
                input.setCustomValidity('');
            }
        }
    </script>
</body>