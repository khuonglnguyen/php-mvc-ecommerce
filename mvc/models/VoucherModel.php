<?php
class voucherModel
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new voucherModel();
        }

        return self::$instance;
    }

    public function getAll()
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM vouchers";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function getByCode($code)
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM vouchers WHERE code='$code' AND status=1";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function getByIdAdmin($Id)
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM vouchers WHERE Id='$Id'";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function changeStatus($Id)
    {
        $db = DB::getInstance();
        $sql = "UPDATE vouchers SET status = !status WHERE Id='$Id'";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }

    public function insert($data)
    {
        $db = DB::getInstance();
        $sql = "INSERT INTO vouchers VALUES (NULL, $data[percentDiscount], $data[quantity], '$data[code]', '$data[expirationDate]',1,0)";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }
	
	public function check($code)
    {
        $voucher = $this->getByCode($code)->fetch_assoc();
        if ($voucher) {
            if (intval($voucher['usedCount']) == intval($voucher['quantity'])) {
                return false;
            } else {
                return $voucher;
            }
        }
        return false;
    }

    public function used($code)
    {
        $voucher = $this->getByCode($code)->fetch_assoc();
        if (intval($voucher['usedCount']) == intval($voucher['quantity'])) {
            return false;
        }
        $db = DB::getInstance();
        $sql = "UPDATE vouchers SET usedCount = usedCount + 1 WHERE code='$code'";
        if (mysqli_query($db->con, $sql)) {
            return $voucher;
        }
        return false;
    }

    public function cancel($code)
    {
        $db = DB::getInstance();
        $sql = "UPDATE vouchers SET usedCount = usedCount - 1 WHERE code='$code'";
        if (mysqli_query($db->con, $sql)) {
            return true;
        }
        return false;
    }
}
