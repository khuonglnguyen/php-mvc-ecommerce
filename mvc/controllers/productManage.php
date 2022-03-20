<?php

class productManage extends ControllerBase
{
    public function index()
    {
        $product = $this->model("productModel");
        $result = $product->getAllAdmin();
        $productList = $result->fetch_all(MYSQLI_ASSOC);

        $this->view("admin/product", [
            "headTitle" => "Quản lý sản phẩm",
            "productList" => $productList
        ]);
    }

    public function add()
    {
        $category = $this->model("categoryModel");
        $result = $category->getAllAdmin();
        $categoryList = $result->fetch_all(MYSQLI_ASSOC);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $product = $this->model("productModel");
            $result = $product->insert($_POST);
            if ($result) {
                $this->view("admin/addNewProduct", [
                    "headTitle" => "Quản lý danh mục",
                    "cssClass" => "success",
                    "message" => "Thêm mới thành công!",
                    "name" => $_POST['name']
                ]);
            } else {
                $this->view("admin/addNewProduct", [
                    "headTitle" => "Quản lý danh mục",
                    "cssClass" => "error",
                    "message" => "Lỗi, vui lòng thử lại sau!",
                    "name" => $_POST['name']
                ]);
            }
        } else {
            $this->view("admin/addNewProduct", [
                "headTitle" => "Thêm mới danh mục",
                "cssClass" => "none",
                "categoryList" => $categoryList
            ]);
        }
    }

    public function edit($id = "")
    {
        $category = $this->model("categoryModel");
        $result = $category->getAllAdmin();
        $categoryList = $result->fetch_all(MYSQLI_ASSOC);

        $product = $this->model("productModel");
        $p = $product->getByIdAdmin($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $r = $product->update($_POST);
            $new = $product->getByIdAdmin($_POST['id']);
            if ($r) {
                $this->view("admin/editProduct", [
                    "headTitle" => "Xem/Cập nhật danh mục",
                    "cssClass" => "success",
                    "message" => "Cập nhật thành công!",
                    "categoryList" => $categoryList,
                    "product" => $new->fetch_assoc()
                ]);
            } else {
                $this->view("admin/editProduct", [
                    "headTitle" => "Xem/Cập nhật danh mục",
                    "cssClass" => "error",
                    "message" => "Lỗi, vui lòng thử lại sau!",
                    "categoryList" => $categoryList,
                    "product" => $new->fetch_assoc()
                ]);
            }
        } else {
            $this->view("admin/editProduct", [
                "headTitle" => "Xem/Cập nhật danh mục",
                "cssClass" => "none",
                "categoryList" => $categoryList,
                "product" => $p->fetch_assoc()
            ]);
        }
    }

    public function changeStatus($id)
    {
        $product = $this->model("productModel");
        $result = $product->changeStatus($id);
        if ($result) {
            $this->redirect("productManage");
        }
    }
}
