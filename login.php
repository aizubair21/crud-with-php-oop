<?php

include "nav.php";
include "controller/admin-controller.php";
$signup = new adminControl;


if (isset($_SESSION['key'])) {
    header("location: welcome.php");
}

$email = $_POST['email'] ?? "";
$password = $_POST['password'] ?? "";
$signup->email($email);
$signup->password($password);

$result = $signup->login();
if ($result == 'success') {
    header("locaiton: index.php");
}

//
// print_r($signup);
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
//

if (isset($_POST["Login"])) {
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loin - OOP Crud</title>
</head>

<body>


    <div class="main_body">
        <div class="container">
            <div class="row" style="margin-top: 30px; padding:10px; ">
                <div class="col-3">
                </div>

                <div class="col-5">
                    <div class="card shadow-lg ">
                        <div class="bg-primary text-white p-3" style="font-size:20px; text-align:center; font-weight:bold">
                            Log in
                        </div>
                        <form action="login.php" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-floating mb-3">

                                    <input type="text" class="form-control <?php echo ($signup->emailErr) ? "is-invalid" : "" ?>" id="floatingInput" placeholder="name@example.com" name="email">
                                    <label for="floatingInput">Email :</label>
                                    <?php $signup->isError($signup->emailErr) ?>
                                </div>

                                <div class="form-floating">
                                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" autocomplete="">
                                    <label for="floatingPassword">Password :</label>
                                    <?php $signup->isError($signup->passwordErr) ?>
                                </div><br>


                                <button class="btn btn-outline-primary btn-lg rounded-pill shadow-lg " name="Login" value="login" type="submit">Login</button>

                                <hr>
                                <div class='py-2'>
                                    <div class="d-flex justify-content-evenly align-items-baseline">
                                        <p>Have an account ?</p>
                                        <a href="register.php" class="text text-info">Register now !</a>
                                    </div>
                                    <div style="text-align:center; padding-bottom:5px">
                                        <a href="forgot_password.php " class="text text-danger p-2"> Forgote Your Password ?</a>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>