<?php

require "nav.php";
include "controller/admin-controller.php";
$register = new adminControl;
//session_unset();
if (isset($_SESSION['key'])) {
    header("location: dashboard.php");
}

$name_error = "";
$user_name_error = "";
$email_error = "";
$phone_error = "";
$password_error = "";
$error = '';


if (isset($_POST['register'])) {

    $name = $_POST["name"];
    $userName = $_POST["user_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST['password'];

    $register->name($name);
    $register->userName($userName);
    $register->email($email);
    $register->phone($phone);
    $register->password($password);

    //register query 
    $response = $register->register();
    if ($response == 'success') {
        $_SESSION['register'] = 'success';
    }
}

?>
<script>
    swal(<?php echo $response ?>, "alert");
</script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <div class="main_body">
        <div class="container">
            <div class="row" style="margin-top: 30px; padding:10px; ">
                <div class="col-3">
                </div>

                <div class="col-6">
                    <div class="card shadow-lg">
                        <div class="bg-primary text-white py-4 fw-bolder fs-2 text-center">
                            register as new
                        </div>

                        <?php if (isset($_SESSION['register'])) { ?>
                            <div class="alert alert-success">
                                <p>Register success. <a href="login.php">Login Now</a></p>
                            </div>
                        <?php } else { ?>

                            <div class="alert alert-warning w-100 p-2 fw-bolder fs-6">
                                <?php echo (isset($response)) ? $response : ""; ?>
                            </div>


                            <div class="card-body">

                                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
                                    <div class="input-group d-flex justify-content-between ">
                                        <div>
                                            <label class="form-label" for="name">Name :</label>
                                            <input type="text" name="name" id="name" placeholder="Your Name..." class="form-control form-input <?php echo ($register->nameErr) ? "is-invalid" : '' ?> " autofocus value="<?php echo $name ?? '' ?>">
                                            <?php $register->isError($register->nameErr) ?>
                                        </div><br>
                                        <div>
                                            <label class="form-label" for="user_name">User Name :</label>
                                            <input type="text" name="user_name" id="user_name" placeholder="Your username name..." class="form-control form-input <?php echo ($register->userNameErr) ? "is-invalid" : '' ?>" value="<?php echo $userName ?? '' ?>">
                                            <?php $register->isError($register->userNameErr) ?>

                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <label class="form-label" for="email ">Email :</label>
                                        <input type="email" name="email" id="email" placeholder="Your emaail..." class="form-control form-input <?php echo ($register->emailErr) ? "is-invalid" : '' ?>" value="<?php echo $email ?? '' ?>">
                                        <?php $register->isError($register->emailErr) ?>
                                    </div>
                                    <br>
                                    <div>
                                        <label class="form-label" for="phone">Phone :</label>
                                        <input type="phone" name="phone" id="phone" placeholder="Your phone number..." class="form-control form-input <?php echo ($register->phoneErr) ? "is-invalid" : '' ?>" value="<?php echo $phone ?? '' ?>">
                                        <?php $register->isError($register->phoneErr) ?>
                                    </div>
                                    <br>

                                    <div>
                                        <label class="form-label" for="Password">password :</label>
                                        <input type="password" name="password" id="password" placeholder="Your password..." class="form-control form-input <?php echo ($register->passwordErr) ? "is-invalid" : '' ?>">
                                        <?php $register->isError($register->passwordErr) ?>
                                    </div><br>

                                    <div class="form-check">
                                        <input class="form-check-input " type="checkbox" value="" id="invalidCheck" required>
                                        <label class="form-check-label" for="invalidCheck">
                                            Agree to terms and conditions
                                        </label>
                                        <div class="invalid-feedback">
                                            You must agree before submitting.
                                        </div>
                                    </div><br>

                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <a class="btn btn-outline-danger btn-sm" href="index.php">Cancel</a>
                                        <button name="register" class="btn btn-outline-primary btn-sm shadow-lg">Register</button>
                                    </div>

                                </form>

                                <hr>
                            </div>

                            <div style="padding:8px" class="d-flex justify-content-evenly align-items-baseline">
                                <p>Already register ? </p>
                                <a href="login.php" class="text text-info">Login Now !</a>
                            </div>
                    </div>
                <?php
                        }
                ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>