<?php require APP_ROOT . '/views/client/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/client/inc/nav.php'; ?>
    <div class="banner">

    </div>
    <div class="title">Thông tin tài khoản</div>
    <!--Begin display -->
    <div class="login login-container">
        <?php
        if (!is_array($data['message'])) { ?>
            <h3 class="success"><?= isset($data['message']) ? $data['message'] : "" ?></h3>
        <?php } 
        ?>
        <div class="header clearfix">
            <h3 class="text-muted">Thông tin tài khoản</h3>
        </div>
        <div class="table-responsive">
            <div>
                <label>Họ tên:</label>
                <label><?= $data['user']['fullName'] ?></label>
            </div>
            <div>

                <label>Email:</label>
                <label><?= $data['user']['email'] ?></label>
            </div>
            <div>
                <label>Số điện thoại:</label>
                <label><?= $data['user']['phone'] ?></label>
            </div>
            <div>
                <label>Ngày sinh:</label>
                <label><?= $data['user']['dob'] ?></label>
            </div>
            <div>
                <label>Địa chỉ:</label>
                <label><?= $data['user']['address'] ?></label>
            </div>
            <div>
                <label>Mật khẩu:</label>
                <label>♥♥♥♥♥♥♥♥</label>
            </div>
            <a href="<?= URL_ROOT . '/user/edit'  ?>" class="cart-btn">Chỉnh sửa thông tin</a>
            <a href="<?= URL_ROOT . '/user/resetPassword'  ?>" class="cart-btn">Đổi mật khẩu</a>
        </div>
    </div>
    <?php require APP_ROOT . '/views/client/inc/footer.php'; ?>
</body>

</html>