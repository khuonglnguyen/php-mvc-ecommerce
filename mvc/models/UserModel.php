<?php
class UserModel extends DB
{
    public function checkLogin($email, $password)
    {
        $sql = "SELECT * FROM Users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($this->con, $sql);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            return $result;
        }else {
            return false;
        }
    }
}
