<?php
class Home extends ControllerBase{
    public function Index(){
        $this->view("index", [
            "headTitle"=>"Trang chủ"
        ]);
    }
}
?>