<?php
include_once(APP_ROOT . '/libs/PHPMailer.php');
include_once(APP_ROOT . '/libs/Exception.php');
include_once(APP_ROOT . '/libs/SMTP.php');
use PHPMailer\PHPMailer\PHPMailer;

class userModel
{
    private static $instance = null;

    private function __construct()
    {
        
    }

    public static function getInstance()
    {
      if(!self::$instance)
      {
        self::$instance = new userModel();
      }
     
      return self::$instance;
    }

    public function checkLogin($email, $password)
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND isConfirmed=1";
        $result = mysqli_query($db->con, $sql);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            return $result;
        }else {
            return false;
        }
    }

    public function checkEmail($email)
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM users WHERE email='$email' AND isConfirmed=1";
        $result = mysqli_query($db->con, $sql);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            return false;
        }else {
            return true;
        }
    }

    public function checkPhone($phone)
    {
        $db = DB::getInstance();
        $sql = "SELECT * FROM users WHERE phone='$phone' AND isConfirmed=1";
        $result = mysqli_query($db->con, $sql);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            return false;
        }else {
            return true;
        }
    }

    public function insert($fullName,$email, $dob, $address, $password)
    {
        $db = DB::getInstance();

        // Genarate captcha
		$captcha = rand(10000, 99999);

        $sql = "INSERT INTO users(`id`, `fullName`, `email`, `dob`, `address`, `password`, `roleId`, `status`,`captcha`, `isConfirmed`) VALUES (NULL,'$fullName','$email','$dob','$address','$password',1,1,'$captcha',0)";
        $result = mysqli_query($db->con, $sql);
        if ($result) {
            
                // Send email
                $mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->Mailer = "smtp";

				$mail->SMTPDebug  = 0;
				$mail->SMTPAuth   = TRUE;
				$mail->SMTPSecure = "tls";
				$mail->Port       = 587;
				$mail->Host       = "smtp.gmail.com";
				$mail->username   = "khuongip564gb@gmail.com";
				$mail->Password   = "khuongip564gb";

				$mail->IsHTML(true);
				$mail->CharSet = 'UTF-8';
				$mail->AddAddress($email, "recipient-name");
				$mail->SetFrom("khuongip564gb@gmail.com", "KHUONGCUTE STORE");
				$mail->Subject = "Xác nhận email tài khoản - KHUONGCUTE STORE";
				$mail->Body = "<h3>Cảm ơn bạn đã đăng ký tài khoản tại website KHUONGCUTE STORE</h3></br>Đây là mã xác minh tài khoản của bạn: " . $captcha . "";

				$mail->Send();

                return true;
        }
        return false;
    }

    public function confirm($email, $captcha)
    {
        $db = DB::getInstance();
        
        $sql = "SELECT * FROM users WHERE email='$email' AND captcha='$captcha'";
        $result = mysqli_query($db->con, $sql);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            // Update user is confirmed
            $sql = "UPDATE users SET isConfirmed=1 WHERE email='$email'";
            $re = mysqli_query($db->con, $sql);
            if ($re) {
                return true;
            }else {
                return false;
            }
        }else {
            return false;
        }
    }

    public function getRole($userId)
    {
        $db = DB::getInstance();
        $sql = "SELECT roleId FROM users WHERE id='$userId'";
        $result = mysqli_query($db->con, $sql);
        return $result;
    }
}
