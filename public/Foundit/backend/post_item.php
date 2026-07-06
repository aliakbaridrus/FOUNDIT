<?php

session_start();

include 'config/database.php';

if(!isset($_SESSION['user_id'])){

    header("Location: ../pages/login.php");
    exit();

}

$user_id = $_SESSION['user_id'];

$posted_by = $_SESSION['first_name'];

$title = $_POST['title'];

$category = $_POST['category'];

$status = $_POST['status'];

$description = $_POST['description'];

$location = $_POST['location'];

$image = time() . '_' . $_FILES['image']['name'];

$tmp = $_FILES['image']['tmp_name'];

$folder = "../uploads/" . $image;

/*
|--------------------------------------------------------------------------
| UPLOAD IMAGE
|--------------------------------------------------------------------------
*/

if(move_uploaded_file($tmp, $folder)){

    $sql = "INSERT INTO items
    (
        user_id,
        posted_by,
        title,
        category,
        status,
        description,
        location,
        image
    )

    VALUES
    (
        '$user_id',
        '$posted_by',
        '$title',
        '$category',
        '$status',
        '$description',
        '$location',
        '$image'
    )";

    mysqli_query($conn, $sql);

    header("Location: ../pages/dashboard.php");

} else {

    echo "Upload gagal";

}

?>