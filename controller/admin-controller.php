<?php
include "configuration/controller.php";
include "configuration/QueryHandeler.php";

class adminControl extends controller
{
    protected $name, $userName, $email, $phone, $password, $passwordConfirm;
    public $nameErr, $userNameErr, $emailErr, $phoneErr, $passwordErr;

    public function __set($property, $value)
    {
        $this->{$property} = $value;
    }
    public function name($name)
    {
        $this->name = $name;
        $this->required($name, 'nameErr');
    }
    public function userName($userName)
    {
        $this->userName = $userName;
        $this->required($userName, 'userNameErr');
        $this->unique($userName, 'admin', 'adminUser_name', "userNameErr");
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

    //logoin
    public function login()
    {
        // echo $this->email;
        if (empty($this->nameErr) && empty($this->userNameErr) && empty($this->emailErr) && empty($this->passwordErr)) {
            $data = new DBSelect;
            $data->select([])->from('admin')->where("adminEmail = '$this->email'");
            $result = $data->get()->num_rows;

            if ($result > 0) {
                $user = $data->get()->fetch_assoc();
                if (password_verify($this->password, $user['adminPassword'])) {

                    $_SESSION['key'] = $user['adminId'];
                    header("location: index.php");
                    return "success";
                } else {
                    $this->passwordErr = "Password not matched";
                }
            } else {
                $this->emailErr = "No data found associated this email";
            }
        } else {
            return "Please, fill up all required field !";
        }
    }

    //register matod
    public function register()
    {

        if (empty($this->nameErr) && empty($this->userNameErr) && (empty($this->emailErr) && !empty($this->email)) && (empty($this->passwordErr) && !empty($this->password))) {
            // $data = new DBSelect;
            // $data->select([])->from('admin')->where("adminEmail = '$this->email'");

            $sign = new DBInsert;

            $password = password_hash($this->password, PASSWORD_DEFAULT);
            $response = $sign->insert('admin', ['adminName', 'adminEmail', 'adminUser_name', 'adminPhone', 'adminPassword'], [$this->name, $this->email, $this->userName, $this->phone, $password]);
            return $response;
            echo $response;
        } else {
            return "Warning ! please fill all required filed.";
        }
    }
}
