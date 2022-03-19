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
                        <h3>Danh sách danh mục</h3>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên danh mục</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    foreach ($data['categoryList'] as $key => $value) {
                                    ?>
                                        <tr>
                                            <td><?= ++$count ?></td>
                                            <td><?= $value['name'] ?></td>
                                            <?php
                                            if ($value['status']) { ?>
                                                <td>Kích hoạt</td>
                                            <?php } else { ?>
                                                <td>Khóa</td>
                                            <?php }
                                            ?>
                                            <td>
                                                <a href="<?= URL_ROOT . '/categoryManage/changeStatus/' . $value['id'] ?>">
                                                    <?php
                                                    if (!$value['status']) {
                                                        echo 'Kích hoạt';
                                                    } else {
                                                        echo 'Khóa';
                                                    }
                                                    ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

        </main>

    </div>
</body>

</html>