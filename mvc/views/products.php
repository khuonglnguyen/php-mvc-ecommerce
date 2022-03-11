<?php require APP_ROOT . '/views/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/inc/nav.php'; ?>
    <div class="banner">
        <h1>SHOPPING ONLINE</h1>
        <p>Đặt hàng bất kì nơi đâu;)</p>
    </div>
    <div class="title"><?= $data['title'] ?></div>
    <div class="search-container">
        <form action="<?= URL_ROOT ?>/product/search" method="post">
            <input type="text" class="search" placeholder="Tìm kiếm.." name="keyword">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
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
                    <p><button>Thêm vào giỏ</button></p>
                </div>
            <?php }
        } else { ?>
            <h3>Không tìm thấy sản phẩm...</h3>
        <?php }
        ?>
    </div>
    <?php require APP_ROOT . '/views/inc/footer.php'; ?>
</body>

</html>