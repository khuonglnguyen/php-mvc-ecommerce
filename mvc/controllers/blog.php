<?php
class blog extends ControllerBase
{
    public function Index()
    {
        $blog = $this->model("blogModel");
        $blogList = $blog->getAll()->fetch_all(MYSQLI_ASSOC);
        $this->view("client/blogList", [
            "headTitle" => "Blog",
            "blogList" => $blogList
        ]);
    }

    public function detail($id)
    {
        $blog = $this->model("blogModel");
        $data = $blog->getById($id);
        $this->view("client/blogDetail", [
            "headTitle" => "Blog",
            "blog" => $data
        ]);
    }
}
