<?php require APP_ROOT . '/views/client/inc/head.php';?>
<body>
    <?php require APP_ROOT . '/views/client/inc/nav.php';?>
    <div class="banner">
       
    </div>
    <div class="login">
        <div class="login-triangle"></div>
        <h2 class="login-header">Đổi mật khẩu</h2>
        <form action="<?= URL_ROOT ?>/user/resetPassword" class="login-container" method="post">
            <p><input type="password" id="password" placeholder="Mật khẩu hiện tại" name="password" required></p>
            <p class="error"><?= isset($data['messagePassword']) ? $data['messagePassword'] : "" ?></p>
            <p><input type="password" id="newPassword" placeholder="Mật khẩu mới" name="newPassword" required></p>
            <p><input type="password" placeholder="Nhập lại mật khẩu mới" name="reNewPassword" required oninput="check(this)"></p>
            <p><input type="submit" value="Đổi mật khẩu"></p>
        </form>
    </div>
    <?php require APP_ROOT . '/views/client/inc/footer.php';?>
    <script language='javascript' type='text/javascript'>
        function check(input) {
            if (input.value != document.getElementById('newPassword').value) {
                input.setCustomValidity('Nhập lại mật khẩu mới không trùng khớp.');
            }else{
                input.setCustomValidity('');
            }
        }
    </script>
</body>