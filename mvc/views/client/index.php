<?php require APP_ROOT . '/views/client/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/client/inc/nav.php'; ?>
    <div class="banner">

    </div>
    <div class="title">Sản phẩm nổi bật</div>
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
                    <div class="card-img">
                        <a href="<?= URL_ROOT . '/product/single/' . $key['id'] ?>"><img src="<?= URL_ROOT ?>/public/images/<?= $key['image'] ?>" class="product-image" alt=""></a>
                    </div>
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
    <?php require APP_ROOT . '/views/client/inc/chatbox.php'; ?>
    <?php require APP_ROOT . '/views/client/inc/footer.php'; ?>
</body>

</html>