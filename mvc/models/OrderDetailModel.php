<?php
class orderDetailModel
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new orderDetailModel();
        }

        return self::$instance;
    }

    public function getByorderId($orderId)
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM order_details WHERE orderId='$orderId'";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }
}
