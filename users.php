<?php

require "nav.php";
include "configuration/QueryHandeler.php";
$get = new DBSelect;

if (!isset($_SESSION["key"])) {
    header("location: login.php");
}
if (["verify_at"] ==  NULL) { ?>

    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body alert alert-warning text-align-center">
                        <p><strong>Verify Needed !</strong></p>
                        <p>You are not a varified user. To see all user you need to verify you account by email varification.</p>
                        <a class="btn btn-info p-3" href="sendmail.php">Verify you account </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } else {

    $key = $_SESSION["key"] ?? "";

?>

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

                    <div class="card shadow-lg">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-8">

                                    <form action="users.php" method="POST">
                                        <div class="d-flex">
                                            <input class="form-control shadow" type="search" name="search" id="search" placeholder="username or email....">
                                            <input class="btn btn-info" name="submit" type="submit" value="search">
                                        </div>
                                    </form>

                                </div>

                                <div class="col-4 d-flex justify-content-between align-items-baseline">
                                    <a class="btn btn-success" href="users.php">Show All</a>
                                    <a class="btn btn-outline-primary btn-sm rounded-pill shadow-lg" href="user.add.php">Add user</a>
                                </div>

                            </div>
                            <?php
                            if (isset($key)) { ?>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sl :</th>
                                            <th>Name :</th>
                                            <th>Email :</th>
                                            <th>Phone :</th>
                                            <th>Action :</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if (isset($_POST['submit'])) {
                                            $value = $_POST["search"];
                                            $get->select([])->from('user')->where("userName like '%$value%' OR userEmail like '%$value%'");
                                            $result = $get->get();
                                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                                <tr>
                                                    <td><?php echo $row["userId"] ?? "Not Found !"; ?></td>
                                                    <td><?php echo $row["userName"] ?? "Not Found !"; ?></td>
                                                    <td><?php echo $row['userEmail'] ?? "Not Found" ?></td>
                                                    <td><?php echo $row["userPhone"] ?? "Not Found !"; ?></td>
                                                    <td>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <a class="btn btn-primary btn-sm" href="user.update.php?uid=<?php echo $row["id"] ?>"><i class="fas fa-pen"></i></a>
                                                            <form action="delete.php?id=<?php echo $row['id'] ?>" method="POST" enctype="multipart/form-data">
                                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } else {
                                            $get->select([])->from('user');
                                            $result = $get->get();
                                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                                <tr>
                                                    <td><?php echo $row["userId"] ?? "Not Found !"; ?></td>
                                                    <td><?php echo $row["userName"] ?? "Not Found !"; ?></td>
                                                    <td><?php echo $row['userEmail'] ?? "Not Found" ?></td>
                                                    <td><?php echo $row["userPhone"] ?? "Not Found !"; ?></td>
                                                    <td>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <a class="btn btn-outline-primary btn-sm" href="user.update.php?id=<?php echo $row["userId"] ?>"><i class="fas fa-pen"></i></a>
                                                            <form action="delete.php?Id=<?php echo $row['userId'] ?>" method="POST" enctype="multipart/form-data">
                                                                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                        <?php }
                                        }; ?>
                                    </tbody>
                                </table>
                            <?php }; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php } ?>