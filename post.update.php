<?php
include "nav.php";
include "controller/post-controller.php";

// oop class object
$get = new DBSelect;
// $set = new DBInsert;
$post = new postControl;

if (!$_SESSION["key"]) {
    header("location: login.php");
}


//session_unset();

//updated id
$id = $_REQUEST["uid"] ?? "";

//get single post
$get->select([])->from('posts')->where("postId = '$id'");
$row = $get->get()->fetch_assoc();

//get input value
$caption = $_POST["caption"] ?? "";
$description = $_POST['description'] ?? "";
$image = $_FILES["image"]['name'] ?? "";



if (isset($_POST["submit"])) {

    //get id from input
    $uid = $_POST['update_id'] ?? "";

    $post->image($image);
    $post->title($caption);
    $post->description($description);

    //if image updte , upload into database, and delete old image from database.
    if ($_FILES['image']['name']) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], "image/" . $_FILES["image"]['name'])) {
            @unlink('image/' . $row["image"]);
        }
    }

    //then update the post
    $response = $post->update($id);
    if ($response = "success") {
?>
        <script>
            swal("Success.", "Post Successfully updated", "success");
        </script>
    <?php
    } else {
    ?>
        <script>
            swal("Warning!.", <?php echo $response ?>, "warning");
        </script>
<?php
    }
}

//delete
// $obj = new postControl;
// if (isset($_GET["delete_id"])) {
//     $delete_id = $_GET['delete_id'];
//     $response = $obj->delete($delte_id);
//     echo $response;
// }



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data - Nww data insert to database</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-6">
                <div class="card">
                    <div class="bg-primary text-white p-3" style="font-size:20px; text-align:center; font-weight:bold">
                        Update Data
                    </div>


                    <div class="card-body">

                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                            <div>
                                <input type="hidden" name="update_id" value="<?php echo ($_REQUEST['uid']) ?>">

                                <div style="padding:3px 0px">
                                    <label for="previous_image">Previous image :</label><br>
                                    <img width="300" src="image/<?php echo $row['postImage'] ?>" alt="Not found!" name="previous_image" id="previous_image">
                                </div><br>

                                <div>
                                    <label for="image">Image :</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div><br>


                                <div>
                                    <label class="form-label" for="caption ">Caption :</label>
                                    <input type="text" name="caption" value="<?php echo $row['postTitle'] ?>" id="caption" placeholder="Your Image caption..." class="form-control">
                                </div><br>

                                <div>
                                    <label class="form-label" for="Description ">Description :</label>
                                    <input type="text" name="description" value="<?php echo $row['post'] ?>" id="description" placeholder="Your Image Description..." class="form-control">
                                </div>
                                <hr>

                                <div class="d-flex justify-content-between align-items-baseline">
                                    <a class="btn btn-danger" href="dashboard.php">Cancel</a>
                                    <strong>OR</strong>
                                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>