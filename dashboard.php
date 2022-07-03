<?php

require "nav.php";
// include "configuration/QueryHandeler.php";
include "controller/post-controller.php";
$get = new DBSelect;

if (!isset($_SESSION["key"])) {
    header("location: login.php");
}

$key = $_SESSION["key"] ?? "";

//post delete
$obj = new postControl;
if (isset($_GET["delete_id"])) {
    $delete_id = $_GET['delete_id'];
    $response = $obj->delete($delete_id);
    echo $response;
}

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
                        <div class="row align-items-baseline">

                            <div class="col-8">

                                <form action="dashboard.php" method="POST">
                                    <div class="d-flex">
                                        <input class="form-control " type="search" name="search" id="search" placeholder="Search....">
                                        <input class="btn btn-info" name="submit" type="submit" value="search">
                                    </div>
                                </form>

                            </div>

                            <div class="col-4">
                                <a style="float:right" class="btn btn-outline-primary btn-sm rounded-pill shadow" href="insert.php">Add New</a>
                                <a class="btn btn-outline-success btn-sm" href="dashboard.php">Show All</a>
                            </div>

                        </div>
                        <?php
                        if (isset($key)) { ?>
                            <table class="table table-striped table-hover">
                                <thead class="">
                                    <tr>
                                        <th>Sl :</th>
                                        <th>Title :</th>
                                        <th>Image :</th>
                                        <th>Author :</th>
                                        <th>Post :</th>
                                        <th>Modify</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if (isset($_POST['submit'])) {
                                        $value = $_POST["search"];
                                        $get->select([])->from('posts')->where("postTitle like '%$value%' OR post like '%$value%'");
                                        // $data = "SELECT * FROM crud WHERE caption like '%$value%' OR description like '%$value%'";

                                        $result = $get->get();
                                        while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td><?php echo $row["postId"] ?? "Not Found !"; ?></td>
                                                <td><?php echo $row["postTitle"] ?? "Not Found !"; ?></td>
                                                <td>
                                                    <img width="70" src="image/<?php echo $row['postImage'] ?? "" ?>" alt="">
                                                </td>
                                                <td><?php echo $row["postAuthor"] ?? "Not Found !"; ?></td>
                                                <td><?php echo $row["post"] ?? "Not Found !"; ?></td>
                                                <td>
                                                    <div class="d-flex justify-content-evenly align-items-center">
                                                        <a class="btn btn-outline-primary btn-sm" href="post.update.php?uid=<?php echo $row["postId"] ?>"><i class="fas fa-pen"></i></a>
                                                        <form action="dashboard.php?delete_id=<?php echo $row['postId'] ?>" method="GET" enctype="multipart/form-data">
                                                            <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }
                                    } else {
                                        // $data = "SELECT * FROM crud";
                                        $get->select([])->from('posts');
                                        $result = $get->get();
                                        while ($row = mysqli_fetch_assoc($result)) { ?>
                                            <tr>
                                                <td><?php echo $row["postId"] ?? "Not Found !"; ?></td>
                                                <td><?php echo $row["postTitle"] ?? "Not Found !"; ?></td>
                                                <td>
                                                    <img width="70" src="image/<?php echo $row['postImage'] ?? "" ?>" alt="">
                                                </td>
                                                <td><?php echo $row["postAuthor"] ?? "Not Found !"; ?></td>
                                                <td><?php echo $row["post"] ?? "Not Found !"; ?></td>
                                                <td>
                                                    <div class="d-flex justify-content-evenly align-items-center">
                                                        <a class="btn btn-outline-primary btn-sm" href="post.update.php?uid=<?php echo $row["postId"] ?>"><i class="fas fa-pen"></i></a>
                                                        <form action="dashboard.php?delete_id=<?php echo $row['postId'] ?>" method="POST" enctype="multipart/form-data">
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