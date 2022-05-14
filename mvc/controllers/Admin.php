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
        $revenueMonth = $order->getRevenueMonth()->fetch_all(MYSQLI_ASSOC);
        $totals = [];
        for ($i = 0; $i < count($revenueMonth); $i++) {
            $totals[$i] = $revenueMonth[$i]['total'];
        }

        $days = [];
        for ($i = 0; $i < count($revenueMonth); $i++) {
            $days[$i] = $revenueMonth[$i]['day'];
        }

        $this->view("admin/index", [
            "headTitle" => "Trang quản trị",
            "orderList" => $orderList,
            "totalRevenue" => $totalRevenue->fetch_assoc(),
            "totalClient" => $totalClient->fetch_assoc(),
            "totalOrderCompleted" => $totalOrderCompleted->fetch_assoc(),
            "totals" => $totals,
            "days" => $days
        ]);
    }
}
