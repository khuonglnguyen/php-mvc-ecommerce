<?php

class cart extends ControllerBase
{
    public function addItemcart($productId)
    {
        $product = $this->model("productModel");

        if (isset($_SESSION['cart'][$productId])) {
            $check = $product->checkQuantity($productId, $_SESSION['cart'][$productId]['quantity']);
            if ($check) {
                $_SESSION['cart'][$productId]['quantity']++;
            } else {
                echo '<script>alert("Số lượng sản phẩm đã hết!");window.history.back();</script>';
            }
        } else {
            $result = $product->getById($productId);
            // Fetch
            $p = $result->fetch_assoc();

            $_SESSION['cart'][$p['id']] = array(
                "productId" => $p['id'],
                "productName" => $p['name'],
                "productImage" => $p['image'],
                "quantity" => 1,
                "price" => $p['promotionPrice']
            );
        }
        echo '<script>alert("Thêm sản phẩm vào giỏ hàng thành công!");window.history.back();</script>';
    }

    public function updateItemcart($productId, $qty)
    {
        $product = $this->model("productModel");
        $check = $product->checkQuantity($productId, $qty);
        if ($check) {
            $_SESSION['cart'][$productId]['quantity'] = $qty;
            http_response_code(200);
        } else {
            http_response_code(501);
        }
    }

    public function removeItemcart($productId)
    {
        unset($_SESSION['cart'][$productId]);
        if (!isset($_SESSION['cart'][$productId])) {
            echo '<script>alert("Xóa sản phẩm thành công!");window.history.back();</script>';
        }
    }

    public function getTotalPricecart()
    {
        if (isset($_SESSION['cart'])) {

            $total = 0;
            foreach ($_SESSION['cart'] as $key => $value) {
                $total += $value['price'] * $value['quantity'];
            }
            return $total;
        }
    }

    public function getTotalQuantitycart()
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
        $this->view("client/checkout", [
            "headTitle" => "Đơn hàng của tôi"
        ]);
    }
}
