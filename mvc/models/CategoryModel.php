<?php
class categoryModel
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new categoryModel();
        }

        return self::$instance;
    }

    public function getAllClient()
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM categories WHERE status=1";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function getAllAdmin()
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM categories";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function getById($Id)
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM categories WHERE Id='$Id' AND status=1";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function changeStatus($Id)
    {
        $db = DB::getInstance();
        $sql = "UPDATE categories SET status = !status WHERE Id='$Id'";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }
}
