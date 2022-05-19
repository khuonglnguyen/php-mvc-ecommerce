<?php
class questionModel
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new questionModel();
        }

        return self::$instance;
    }

    public function getByProductId($productId)
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM `question` p JOIN users u ON p.userId = u.id WHERE productId=$productId";
        $result = mysqli_query($db->con, $sql);
        if (mysqli_num_rows($result) > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public function add($productId, $content, $userId)
    {
        $db = DB::getInstance();
        $sql = "INSERT INTO `question`(`id`, `productId`, `userId`, `content`,`createdDate`) VALUES (NULL," . $productId . "," . $userId . ",'" . $content . "','" . date("y-m-d H:i:s") . "')";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function reply($reply, $id)
    {
        $db = DB::getInstance();
        $sql = "UPDATE `question` SET reply = '" . $reply . "', repliedDate = '". date("y-m-d H:i:s")."' WHERE id = " . $id . "";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }
}
