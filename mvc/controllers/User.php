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
                $_SESSION['email'] =  $u['id'];
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
        unset($_SESSION['email']);
        $this->redirect("User","login");
    }
}
