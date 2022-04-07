    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar">
        <div class="sidebar-header">
            <h3 class="brand">
                <span class="ti-unlink"></span> 
                <span>HUYPHAM</span>
            </h3> 
            <label for="sidebar-toggle" class="ti-menu-alt"></label>
        </div>
        
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="<?= URL_ROOT . '/admin'?>">
                        <span class="ti-blackboard"></span>
                        <span>Tổng quan</span>
                    </a>
                </li>
                <li>
                    <a href="<?= URL_ROOT . '/chat/chatList' ?>">
                        <span class="ti-email"></span>
                        <span>Chat với khách hàng</span>
                    </a>
                </li>
                <li>
                    <a href="<?= URL_ROOT . '/productManage?page=1' ?>">
                        <span class="ti-archive"></span>
                        <span>Quản lý sản phẩm</span>
                    </a>
                </li>
                <li>
                    <a href="<?= URL_ROOT . '/categoryManage?page=1' ?>">
                        <span class="ti-package"></span>
                        <span>Quản lý danh mục</span>
                    </a>
                </li>
                <li>
                    <a href="<?= URL_ROOT . '/orderManage' ?>">
                        <span class="ti-agenda"></span>
                        <span>Quản lý đơn đặt hàng</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>