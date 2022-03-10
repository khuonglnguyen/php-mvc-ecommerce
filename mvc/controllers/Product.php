<?php

class Product extends ControllerBase
{
    public function search()
    {
        $keyword = $_POST['keyword'];
        $product = $this->model("ProductModel");
        $result = $product->search($keyword);
        // Fetch
        $productList = $result->fetch_all(MYSQLI_ASSOC);
        $this->view("products", [
            "headTitle" => "Tìm kiếm",
            "title" => "Tìm kiếm với từ khóa: " . $keyword,
            "productList" => $productList
        ]);
    }

    public function single($Id)
    {
        $product = $this->model("ProductModel");
        $result = $product->getById($Id);
        // Fetch
        $p = $result->fetch_assoc();
        $this->view("single", [
            "headTitle" => $p['name'],
            "product" => $p
        ]);
    }

    public function category($CateId){
        $product = $this->model("ProductModel");
        $result = $product->getByCateId($CateId);
        
        $category = $this->model("CategoryModel");
        $cates = ($category->getById($CateId))->fetch_assoc();
        $cateMenu = $category->getAllClient();

        // Fetch
        $productList = $result->fetch_all(MYSQLI_ASSOC);
        $this->view("products", [
            "headTitle" => "Danh mục ".$cates['name'],
            "title"=>"Danh mục ".$cates['name'],
            "productList" => $productList,
            "cates"=>$cateMenu
        ]);
    }
}
