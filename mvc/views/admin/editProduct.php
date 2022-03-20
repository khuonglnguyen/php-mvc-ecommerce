<?php require APP_ROOT . '/views/admin/inc/head.php'; ?>

<body>
    <?php require APP_ROOT . '/views/admin/inc/sidebar.php'; ?>

    <div class="main-content">
        <header>
            <div class="search-wrapper">
                <span class="ti-search"></span>
                <input type="search" placeholder="Search">
            </div>

            <div class="social-icons">
                <span class="ti-bell"></span>
                <span class="ti-comment"></span>
                <div></div>
            </div>
        </header>
        <main>
            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">
                        <h3>Cập nhật sản phẩm</h3>
                        <div class="form">
                            <form action="<?= URL_ROOT . '/productManage/edit' ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $data['product']['id'] ?>">
                                <p class="<?= $data['cssClass'] ?>"><?= isset($data['message']) ? $data['message'] : "" ?></p>
                                <label for="name">Tên sản phẩm</label>
                                <input type="text" id="name" name="name" required value="<?= $data['product']['name'] ?>">
                                <label for="cate">Danh mục</label>
                                <select name="cateId" id="cate">
                                    <?php
                                    foreach ($data['categoryList'] as $key => $value) { ?>
                                        <?php
                                        if ($value['id'] == $data['product']['cateId']) { ?>
                                            <option selected value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                        <?php  } else { ?>
                                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                        <?php }
                                        ?>
                                    <?php }
                                    ?>
                                </select>
                                <label for="image">Hình ảnh</label>
                                <p>
                                    <img src="<?= URL_ROOT . '/public/images/' . $data['product']['image'] ?>" alt="">
                                </p>
                                <label for="image">Chọn hình ảnh mới</label>
                                <input type="file" id="image" name="image">
                                <label for="originalPrice">Giá gốc</label>
                                <input type="number" id="originalPrice" name="originalPrice" required value="<?= $data['product']['originalPrice'] ?>">
                                <label for="promotionPrice">Giá khuyến mãi</label>
                                <input type="number" id="promotionPrice" name="promotionPrice" required value="<?= $data['product']['promotionPrice'] ?>">
                                <label for="qty">Số lượng</label>
                                <input type="number" id="qty" name="qty" required value="<?= $data['product']['qty'] ?>">
                                <label for="des">Mô tả</label>
                                <textarea name="des" id="des" cols="30" rows="10"><?= $data['product']['des'] ?></textarea>
                                <input type="submit" value="Lưu">
                                <a href="<?= URL_ROOT . '/productManage' ?>" class="back">Trở về</a>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </main>

    </div>
</body>

</html>