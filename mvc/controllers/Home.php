<?php
class Home extends ControllerBase{
    public function Index(){
        $product = $this->model("ProductModel");
        $result = $product->getFeaturedProducts();
        // Fetch
        $productList = $result->fetch_all(MYSQLI_ASSOC);
        $this->view("index", [
            "headTitle" => "Trang chủ",
            "productList" => $productList
        ]);
    }
}
?>