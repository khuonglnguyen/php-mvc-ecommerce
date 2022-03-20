<?php

class categoryManage extends ControllerBase
{
    public function index()
    {
        $category = $this->model("categoryModel");
        $result = $category->getAllAdmin();
        $categoryList = $result->fetch_all(MYSQLI_ASSOC);

        $this->view("admin/category", [
            "headTitle" => "Quản lý danh mục",
            "categoryList" => $categoryList
        ]);
    }

    public function add()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $category = $this->model("categoryModel");
            $result = $category->insert($_POST['name']);
            if ($result) {
                $this->view("admin/addNewCategory", [
                    "headTitle" => "Quản lý danh mục",
                    "cssClass"=>"success",
                    "message"=>"Thêm mới thành công!",
                    "name"=>$_POST['name']
                ]);
            }else {
                $this->view("admin/addNewCategory", [
                    "headTitle" => "Quản lý danh mục",
                    "cssClass"=>"error",
                    "message"=>"Lỗi, vui lòng thử lại sau!",
                    "name"=>$_POST['name']
                ]);
            }
        }else {
            $this->view("admin/addNewCategory", [
                "headTitle" => "Thêm mới danh mục",
                "cssClass"=>"none",
            ]);
        }
    }

    public function changeStatus($id)
    {
        $category = $this->model("categoryModel");
        $result = $category->changeStatus($id);
        if ($result) {
            $this->redirect("categoryManage");
        }
    }
}
