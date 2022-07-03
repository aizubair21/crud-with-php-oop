<?php
require "configuration/controller.php";
require "configuration/QueryHandeler.php";

class adminControl extends controller
{
    protected $name, $userName, $email, $phone, $password, $passwordConfirm;
    public $nameErr, $userNameErr, $emailErr, $phoneErr, $passwordErr;

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

    public function login()
    {
        if (empty($this->nameErr) && empty($this->userNameErr) && empty($this->emailErr) && empty($this->passwordErr)) {
            $data = new DBSelect;
            $data->select([])->from('admin')->where("adminEmail = '$this->email'");
            $result = $data->get()->num_rows;
            if ($result > 0) {
                $user = mysqli_fetch_assoc($data->get());
                if ($user['adminPassword'] == $this->password) {

                    $_SESSION['key'] = $user['adminId'];
                    return "success";
                } else {
                    $this->passwordErr = "Password not patched";
                }
            } else {
                $this->emailErr = "No data found associated this email";
            }
        } else {
            return false;
        }
    }
    public function register()
    {
        if (empty($this->nameErr) && empty($this->userNameErr) && empty($this->emailErr) && empty($this->passwordErr)) {
            // $data = new DBSelect;
            // $data->select([])->from('admin')->where("adminEmail = '$this->email'");
        } else {
            return false;
        }
    }
}
