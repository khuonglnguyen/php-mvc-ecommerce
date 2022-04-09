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

    function bubble_sort($arr)
    {
        $size = count($arr) - 1;
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size - $i; $j++) {
                $k = $j + 1;
                if ($arr[$k]['date'] > $arr[$j]['date']) {
                    list($arr[$j], $arr[$k]) = array($arr[$k], $arr[$j]);
                }
            }
        }
        return $arr;
    }

    public function removeViewed()
    {
        unset($_SESSION['viewed']);
        $this->redirect('product', 'viewed');
    }

    public function single($Id)
    {
        $product = $this->model("productModel");
        $result = $product->getById($Id);
        // Fetch
        $p = $result->fetch_assoc();
        $c = $product->getByCateIdSinglePage($p['cateId'],$Id);
        $list = $c->fetch_all(MYSQLI_ASSOC);

        if (!isset($_SESSION['viewed'])) {
            $_SESSION['viewed'] = [];
        }
        $index = 0;
        $s = false;
        foreach ($_SESSION['viewed'] as $key => $value) {
            if ($value['id'] == $Id) {
                $s = true;
                $_SESSION['viewed'][$index] = [
                    'id' => $Id,
                    'date' => date("d/m/Y h:i:sa")
                ];
                break;
            }
            $index++;
        }
        if (!$s) {
            $_SESSION['viewed'][count($_SESSION['viewed'])] = [
                'id' => $Id,
                'date' => date("d/m/Y h:i:sa")
            ];
        }
        $_SESSION['viewed'] = $this->bubble_sort($_SESSION['viewed']);

        $this->view("client/single", [
            "headTitle" => $p['name'],
            "product" => $p,
            "productByCate" => $list
        ]);
    }

    public function viewed()
    {
        $arr = [];
        if (isset($_SESSION['viewed'])) {
            $product = $this->model('productModel');
            foreach ($_SESSION['viewed'] as $key => $value) {
                $result = ($product->getById($value['id']))->fetch_assoc();
                array_push($arr, $result);
            }
        }

        $this->view('client/viewed', [
            "headTitle" => "Sản phẩm đã xem",
            "productList" => $arr
        ]);
    }

    public function category($CateId, $page)
    {
        $product = $this->model('productModel');
        $result = $product->getByCateId(isset($page['page']) ? $page['page'] : 1, 8, $CateId);

        $category = $this->model('categoryModel');
        $cate = ($category->getById($CateId))->fetch_assoc();
        $countPaging = $product->getCountPagingByClient($CateId, 8);

        // Fetch
        $productList = $result->fetch_all(MYSQLI_ASSOC);
        $this->view('client/category', [
            "headTitle" => "Danh mục " . $cate['name'],
            "title" => "Danh mục " . $cate['name'],
            "productList" => $productList,
            'countPaging' => $countPaging,
            'CateId' => $CateId
        ]);
    }
}
