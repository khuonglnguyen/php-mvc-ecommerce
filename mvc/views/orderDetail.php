<?php require APP_ROOT . '/views/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/inc/nav.php'; ?>
    <div class="banner">
        <h1>SHOPPING ONLINE</h1>
        <p>Đặt hàng bất kì nơi đâu;)</p>
    </div>
    <div class="title">Đơn đặt hàng: <?= $data['orderId'] ?></div>
    <table id="table">
        <?php
        $count = 0;
        if (count($data['orderDetailList']) > 0) { ?>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
            </tr>
            <?php foreach ($data['orderDetailList'] as $key => $value) {
                $total += $value['productPrice'] * $value['qty'];
            ?>
                <tr>
                    <td><?= ++$count ?></td>
                    <td><?= $value['productName'] ?></td>
                    <td><img class="img-table" src="<?= URL_ROOT . '/public/images/' . $value['productImage'] ?>" alt=""></td>
                    <td><?= $value['qty'] ?></td>
                    <td><?= number_format($value['productPrice'], 0, '', ',') ?>VND</td>
                </tr>
            <?php }
            ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Tổng tiền</td>
                <td><?= number_format($total, 0, '', ',') ?>VND</td>
            </tr>
        <?php } else {  ?>
            <h3>Chưa có đơn đặt hàng...</h3>
        <?php }  ?>
    </table>
    <?php require APP_ROOT . '/views/inc/footer.php'; ?>
</body>

</html>