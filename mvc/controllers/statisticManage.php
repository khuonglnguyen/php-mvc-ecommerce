<?php
class statisticManage extends ControllerBase
{
    public function index()
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] != 'Admin') {
            $this->redirect("home");
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Khởi tạo model
            $statistic = $this->model("statisticModel");
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['type'] == "revenue") {
                    $this->redirect("statisticManage", "revenue");
                }
            }
        }

        $this->view("admin/statistic", [
            "headTitle" => "Thống kê"
        ]);
    }

    public function statistic()
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] != 'Admin') {
            $this->redirect("home");
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Khởi tạo model
            $statistic = $this->model("statisticModel");
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($_POST['type'] == "revenue") {
                    # code...
                }
                $result = $statistic->getRevenue();
                if ($result) {
                    $revenueList = $result->fetch_all(MYSQLI_ASSOC);
                }
            }
        }

        $this->view("admin/statistic", [
            "headTitle" => "Thống kê",
            "revenueList" => $revenueList
        ]);
    }

    public function revenue()
    {
        if (isset($_GET['from']) && isset($_GET['to'])) {
            $statistic = $this->model("statisticModel");
            $result = $statistic->getRevenue($_GET['from'], $_GET['to']);
            if ($result) {
                $revenueList = $result->fetch_all(MYSQLI_ASSOC);
            }

            $this->view("admin/revenueStatistic", [
                "headTitle" => "Thống kê",
                "from" => $_GET['from'],
                "to" => $_GET['to'],
                "revenueList" => $revenueList
            ]);
        }
        $this->view("admin/revenueStatistic", [
            "headTitle" => "Thống kê"
        ]);
    }

    public function revenueToExcel($from, $to)
    {
        $statistic = $this->model("statisticModel");
        $result = $statistic->getRevenue($from, $to);
        if ($result) {
            $revenueList = $result->fetch_all(MYSQLI_ASSOC);

            $columnHeader = '';
            $columnHeader = "STT" . "\t" . "Doanh thu" . "\t" . "Ngày" . "\t";
            $setData = '';
            $count = 1;
            foreach ($revenueList as $key => $value) {
                $rowData = $count . "\t";
                foreach ($value as $v) {
                    $v = '"' . $v . '"' . "\t";
                    $rowData .= $v;
                }
                $setData .= trim($rowData) . "\n";
            }
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=doanh-thu(".$from." den ".$to.").xls");
            header("Pragma: no-cache");
            header("Expires: 0");

            echo ucwords($columnHeader) . "\n" . $setData . "\n";
        }
    }

    // public function add()
    // {
    //     if (isset($_SESSION['role']) && $_SESSION['role'] != 'Admin') {
    //         $this->redirect("home");
    //     }

    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         // Khởi tạo model
    //         $voucher = $this->model("voucherModel");
    //         // Gọi hàm insert để thêm mới vào csdl
    //         $result = $voucher->insert($_POST);
    //         if ($result) {
    //             $this->view("admin/addNewVoucher", [
    //                 "headTitle" => "Quản lý voucher",
    //                 "cssClass" => "success",
    //                 "message" => "Thêm mới thành công!",
    //                 "name" => $_POST['name']
    //             ]);
    //         } else {
    //             $this->view("admin/addNewVoucher", [
    //                 "headTitle" => "Quản lý voucher",
    //                 "cssClass" => "error",
    //                 "message" => "Lỗi, vui lòng thử lại sau!",
    //                 "name" => $_POST['name']
    //             ]);
    //         }
    //     } else {
    //         $this->view("admin/addNewVoucher", [
    //             "headTitle" => "Thêm mới voucher",
    //             "cssClass" => "none",
    //         ]);
    //     }
    // }

    // public function changeStatus($id)
    // {
    //     $voucher = $this->model("voucherModel");
    //     $result = $voucher->changeStatus($id);
    //     if ($result) {
    //         $this->redirect("voucherManage");
    //     }
    // }
}
