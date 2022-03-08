<?php

class User extends ControllerBase{
    public function login()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $user = $this->model("UserModel");
            $result = $user->checkLogin($email,$password);
            if ($result) {
                // Get user
                $u = $result->fetch_assoc();
                // Set session
                $_SESSION['user_id'] = $u['id'];
                $this->redirect("Home");
            }else {
                $this->view("login",[
                    "headTitle"=>"Đăng nhập","message"=>"Tài khoản hoặc mật khẩu không đúng!"]);
            }
        }else{
            $this->view("login", [
                "headTitle"=>"Đăng nhập"
            ]);
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        $this->redirect("User","login");
    }
    
    public function register(){
        if($_SERVER['REQUEST_METHOD']=='POST') {
            $fullName = $_POST['fullName'];
            $email = $_POST['email'];
            $dob = $_POST['dob'];
            $address = $_POST['address'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            
            $user = $this->model("UserModel");
            $checkEmail = $user->checkEmail($email);
            if (!$checkEmail) {
                $checkPhone = $user->checkPhone($phone);
                if (!$checkPhone) {
                    $this->view("register", [
                        "headTitle"=>"Đăng ký",
                        "messageEmail"=>"Email đã tồn tại",
                        "messagePhone"=>"Số điện thoại đã tồn tại",
                    ]);
                }else {
                    $this->view("register", [
                        "headTitle"=>"Đăng ký",
                        "messageEmail"=>"Email đã tồn tại"
                    ]);
                }
                return;
            }else {
                $checkPhone = $user->checkPhone($phone);
                if (!$checkPhone) {
                    $this->view("register", [
                        "headTitle"=>"Đăng ký",
                        "messagePhone"=>"Số điện thoại đã tồn tại",
                    ]);
                }
                return;
            }

            $result = $user->insert($fullName, $email, $dob, $address, $password);
            if($result) {
                $this->redirect("User","confirm",["email"=>$email]);
            }else {
                $this->view("register", [
                    "headTitle"=>"Đăng ký",
                    "cssClass"=>"error",
                    "message"=>"Đăng ký thất bại",
                ]);
            }
        }else {
            $this->view("register",[
                "headTitle"=>"Đăng ký"
            ]);
        }
     }

     public function confirm($email){
        if($_SERVER['REQUEST_METHOD']=='POST') {
            $captcha = $_POST['captcha'];
            
            $user = $this->model("UserModel");
            $result = $user->confirm($email, $captcha);
            if($result) {
                $this->view("confirm", [
                    "headTitle"=>"Xác minh tài khoản",
                    "cssClass"=>"success",
                    "email"=>$email,
                    "message"=>"Xác minh tài khoản thành công!",
                ]);
            }else {
                $this->view("confirm", [
                    "headTitle"=>"Xác minh tài khoản",
                    "cssClass"=>"error",
                    "email"=>$email,
                    "message"=>"Mã xác minh không đúng",
                ]);
            }
        }else {
            $this->view("confirm",[
                "headTitle"=>"Xác minh tài khoản",
                "email"=>$email
            ]);
        }
     }
}
?>