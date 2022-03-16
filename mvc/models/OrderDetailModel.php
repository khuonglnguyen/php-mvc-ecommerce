<?php
class OrderDetailModel
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new OrderDetailModel();
        }

        return self::$instance;
    }

    public function getByOrderId($orderId)
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM order_details WHERE orderId='$orderId'";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }
}
