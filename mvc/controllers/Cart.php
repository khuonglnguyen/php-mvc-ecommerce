<?php

class cart extends ControllerBase
{
    public function addItemcart($productId)
    {
        if (!isset($_SESSION['user_id'])) {
            echo '<script>alert("Vui lòng đăng nhập để mua hàng!");
            window.location.href = "'.URL_ROOT.'/user/login";</script>';
        }
        $product = $this->model("productModel");
        $cart = $this->model("cartModel");
        $cartUser = ($cart->getByUserId($_SESSION['user_id']))->fetch_all(MYSQLI_ASSOC)[0];
        if ($cart->check($_SESSION['user_id'], $productId)) {
            $check = $product->checkQuantity($productId, $cartUser['quantity']);
            if ($check) {
                if (!$cart->updateQuanity($_SESSION['user_id'], $cartUser)) {
                    echo 'lỗi';
                    die();
                }
            } else {
                echo '<script>alert("Số lượng sản phẩm đã hết!");window.history.back();</script>';
            }
        } else {
            $result = $product->getById($productId);
            // Fetch
            $p = $result->fetch_assoc();
            if (!$cart->add($_SESSION['user_id'], $p)) {
                echo 'lỗi';
                die();
            }
        }
        echo '<script>alert("Thêm sản phẩm vào giỏ hàng thành công!");window.history.back();</script>';
    }

    public function updateItemcart($productId, $qty)
    {
        $product = $this->model("productModel");
        $cart = $this->model("cartModel");
        $check = $product->checkQuantity($productId, $qty);
        if ($check) {
            if (!$cart->editQuanity($_SESSION['user_id'], $productId, $qty)) {
                http_response_code(501);
            }
            http_response_code(200);
        } else {
            http_response_code(501);
        }
    }

    public function removeItemcart($productId)
    {
        $cart = $this->model("cartModel");
        if ($cart->remove($_SESSION['user_id'], $productId)) {
            echo '<script>alert("Xóa sản phẩm thành công!");window.history.back();</script>';
        } else {
            echo 'lỗi';
            die();
        }
    }

    public function getTotalPricecart()
    {
        $cart = $this->model("cartModel");
        return ($cart->getTotalPrice($_SESSION['user_id']))->fetch_assoc();
    }

    public function getTotalQuantitycart()
    {
        if (isset($_SESSION['user_id'])) {
            $cart = $this->model("cartModel");
            return ($cart->getTotalQuantitycart($_SESSION['user_id']))->fetch_assoc();
        }
        return 0;
    }

    public function checkout()
    {
        if (isset($_SESSION['user_id'])) {
        $cart = $this->model("cartModel");
        $result = ($cart->getByUserId($_SESSION['user_id']))->fetch_all(MYSQLI_ASSOC);
        $this->view("client/checkout", [
            "headTitle" => "Đơn hàng của tôi",
            'cart' => $result
        ]);
        }else {
            $this->view("client/checkout", [
                "headTitle" => "Đơn hàng của tôi"
            ]);
        }
    }
}
