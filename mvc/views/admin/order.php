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
                        <h3>Đơn hàng</h3>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã HD</th>
                                        <th>Ngày đặt</th>
                                        <th>Tình trạng</th>
                                        <th>Phương thức thanh toán</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    foreach ($data['orderList'] as $key => $value) {
                                    ?>
                                        <tr>
                                            <td><?= ++$count ?></td>
                                            <td><?= $value['id'] ?></td>
                                            <td><?= $value['createdDate'] ?></td>
                                            <td><?= $value['status'] ?></td>
                                            <td><?= $value['paymentMethod'] ?></td>
                                            <?php
                                            if ($value['paymentStatus']) { ?>
                                                <td>Đã thanh toán</td>
                                            <?php } else { ?>
                                                <td>Chưa thanh toán</td>
                                            <?php }
                                            ?>
                                            <td><a href="<?= URL_ROOT . '/orderManage/detail/' . $value['id'] ?>">Chi tiết</a></td>
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