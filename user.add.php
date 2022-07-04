<?php
require "nav.php";
include "controller/user-controller.php";
$user = new userControl;
if (isset($_POST['add'])) {
    $user->name($_POST['name']);
    $user->email($_POST['email']);
    $user->phone($_POST['username']);

    $response = $user->add();
    if ($response == 'success') {
?>
        <script>
            swal("Well Done!", "User Successfully added!", "success");
        </script>
    <?php
    } else {
    ?>
        <script>
            swal("Error !", <?php echo $response; ?>, "alert");
        </script>
<?php

    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data - Nww data insert to database</title>
</head>

<body style="background-color: rgba(0,0,0,.1);">
    <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <div class="card shadow-lg">
                    <div class="bg-primary text-white p-3" style="font-size:20px; text-align:center; font-weight:bold">
                        Add User
                    </div>
                    <div class="card-body">

                        <form action="<?php echo (htmlspecialchars($_SERVER["PHP_SELF"])) ?>" method="post" enctype="multipart/form-data">
                            <div>

                                <div>
                                    <label class="form-label" for="name ">Name :</label>
                                    <input type="text" name="name" id="name" placeholder="Your Image name..." class="form-control <?php echo ($user->nameErr) ? 'is-invalid' : "" ?> ">
                                    <?php $user->isError($user->nameErr) ?>
                                </div><br>
                                <div>
                                    <label class="form-label" for="email ">Email :</label>
                                    <input type="email" name="email" id="email" placeholder="Your Image email..." class="form-control <?php echo ($user->emailErr) ? 'is-invalid' : "" ?> ">
                                    <?php $user->isError($user->emailErr) ?>
                                </div><br>

                                <div>
                                    <label class="form-label" for="username ">Phone :</label>
                                    <input type="number" name="username" id="username" placeholder="Your Image username..." class="form-control <?php echo ($user->userNameErr) ? 'is-invalid' : "" ?> ">
                                    <?php $user->isError($user->userNameErr) ?>
                                </div><br>

                                <div class="form-check">
                                    <input class="form-check-input " type="checkbox" value="" id="invalidCheck" required>
                                    <label class="form-check-label" for="invalidCheck">
                                        Agree to terms and conditions
                                    </label>
                                </div>
                                <hr>

                                <div class="d-flex justify-content-between align-items-baseline">
                                    <a class="btn btn-danger" href="users.php">Cancel</a>
                                    <button name="add" class="btn btn-primary">Add New</button>
                                </div>

                        </form>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>