<?php
require "configuration/controller.php";
require "configuration/QueryHandeler.php";

class userControl extends controller
{
    protected $name, $userName, $email, $phone, $password, $passwordConfirm, $id;
    public $nameErr, $userNameErr, $emailErr, $phoneErr, $passwordErr, $idErr;

    public function name($name)
    {
        $this->name = $name;
        $this->required($name, 'nameErr');
    }
    public function userName($userName)
    {
        $this->userName = $userName;
        $this->required($userName, 'userNameErr');
    }
    public function email($email)
    {
        $this->email = $email;
        $this->required($email, 'emailErr');
    }
    public function phone($phone)
    {
        $this->phone = $phone;
        $this->required($phone, 'phoneErr');
    }
    public function password($password)
    {
        $this->password = $password;
        $this->required($password, 'passwordErr');
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

    public function add()
    {
        if (empty($this->nameErr) && empty($this->userNameErr) && empty($this->emailErr) && empty($this->passwordErr)) {
            $insert = new DBInsert;
            $response = $insert->insert('user', ['userName', 'userEmail', 'userPhone'], [$this->name, $this->email, $this->phone]);
            return $response;
            echo $response;
        } else {
            return "false";
        }
    }

    //update
    public function update()
    {
        if (empty($this->nameErr) && empty($this->phoneErr) && empty($this->emailErr) && !empty($this->id)) {

            $update = new DBUpdate;
            $update->on('user')->set(['userName', 'userEmail', 'userPhone'])->value([$this->name, $this->email, $this->phone])->where("userId = $this->id");
            $response = $update->go();
            echo $response;
        } else {
            return false;
        }
    }

    //delete
    public function delete($id)
    {
        $del = new DBDelete;
        $del->from('user')->where("userId = '$id'");
        $response = $del->go();
        return $response;
    }
}
