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

            <h2 class="dash-title">TỔNG QUAN</h2>

            <div class="dash-cards">
                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-briefcase"></span>
                        <div>
                            <h5>TỎNG DOANH THU</h5>
                            <h4><?= number_format($data['totalRevenue']['total'], 0, '', ',') ?> VND</h4>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-user"></span>
                        <div>
                            <h5>KHÁCH HÀNG</h5>
                            <h4><?= number_format($data['totalClient']['total'], 0, '', ',') ?></h4>
                        </div>
                    </div>
                </div>

                <div class="card-single">
                    <div class="card-body">
                        <span class="ti-check-box"></span>
                        <div>
                            <h5>ĐƠN HÀNG HOÀN THÀNH</h5>
                            <h4><?= $data['totalOrderCompleted']['total'] ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">
                        <h3>Đơn hàng mới</h3>
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
                                            <?php
                                            if ($value['status'] == "processing") { ?>
                                                <td><span class="gray">Chưa xác nhận</span></td>
                                            <?php  } else if ($value['status'] == "processed") { ?>
                                                <td><span class="blue">Đã xác nhận</span></td>
                                            <?php } else if ($value['status'] == "delivery") { ?>
                                                <td><span class="yellow">Đang giao hàng</span></td>
                                            <?php }else{ ?>
                                                <td><span class="active">Hoàn thành</span></td>
                                            <?php }
                                            ?>
                                            <td><?= $value['paymentMethod'] ?></td>
                                            <?php
                                            if ($value['paymentStatus']) { ?>
                                                <td><span class="active">Đã thanh toán</span></td>
                                            <?php } else { ?>
                                                <td><span class="gray">Chưa thanh toán</span></td>
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