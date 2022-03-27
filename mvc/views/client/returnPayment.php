<?php require APP_ROOT . '/views/client/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/client/inc/nav.php'; ?>
    <?php require_once APP_ROOT . '/core/Config.php'; ?>
    <div class="banner">

    </div>
    <div class="title">Thông báo</div>
    <?php

    $vnp_HashSecret = "OOSMDHRGUXTNDDQGJTPWOLYDPFXHQMYE"; //Secret key
    $vnp_SecureHash = $_GET['vnp_SecureHash'];
    $inputData = array();
    foreach ($_GET as $key => $value) {
        if (substr($key, 0, 4) == "vnp_") {
            $inputData[$key] = $value;
        }
    }

    unset($inputData['vnp_SecureHash']);
    ksort($inputData);
    $i = 0;
    $hashData = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
    }

    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
    ?>
    <div class="login">
        <div class="login-container">
            <div>
                <label>Mã đơn hàng:</label>
                <label><?php echo $_GET['vnp_TxnRef'] ?></label>
            </div>
            <div>

                <label>Số tiền:</label>
                <label><?php echo $_GET['vnp_Amount'] / 100 ?></label>
            </div>
            <div>
                <label>Nội dung thanh toán:</label>
                <label><?php echo isset($_GET['vnp_orderInfo']) ? $_GET['vnp_orderInfo'] : "None" ?></label>
            </div>
            <div>
                <label>Mã phản hồi (vnp_ResponseCode):</label>
                <label><?php echo $_GET['vnp_ResponseCode'] ?></label>
            </div>
            <div>
                <label>Mã GD Tại VNPAY:</label>
                <label><?php echo $_GET['vnp_TransactionNo'] ?></label>
            </div>
            <div>
                <label>Mã Ngân hàng:</label>
                <label><?php echo $_GET['vnp_BankCode'] ?></label>
            </div>
            <div>
                <label>Thời gian thanh toán:</label>
                <label><?php echo $_GET['vnp_PayDate'] ?></label>
            </div>
            <div>
                <label>Kết quả:</label>
                <label>
                    <?php
                    if ($secureHash == $vnp_SecureHash) {
                        if ($_GET['vnp_ResponseCode'] == '00') {
                            echo "<h2 style='color:green'>Thanh toán thành công</h2>";
                        } else {
                            echo "<h2 style='color:red'>Thanh toán thất bại</h2>";
                        }
                    } else {
                        echo "<h2 style='color:red'>Chữ ký không hợp lệ</h2>";
                    }
                    ?>

                </label>
            </div>
            <a href="<?= URL_ROOT.'/order/checkout' ?>">Xem đơn hàng</a>
        </div>
    </div>

    <?php require APP_ROOT . '/views/client/inc/footer.php'; ?>
</body>

</html>