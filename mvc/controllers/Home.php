<?php
class home extends ControllerBase
{
    public function Index()
    {
        $product = $this->model("productModel");
        $Featuredproducts = $product->getFeaturedproducts();
        $Newproducts = $product->getNewproducts();
        // Fetch
        $FeaturedproductsList = $Featuredproducts->fetch_all(MYSQLI_ASSOC);
        $NewproductsList = $Newproducts->fetch_all(MYSQLI_ASSOC);
        $this->view("client/index", [
            "headTitle" => "Trang chủ",
            "FeaturedproductsList" => $FeaturedproductsList,
            "NewproductsList" => $NewproductsList,
        ]);
    }
}
