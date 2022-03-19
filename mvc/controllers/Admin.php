<?php

class Admin extends ControllerBase
{
    public function Index()
    {
        $user = $this->model("userModel");
        $result = $user->getRole(isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "0");
        if ($result) {
            // Fetch
            $r = $result->fetch_assoc();
            if ($r['roleId'] != "1") {
                $this->redirect("home");
            }
        } else {
            $this->redirect("home");
        }

        $order = $this->model("orderModel");
        $result = $order->getByuserId($_SESSION['user_id']);
        // Fetch
        $orderList = $result->fetch_all(MYSQLI_ASSOC);

        $totalRevenue = $order->getTotalRevenue();
        $totalOrderCompleted = $order->getTotalOrderCompleted();
        $totalClient = $user->getTotalClient();

        $this->view("admin/index", [
            "headTitle" => "Trang quản trị",
            "orderList" => $orderList,
            "totalRevenue" => $totalRevenue->fetch_assoc(),
            "totalClient" => $totalClient->fetch_assoc(),
            "totalOrderCompleted" => $totalOrderCompleted->fetch_assoc()
        ]);
    }
}
