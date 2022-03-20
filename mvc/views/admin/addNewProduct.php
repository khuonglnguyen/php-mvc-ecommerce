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
                        <h3>Thêm mới sản phẩm</h3>
                        <div class="form">
                            <form action="<?= URL_ROOT . '/productManage/add' ?>" method="POST" enctype="multipart/form-data">
                                <p class="<?= $data['cssClass'] ?>"><?= isset($data['message']) ? $data['message'] : "" ?></p>
                                <label for="name">Tên sản phẩm</label>
                                <input type="text" id="name" name="name" required>
                                <label for="cate">Danh mục</label>
                                <select name="cateId" id="cate">
                                    <?php
                                    foreach ($data['categoryList'] as $key => $value) { ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                    <?php }
                                    ?>
                                </select>
                                <label for="image">Hình ảnh</label>
                                <input type="file" id="image" name="image" required>
                                <label for="originalPrice">Giá gốc</label>
                                <input type="number" id="originalPrice" name="originalPrice" required>
                                <label for="promotionPrice">Giá khuyến mãi</label>
                                <input type="number" id="promotionPrice" name="promotionPrice" required>
                                <label for="qty">Số lượng</label>
                                <input type="number" id="qty" name="qty" required>
                                <label for="des">Mô tả</label>
                                <textarea name="des" id="des" cols="30" rows="10"></textarea>
                                <input type="submit" value="Lưu">
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </main>

    </div>
</body>

</html>