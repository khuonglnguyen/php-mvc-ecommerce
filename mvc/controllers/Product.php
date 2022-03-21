<?php

class product extends ControllerBase
{
    public function search()
    {
        $product = $this->model("productModel");
        $result = $product->search($_GET['keyword']);
        $productList = [];
        if ($result) {
            // Fetch
            $productList = $result->fetch_all(MYSQLI_ASSOC);
        }
        $this->view("client/products", [
            "headTitle" => "Tìm kiếm",
            "title" => "Tìm kiếm với từ khóa: " . $_GET['keyword'],
            "productList" => $productList
        ]);
    }

    public function single($Id)
    {
        $product = $this->model("productModel");
        $result = $product->getById($Id);
        // Fetch
        $p = $result->fetch_assoc();
        $this->view("client/single", [
            "headTitle" => $p['name'],
            "product" => $p
        ]);
    }

    public function category($CateId)
    {
        $product = $this->model('productModel');
        $result = $product->getByCateId($CateId);

        $category = $this->model('categoryModel');
        $cate = ($category->getById($CateId))->fetch_assoc();

        // Fetch
        $productList = $result->fetch_all(MYSQLI_ASSOC);
        $this->view('client/category', [
            "headTitle" => "Danh mục " . $cate['name'],
            "title" => "Danh mục " . $cate['name'],
            "productList" => $productList
        ]);
    }
}
