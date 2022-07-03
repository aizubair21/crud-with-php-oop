<?php

require "nav.php";
include "configuration/QueryHandeler.php";
$get = new DBSelect;

if (!isset($_SESSION["key"])) {
    header("location: login.php");
}

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

                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-8">

                                <form action="dashboard.php" method="POST">
                                    <div class="d-flex">
                                        <input class="form-control" type="search" name="search" id="search" placeholder="Search....">
                                        <input class="btn btn-info" name="submit" type="submit" value="search">
                                    </div>
                                </form>

                            </div>

                            <div class="col-4">
                                <a style="float:right" class="btn btn-primary btn-nd" href="insert.php">Add New</a>
                                <a class="btn btn-success" href="dashboard.php">Show All</a>
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
                                        <th>Image :</th>
                                        <th>Modify :</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if (isset($_POST['submit'])) {
                                        $value = $_POST["search"];
                                        $get->select([])->from('user')->where("userName like '%$value%' OR userEmail like '%$value%'");
                                        // $data = "SELECT * FROM crud WHERE caption like '%$value%' OR description like '%$value%'";

                                        $result = $get->get();
                                        while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td><?php echo $row["userId"] ?? "Not Found !"; ?></td>
                                                <td><?php echo $row["userName"] ?? "Not Found !"; ?></td>
                                                <td><?php echo $row["userEmail"] ?? "Not Found !"; ?></td>
                                                <td>
                                                    <img width="70" src="image/<?php echo $row['image'] ?? "" ?>" alt="">
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-evenly align-items-center">
                                                        <a class="btn btn-outline-primary btn-sm" href="update.php?uid=<?php echo $row["id"] ?>"><i class="fas fa-pen"></i></a>
                                                        <form action="delete.php?id=<?php echo $row['id'] ?>" method="POST" enctype="multipart/form-data">
                                                            <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }
                                    } else {
                                        // $data = "SELECT * FROM crud";
                                        $get->select([])->from('user');
                                        $result = $get->get();
                                        while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td><?php echo $row["userId"] ?? "Not Found !"; ?></td>
                                                <td><?php echo $row["userName"] ?? "Not Found !"; ?></td>
                                                <td><?php echo $row["userEmail"] ?? "Not Found !"; ?></td>
                                                <td>
                                                    <img width="70" src="image/<?php echo $row['image'] ?? "" ?>" alt="">
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-evenly align-items-center">
                                                        <a class="btn btn-outline-primary btn-sm" href="update.php?uid=<?php echo $row["id"] ?>"><i class="fas fa-pen"></i></a>
                                                        <form action="delete.php?id=<?php echo $row['id'] ?>" method="POST" enctype="multipart/form-data">
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