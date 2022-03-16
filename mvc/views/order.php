<?php require APP_ROOT . '/views/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/inc/nav.php'; ?>
    <div class="banner">
        <h1>SHOPPING ONLINE</h1>
        <p>Đặt hàng bất kì nơi đâu;)</p>
    </div>
    <div class="title">Đơn đặt hàng của tôi</div>
    <table id="table">
        <?php
        $count = 0;
        if (count($data['orderList']) > 0) { ?>
            <tr>
                <th>STT</th>
                <th>Mã HD</th>
                <th>Ngày đặt</th>
                <th>Ngày giao (dự kiến)</th>
                <th>Tình trạng</th>
                <th>Phương thức thanh toán</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
            <?php foreach ($data['orderList'] as $key => $value) {
            ?>
                <tr>
                    <td><?= ++$count ?></td>
                    <td><?= $value['id'] ?></td>
                    <td><?= $value['createdDate'] ?></td>
                    <?php
                    if ($value['receivedDate']) { ?>
                        <td><?= $value['receivedDate'] ?></td>
                    <?php } else { ?>
                        <td>3 ngày sau khi đơn hàng được xác nhận</td>
                        <?php }
                    ?>
                    <td><?= $value['status'] ?></td>
                    <td><?= $value['paymentMethod'] ?></td>
                    <?php
                    if ($value['paymentStatus']) { ?>
                        <td>Đã thanh toán</td>
                    <?php } else { ?>
                        <td>Chưa thanh toán</td>
                    <?php }
                    ?>
                    <td><a href="<?= URL_ROOT . '/order/detail/' . $value['id'] ?>">Chi tiết</a></td>
                </tr>
            <?php }
            ?>
        <?php } else {  ?>
            <h3>Chưa có đơn đặt hàng...</h3>
        <?php }  ?>
    </table>
    <?php require APP_ROOT . '/views/inc/footer.php'; ?>
</body>

</html>