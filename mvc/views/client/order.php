<?php require APP_ROOT . '/views/client/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/client/inc/nav.php'; ?>
    <div class="banner">

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
                <th>Ngày giao</th>
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
                        <?php if ($value['status'] == "received") { ?>
                            <td><?= $value['receivedDate'] ?></td>
                        <?php } else { ?>
                            <td><?= $value['receivedDate'] ?> (dự kiến)</td>
                        <?php } ?>
                    <?php } else { ?>
                        <td>3 ngày sau khi đơn hàng được xác nhận</td>
                    <?php }
                    ?>
                    <?php
                    if ($value['status'] == "delivery") { ?>
                        <td>Đang giao
                            <a href="<?= URL_ROOT . '/order/received/' . $value['id'] ?>">(Click vào nếu đã nhận được hàng)</a>
                        </td>
                    <?php } else if ($value['status'] == "processing") { ?>
                        <td>Chưa xác nhận</td>
                    <?php } else if ($value['status'] == "processed") { ?>
                        <td>Đã xác nhận</td>
                    <?php } else { ?>
                        <td>Hoàn thành</td>
                    <?php }
                    ?>
                    <td><?= $value['paymentMethod'] ?></td>
                    <?php
                    if ($value['paymentStatus']) { ?>
                        <td>Đã thanh toán</td>
                    <?php } else { ?>
                        <td>Chưa thanh toán
                            <a href="<?= URL_ROOT . '/order/payment/' . $value['id'] ?>">(Thanh toán ngay)</a>
                        </td>
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
    <?php require APP_ROOT . '/views/client/inc/footer.php'; ?>
</body>

</html>