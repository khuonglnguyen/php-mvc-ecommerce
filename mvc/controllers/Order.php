<?php

class Order extends ControllerBase
{
    public function addItemCart($productId)
    {
        if (isset($_SESSION['cart'][$productId])) {

            $_SESSION['cart'][$productId]['quantity']++;
        } else {
            $product = $this->model("ProductModel");
            $result = $product->getById($productId);
            // Fetch
            $p = $result->fetch_assoc();

            $_SESSION['cart'][$p['id']] = array(
                "productId"=>$p['id'],
                "productName" => $p['name'],
                "productImage" => $p['image'],
                "quantity" => 1,
                "price" => $p['promotionPrice']
            );
        }
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    public function removeItemCart($productId)
    {
        unset($_SESSION['cart'][$productId]);
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
        }
    }

    public function getTotalPriceCart()
    {
        if (isset($_SESSION['cart'])) {

            $total = 0;
            foreach ($_SESSION['cart'] as $key => $value) {
                $total += $value['price'];
            }
            return $total;
        }
    }

    public function getTotalQuantityCart()
    {
        if (isset($_SESSION['cart'])) {

            $total = 0;
            foreach ($_SESSION['cart'] as $key => $value) {
                $total += $value['quantity'];
            }
            return $total;
        }
    }

    public function checkout()
    {
        // $order = $this->model("OrderModel");
        // $result = $order->getByUserId($_SESSION['user_id']);
        // // Fetch
        // $listOrder = $result->fetch_all(MYSQLI_ASSOC);

        $this->view("checkout", [
            "headTitle" => "Đơn hàng của tôi"
        ]);
    }
}
