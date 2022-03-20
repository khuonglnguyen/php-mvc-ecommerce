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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $category = $this->model("categoryModel");
            $result = $category->insert($_POST['name']);
            if ($result) {
                $this->view("admin/addNewCategory", [
                    "headTitle" => "Quản lý danh mục",
                    "cssClass" => "success",
                    "message" => "Thêm mới thành công!",
                    "name" => $_POST['name']
                ]);
            } else {
                $this->view("admin/addNewCategory", [
                    "headTitle" => "Quản lý danh mục",
                    "cssClass" => "error",
                    "message" => "Lỗi, vui lòng thử lại sau!",
                    "name" => $_POST['name']
                ]);
            }
        } else {
            $this->view("admin/addNewCategory", [
                "headTitle" => "Thêm mới danh mục",
                "cssClass" => "none",
            ]);
        }
    }

    public function edit($id = "")
    {
        $category = $this->model("categoryModel");
        $c = $category->getByIdAdmin($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $r = $category->update($_POST['id'], $_POST['name']);
            $new = $category->getByIdAdmin($_POST['id']);
            if ($r) {
                $this->view("admin/editCategory", [
                    "headTitle" => "Xem/Cập nhật danh mục",
                    "cssClass" => "success",
                    "message" => "Cập nhật thành công!",
                    "category" => $new->fetch_assoc()
                ]);
            } else {
                $this->view("admin/editCategory", [
                    "headTitle" => "Xem/Cập nhật danh mục",
                    "cssClass" => "error",
                    "message" => "Lỗi, vui lòng thử lại sau!",
                    "category" => $new->fetch_assoc()
                ]);
            }
        } else {
            $this->view("admin/editCategory", [
                "headTitle" => "Xem/Cập nhật danh mục",
                "cssClass" => "none",
                "category" => $c->fetch_assoc()
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
