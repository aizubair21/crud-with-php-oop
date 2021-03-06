<?php
include "nav.php";
include "controller/post-controller.php";
$post = new postControl;
if (!$_SESSION["key"]) {
    header("location: login.php");
}

$caption = $_POST["caption"] ?? "";
$description = $_POST['description'] ?? "";
$image = $_FILES["image"]['name'] ?? "";
$imageErr = "";

if (isset($_POST["create"])) {



    if ($image) {
        if ($_FILES['image']['type'] == 'image/jpg' || $_FILES['image']['type'] == 'image/png' || $_FILES['image']['type'] == 'image/gif' || $_FILES['image']['type'] == 'image/jpeg') {

            if (move_uploaded_file($_FILES["image"]["tmp_name"], "image/" . $_FILES["image"]['name'])) {
                $post->image($image);
            } else {
                $post->imageErr = "Failed to upload. try again";
            }
        } else {
            $post->imageErr = "Only jpg, png, gif, jpeg formate support !";
        }
    } else {
        $post->imageErr = "Filed is required !";
    }

    $post->title($caption)->description($description);
    $result = $post->post();
    if ($result) {
?>
        <script>
            swal("Well Done!", "Your Post Successfully Added", "success");
        </script>
    <?php
        $caption = '';
        $description = '';
    } else {
    ?>
        <script>
            swal("Something Wrong !", <?php echo $result ?>, "Alert");
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
                        Insert Data
                    </div>
                    <div class="card-body">

                        <form action="insert.php" method="post" enctype="multipart/form-data">
                            <div>
                                <div>
                                    <label class="form-label" for="name">File :</label>
                                    <input type="file" name="image" id="name" value="<?php echo $image ?>" class="form-control">
                                    <?php $post->isError($post->imageErr) ?>
                                </div>
                                <br>

                                <div>
                                    <label class="form-label" for="caption ">Caption :</label>
                                    <input type="test" name="caption" id="caption" placeholder="Your Image caption..." value="<?php echo $caption ?>" class="form-control <?php echo ($post->titleErr) ? 'is-invalid' : "" ?> ">
                                    <?php $post->isError($post->titleErr) ?>
                                </div><br>

                                <div>
                                    <label class="form-label" for="descrtpion ">Description :</label>
                                    <input type="test" name="description" id="descrtpion" placeholder="Your Image descrtpion..." value="<?php echo $description ?>" class="form-control <?php echo ($post->postErr) ? 'is-invalid' : "" ?> ">
                                    <?php $post->isError($post->postErr) ?>
                                </div><br>

                                <div class="form-check">
                                    <input class="form-check-input " type="checkbox" value="" id="invalidCheck" required>
                                    <label class="form-check-label" for="invalidCheck">
                                        Agree to terms and conditions
                                    </label>
                                </div>
                                <hr>

                                <div class="d-flex justify-content-between align-items-baseline">
                                    <a class="btn btn-danger" href="dashboard.php">Cancel</a>
                                    <button name="create" class="btn btn-primary">Add New</button>
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