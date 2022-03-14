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

    public function category($CateId)
    {
        $product = $this->model('ProductModel');
        $result = $product->getByCateId($CateId);

        $category = $this->model('CategoryModel');
        $cate = ($category->getById($CateId))->fetch_assoc();

        // Fetch
        $productList = $result->fetch_all(MYSQLI_ASSOC);
        $this->view('category', [
            "headTitle" => "Danh mục " . $cate['name'],
            "title" => "Danh mục " . $cate['name'],
            "productList" => $productList
        ]);
    }
}
