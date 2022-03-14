<?php
class OrderModel
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new OrderModel();
        }

        return self::$instance;
    }

    public function getByUserId($userId)
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM Orders WHERE userId=''$userId'";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function getById($Id)
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM Orders WHERE Id='$Id'";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }
}
