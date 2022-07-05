<?php
require "configuration/controller.php";
require "configuration/QueryHandeler.php";

class postControl extends controller
{
    protected $title, $post, $image, $author, $postId;
    public $titleErr, $postErr, $imageErr, $authorErr, $id;

    public function title($title)
    {
        $this->title = $title;
        $this->required($title, 'titleErr');
        return $this;
    }
    public function description($post)
    {
        $this->post = $post;
        $this->required($post, 'postErr');
        return $this;
    }
    public function image($image)
    {
        $this->image = $image;
        $this->required($image, 'imageErr');
        return $this;
    }
    public function author($author)
    {
        $this->author = $author;
        $this->required($author, 'authorErr');
    }
    public function postId($postId)
    {
        $this->postId = $postId;
    }

    public function passwordConfirm($passwordConfirm)
    {
        $this->passwordConfirm = $passwordConfirm;
        $this->required($passwordConfirm, 'passwordConfirm');
    }

    public function id($id)
    {
        $this->id = $id;
    }


    //post posted
    public function post()
    {
        if (empty($this->titleErr) && empty($this->imageErr) && empty($this->authorErr) && empty($this->postErr)) {
            $data = new DBInsert;
            $response = $data->insert('posts', ['postTitle, postImage', 'post'], [$this->title, $this->image, $this->post]);
            return $response;
        } else {
            return false;
        }
    }


    //update data 
    public function update($updateId)
    {

        if (empty($this->titleErr) && empty($this->imageErr) && empty($this->authorErr) && empty($this->postErr)) {

            $data = new DBUpdate;
            $data->on('posts')->set(['postTitle', 'post', 'postImage'])->value([$this->title, $this->post, $this->image])->where("postId = '$updateId'");
            $response = $data->go();

            return $response;
        } else {
            return "Something Wrong in your query";
        }
    }


    //delete
    public function delete($id)
    {
        $delete = new DBDelete;
        $delete->from('posts')->where("postId = '$id'");
        $result = $delete->go();
        return $result;
    }
}

// $obj = new postControl;
// if (isset($_GET["delete_id"])) {
//     $delete_id = $_GET['delete_id'];
//     $response = $obj->delete($delte_id);
//     if ($response == 'success') {
//         header("location: users.php");
//     }
// }