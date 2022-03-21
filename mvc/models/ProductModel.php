<?php
class productModel
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new productModel();
        }

        return self::$instance;
    }

    public function search($keyword)
    {
        $db = DB::getInstance();
        $sql = "";
        if (count(explode(" ", $keyword)) > 1) {
            $sql = "SELECT p.id, p.name, p.image, p.promotionPrice FROM products p JOIN categories c ON p.cateId = c.id WHERE MATCH(p.name,p.des) AGAINST ('$keyword') AND p.status=1 AND c.status=1";
        } else {
            $sql = "SELECT p.id, p.name, p.image, p.promotionPrice FROM products p JOIN categories c ON p.cateId = c.id WHERE p.name LIKE '%" . $keyword . "%' OR c.name LIKE '%" . $keyword . "%' AND p.status=1 AND c.status=1";
        }
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function getById($Id)
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM products WHERE Id='$Id' AND status=1";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function getByIdAdmin($Id)
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM products WHERE Id='$Id'";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function getByCateId($CateId)
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM products WHERE cateId='$CateId' AND status=1";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function getFeaturedproducts()
    {
        $db = DB::getInstance();
        $sql = "SELECT p.id, p.name, p.image, p.promotionPrice FROM products p JOIN categories c ON p.cateId = c.id WHERE p.status=1 AND c.status = 1 order BY soldCount DESC";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function getAllAdmin()
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM products";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function checkQuantity($Id, $qty)
    {
        $db = DB::getInstance();
        $sql = "SELECT qty FROM products WHERE status=1 AND Id='$Id'";
        $result = mysqli_query($db->con, $sql);
        $product = $result->fetch_assoc();
        if (intval($qty) > intval($product['qty'])) {
            return false;
        }
        return true;
    }

    public function updateQuantity($Id, $qty)
    {
        $db = DB::getInstance();
        $sql = "UPDATE products SET qty = qty - $qty WHERE id = $Id";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function changeStatus($Id)
    {
        $db = DB::getInstance();
        $sql = "UPDATE products SET status = !status WHERE Id='$Id'";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function insert($product)
    {
        $db = DB::getInstance();
        // Check image and move to upload folder
        $file_name = $_FILES['image']['name'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = APP_ROOT . "../../public/images/" . $unique_image;

        move_uploaded_file($file_temp, $uploaded_image);

        $sql = "INSERT INTO `products` (`id`, `name`, `originalPrice`, `promotionPrice`, `image`, `createdBy`, `createdDate`, `cateId`, `qty`, `des`, `status`, `soldCount`) VALUES (NULL, '" . $product['name'] . "', " . $product['originalPrice'] . ", " . $product['promotionPrice'] . ", '" . $unique_image . "', " . $_SESSION['user_id'] . ", '" . Date('d/m/y') . "', " . $product['cateId'] . ", " . $product['qty'] . ", '" . $product['des'] . "', 1, 0)";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function update($product)
    {
        $db = DB::getInstance();
        if (isset($product['image'])) {

            // Check image and move to upload folder
            $file_name = $_FILES['image']['name'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = APP_ROOT . "../../public/images/" . $unique_image;

            move_uploaded_file($file_temp, $uploaded_image);

            $sql = "UPDATE `products` SET name = '" . $_POST['name'] . "', `originalPrice` = " . $_POST['originalPrice'] . ", `promotionPrice` = " . $_POST['promotionPrice'] . ", `image` = '" . $unique_image . "', `cateId` = " . $_POST['cateId'] . ", `des` = '" . $_POST['des'] . "' WHERE id = " . $_POST['id'] . "";
            $result = mysqli_query($db->con, $sql);
            return $result;
        } else {
            $sql = "UPDATE `products` SET name = '" . $_POST['name'] . "', `originalPrice` = " . $_POST['originalPrice'] . ", `promotionPrice` = " . $_POST['promotionPrice'] . ", `cateId` = " . $_POST['cateId'] . ", `des` = '" . $_POST['des'] . "' WHERE id = " . $_POST['id'] . "";
            $result = mysqli_query($db->con, $sql);
            return $result;
        }
    }
}
