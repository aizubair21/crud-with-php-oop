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
}
