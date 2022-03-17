<?php require APP_ROOT . '/views/client/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/client/inc/nav.php'; ?>
    <div class="banner">
       
    </div>
    <div class="title"><?= $data['title'] ?></div>
    <div class="content">
        <?php
        if (count($data['productList']) > 0) {
            foreach ($data['productList'] as $key) { ?>
                <div class="card">
                    <a href="<?= URL_ROOT . '/product/single/' . $key['id'] ?>"><img src="<?= URL_ROOT ?>/public/images/<?= $key['image'] ?>" class="product-image" alt=""></a>
                    <a href="<?= URL_ROOT . '/product/single/' . $key['id'] ?>">
                        <h1><?= $key['name'] ?></h1>
                    </a>
                    <p class="price"><?= number_format($key['promotionPrice'], 0, '', ',') ?>VND</p>
                    <p><a href="<?= URL_ROOT . '/cart/addItemcart/' . $key['id'] ?>"><button>Thêm vào giỏ</button></a></p>
                </div>
            <?php }
        } else { ?>
            <h3>Không tìm thấy sản phẩm...</h3>
        <?php }
        ?>
    </div>
    <?php require APP_ROOT . '/views/client/inc/footer.php'; ?>
</body>

</html>