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
        $sql = "SELECT * FROM Orders WHERE userId='$userId'";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function add($userId, $paymentMethod)
    {
        $db = DB::getInstance();
        $sql = "INSERT INTO `orders` (`id`, `userId`, `createdDate`, `receivedDate`, `status`, `paymentMethod`, `paymentStatus`) VALUES (NULL, '$userId', '" . date('d/m/y') . "', NULL, 'processing', '$paymentMethod',0)";
        $result = mysqli_query($db->con, $sql);

        if ($result) {
            $last_id = $db->con->insert_id;

            foreach ($_SESSION['cart'] as $key => $value) {
                $s = "INSERT INTO `order_details` (`id`, `orderId`, `productId`, `qty`, `productPrice`, `productName`, `productImage`) VALUES (NULL," . $last_id . ", '" . $value['productId'] . "', '" . $value['quantity'] . "', " . $value['price'] . ", '" . $value['productName'] . "', '" . $value['productImage'] . "')";
                $result = mysqli_query($db->con, $s);

                // Update qty
                $sqlUpdateQty = "UPDATE products SET qty = qty - " . $value['quantity'] . " WHERE id = " . $value['productId'] . "";
                $r = mysqli_query($db->con, $sqlUpdateQty);
            }
        }else {
            return false;
        }

        unset($_SESSION['cart']);
        return true;
    }
}
