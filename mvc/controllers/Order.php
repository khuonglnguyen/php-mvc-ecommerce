<?php

class order extends ControllerBase
{
    public function add($total)
    {
        $order = $this->model("orderModel");
        $result = $order->add($_SESSION['user_id'], $total);

        if ($result) {
            $this->redirect("order", "message", [
                "message" => "success"
            ]);
        } else {
            $this->redirect("order", "message", [
                "message" => "fail"
            ]);
        }
    }

    public function checkout()
    {
        $order = $this->model("orderModel");
        $result = $order->getByuserId($_SESSION['user_id']);
        // Fetch
        $orderList = $result->fetch_all(MYSQLI_ASSOC);

        $this->view("client/order", [
            "headTitle" => "Đơn đặt hàng của tôi",
            "orderList" => $orderList
        ]);
    }

    public function detail($orderId)
    {
        $orderDetail = $this->model("orderDetailModel");
        $result = $orderDetail->getByorderId($orderId);
        // Fetch
        $orderDetailList = $result->fetch_all(MYSQLI_ASSOC);

        $this->view("client/orderDetail", [
            "headTitle" => "Chi tiết đơn hàng: " . $orderId,
            "orderId" => $orderId,
            "orderDetailList" => $orderDetailList
        ]);
    }

    public function message($message)
    {
        if ($message == "success") {
            $this->view("client/message", [
                "headTitle" => "Thông báo",
                "message" => "Đặt hàng thành công!",
                "thanks" => "Cuộc sống có nhiều lựa chọn, cảm ơn vì bạn đã chọn và tin tưởng HUYPHAM STORE!"
            ]);
        } else {
            $this->view("client/message", [
                "headTitle" => "Thông báo",
                "message" => "Đặt hàng thất bại!"
            ]);
        }
    }

    public function returnPayment()
    {
        if ($_GET['vnp_TransactionStatus'] == "00") {
            $order = orderModel::getInstance();
            $result = $order->payment($_GET['orderId']);
        }
        $this->view("client/returnPayment", [
            "headTitle" => "Thông báo",
        ]);
    }

    public function payment($orderId = "")
    {
        $order = $this->model("orderModel");
        $result = $order->getById($orderId);
        $o = $result->fetch_assoc();

        $user = $this->model("userModel");
        $r = $user->getById($_SESSION['user_id']);
        $u = $r->fetch_assoc();


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $vnp_TmnCode = "3304R5EJ"; //Website ID in VNPAY System
            $vnp_HashSecret = "OOSMDHRGUXTNDDQGJTPWOLYDPFXHQMYE"; //Secret key
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = URL_ROOT . "/order/returnPayment/?orderId=" . $o['id'] . "&&";
            $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
            //Config input format
            //Expire
            $startTime = date("YmdHis");
            $expire = date('YmdHis', strtotime('+15 minutes', strtotime(date("YmdHis"))));


            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
            date_default_timezone_set('Asia/Ho_Chi_Minh');

            /**
             * Description of vnpay_ajax
             *
             * @author xonv
             */
            require_once APP_ROOT . '/core/Config.php';


            $vnp_TxnRef = $_POST['order_id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_orderInfo = $_POST['order_desc'];
            $vnp_orderType = $_POST['order_type'];
            $vnp_Amount = $_POST['amount'] * 100;
            $vnp_Locale = $_POST['language'];
            $vnp_BankCode = $_POST['bank_code'];
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            //Add Params of 2.0.1 Version
            $vnp_ExpireDate = $_POST['txtexpire'];
            //Billing
            $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
            $vnp_Bill_Email = $_POST['txt_billing_email'];
            $fullName = trim($_POST['txt_billing_fullname']);
            if (isset($fullName) && trim($fullName) != '') {
                $name = explode(' ', $fullName);
                $vnp_Bill_FirstName = array_shift($name);
                $vnp_Bill_LastName = array_pop($name);
            }
            $vnp_Bill_Address = $_POST['txt_inv_addr1'];
            $vnp_Bill_City = $_POST['txt_bill_city'];
            $vnp_Bill_Country = $_POST['txt_bill_country'];
            $vnp_Bill_State = $_POST['txt_bill_state'];
            // Invoice
            $vnp_Inv_Phone = $_POST['txt_inv_mobile'];
            $vnp_Inv_Email = $_POST['txt_inv_email'];
            $vnp_Inv_Customer = $_POST['txt_inv_customer'];
            $vnp_Inv_Address = $_POST['txt_inv_addr1'];
            $vnp_Inv_Company = $_POST['txt_inv_company'];
            $vnp_Inv_Taxcode = $_POST['txt_inv_taxcode'];
            $vnp_Inv_Type = $_POST['cbo_inv_type'];
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_orderInfo" => $vnp_orderInfo,
                "vnp_orderType" => $vnp_orderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
                "vnp_ExpireDate" => $vnp_ExpireDate,
                "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
                "vnp_Bill_Email" => $vnp_Bill_Email,
                "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
                "vnp_Bill_LastName" => $vnp_Bill_LastName,
                "vnp_Bill_Address" => $vnp_Bill_Address,
                "vnp_Bill_City" => $vnp_Bill_City,
                "vnp_Bill_Country" => $vnp_Bill_Country,
                "vnp_Inv_Phone" => $vnp_Inv_Phone,
                "vnp_Inv_Email" => $vnp_Inv_Email,
                "vnp_Inv_Customer" => $vnp_Inv_Customer,
                "vnp_Inv_Address" => $vnp_Inv_Address,
                "vnp_Inv_Company" => $vnp_Inv_Company,
                "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
                "vnp_Inv_Type" => $vnp_Inv_Type
            );
            

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array(
                'code' => '00', 'message' => 'success', 'data' => $vnp_Url
            );
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            }
            header('Location: ' . $vnp_Url);
        } else {
            $this->view("client/payment", [
                "headTitle" => "Thanh toán",
                "order" => $o,
                "user" => $u
            ]);
        }
    }

    public function received($orderId)
    {
        $order = $this->model("orderModel");
        $result = $order->received($orderId);
        if ($result) {
            $this->redirect("order", "checkout");
        }
    }
}
