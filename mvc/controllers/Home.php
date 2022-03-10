<?php
class Home extends ControllerBase{
    public function Index(){
        $product = $this->model("ProductModel");
        $result = $product->getFeaturedProducts();

        $category = $this->model("CategoryModel");
        $cates = $category->getAllClient();
        // Fetch
        $productList = $result->fetch_all(MYSQLI_ASSOC);
        $this->view("index", [
            "headTitle" => "Trang chủ",
            "productList" => $productList,
            "cates" => $cates
        ]);
    }
}
?>