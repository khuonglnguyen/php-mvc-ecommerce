<?php
class home extends ControllerBase
{
    public function Index()
    {
        $product = $this->model("productModel");
        $result = $product->getFeaturedproducts();
        // Fetch
        $productList = $result->fetch_all(MYSQLI_ASSOC);
        $this->view("client/index", [
            "headTitle" => "Trang chủ",
            "productList" => $productList
        ]);
    }
}
