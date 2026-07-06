<?php

include 'config/database.php';

$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);

$last_name  = mysqli_real_escape_string($conn, $_POST['last_name']);

$email      = mysqli_real_escape_string($conn, $_POST['email']);

$whatsapp   = mysqli_real_escape_string($conn, $_POST['whatsapp']);

$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

/*
|--------------------------------------------------------------------------
| Default role untuk semua register = user
|--------------------------------------------------------------------------
*/

$role = 'user';

/*
|--------------------------------------------------------------------------
| Cek email sudah ada atau belum
|--------------------------------------------------------------------------
*/

$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($check) > 0){

    echo "
    <script>
        alert('Email already registered!');
        window.location.href='../pages/register.php';
    </script>
    ";

    exit();

}

/*
|--------------------------------------------------------------------------
| Insert User
|--------------------------------------------------------------------------
*/

$sql = "INSERT INTO users (
    first_name,
    last_name,
    email,
    whatsapp,
    password,
    role
)

VALUES (
    '$first_name',
    '$last_name',
    '$email',
    '$whatsapp',
    '$password',
    '$role'
)";

if(mysqli_query($conn, $sql)){

    header("Location: ../pages/login.php");
    exit();

} else {

    echo mysqli_error($conn);

}

?>