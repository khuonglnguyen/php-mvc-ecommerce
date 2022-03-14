<?php require APP_ROOT . '/views/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/inc/nav.php'; ?>
    <div class="banner">
        <h1>SHOPPING ONLINE</h1>
        <p>Đặt hàng bất kì nơi đâu;)</p>
    </div>
    <div class="title">Giỏ hàng của tôi</div>
    <table id="table">

        <?php
        $count = 0;
        $total = 0;
        if (count($_SESSION['cart']) > 0) { ?>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thao tác</th>
            </tr>
            <?php foreach ($_SESSION['cart'] as $key => $value) {
                $total += $value['price'] * $value['quantity'];
            ?>
                <tr>
                    <td><?= ++$count ?></td>
                    <td><?= $value['productName'] ?></td>
                    <td><img class="img-table" src="<?= URL_ROOT . '/public/images/' . $value['productImage'] ?>" alt=""></td>
                    <td><input type="number" class="qty" name="" id="" value="<?= $value['quantity'] ?>"></td>
                    <td><?= number_format($value['price'], 0, '', ',') ?>VND</td>
                    <td><a href="<?= URL_ROOT . '/order/removeItemCart/' . $value['productId'] ?>" class="rm-item-cart"><i class="fa fa-trash"></i></a></td>
                </tr>
            <?php }
            ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Tổng tiền</td>
                <td><?= number_format($total, 0, '', ',') ?>VND</td>
            </tr>
        <?php } else {  ?>
            <h3>Giỏ hàng hiện đang trống...</h3>
        <?php }  ?>


    </table>
    <?php require APP_ROOT . '/views/inc/footer.php'; ?>
</body>

</html>