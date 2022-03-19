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

    public function changeStatus($id)
    {
        $category = $this->model("categoryModel");
        $result = $category->changeStatus($id);
        if ($result) {
            $this->redirect("categoryManage");
        }
    }
}
