<?php require APP_ROOT . '/views/client/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/client/inc/nav.php'; ?>
    <div class="banner">
       
    </div>
    <div class="title"><?= $data['title'] ?></div>
    <div class="search-container">
        <form action="<?= URL_ROOT ?>/product/search" method="get">
            <input type="text" class="search" placeholder="Tìm kiếm.." name="keyword">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div class="content">
        <?php
        if (count($data['productList']) > 0) {
            foreach ($data['productList'] as $key) { ?>
                <div class="card">
                    <?php
                    if ($key['promotionPrice'] < $key['originalPrice']) { ?>
                        <div class="discount">
                            -<?= ceil((($key['originalPrice']/$key['promotionPrice'])*100)-100) ?>%
                        </div>
                    <?php }
                    ?>
                    <div class="card-img">
                        <a href="<?= URL_ROOT . '/product/single/' . $key['id'] ?>"><img src="<?= URL_ROOT ?>/public/images/<?= $key['image'] ?>" class="product-image" alt=""></a>
                    </div>
                    <a href="<?= URL_ROOT . '/product/single/' . $key['id'] ?>">
                        <h1><?= $key['name'] ?></h1>
                    </a>
                    <?php
                    if ($key['promotionPrice'] < $key['originalPrice']) { ?>
                        <p class="promotion-price"><del><?= number_format($key['originalPrice'], 0, '', ',') ?>₫</del></p>
                    <?php }
                    ?>
                    <p class="original-price"><?= number_format($key['promotionPrice'], 0, '', ',') ?>₫</p>
                    <p class="qty-card">Kho: <?= $key['qty'] ?></p>
                    <p class="sold-count">Đã bán: <?= $key['soldCount'] ?></p>
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