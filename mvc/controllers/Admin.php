<?php

class Admin extends ControllerBase
{
    public function Index()
    {
        if (isset($_SESSION['role']) && $_SESSION['role'] != 'Admin') {
            $this->redirect("home");
        }

        $user = $this->model("userModel");
        $order = $this->model("orderModel");
        $result = $order->getAll($_SESSION['user_id']);
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
