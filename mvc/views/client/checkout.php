<?php require APP_ROOT . '/views/client/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/client/inc/nav.php'; ?>
    <div class="banner">

    </div>
    <div class="title">Giỏ hàng của tôi</div>
    <table id="table">

        <?php
        $count = 0;
        $total = 0;
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
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
                    <td><input type="number" class="qty" name="" id="<?= $value['productId'] ?>" value="<?= $value['quantity'] ?>" onchange="update(this)"></td>
                    <td><?= number_format($value['price'], 0, '', ',') ?>VND</td>
                    <td><a href="<?= URL_ROOT . '/cart/removeItemcart/' . $value['productId'] ?>" class="rm-item-cart"><i class="fa fa-trash"></i></a></td>
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
    <div class="payment">
        <?php
        if (isset($_SESSION['user_id'])) { ?>
                <a href="<?= URL_ROOT . '/order/add/' . $total ?>" class="cart-btn">Đặt hàng</a>
        <?php } else { ?>
            <a class="cart-btn" href="<?= URL_ROOT . '/user/login/' ?>">Đăng nhập để mua hàng</a>
        <?php }
        ?>
    </div>
    <?php require APP_ROOT . '/views/client/inc/footer.php'; ?>
    <script>
        function update(e) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "http://localhost/luanvan/cart/updateItemcart/" + e.id + "/" + e.value, true);
            xhr.onload = function() {
                if (xhr.readyState === 4) {
                    if (xhr.readyState === 4) {
                        var status = xhr.status;
                        if (status === 200) {
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);

                        } else if (status === 501) {
                            alert('Số lượng sản phẩm không đủ để thêm vào giỏ hàng!');
                            // e.value = parseInt(e.value) - 1;
                            window.location.reload();
                        } else {
                            alert('Cập nhật giỏ hàng thất bại!');
                            window.location.reload();
                        }
                    }
                }
            };
            xhr.onerror = function(e) {
                console.error(xhr.statusText);
            };
            xhr.send(null);
        }
    </script>
</body>

</html>