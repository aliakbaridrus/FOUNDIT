<?php

session_start();

include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (empty($email) || empty($password)) {
        header("Location: ../pages/login.php?error=empty_fields");
        exit();
    }

    $sql = "SELECT id, first_name, last_name, email, password, role FROM users WHERE email = '" . mysqli_real_escape_string($conn, $email) . "'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];

            if ($row['role'] === 'admin') {
                header("Location: ../pages/admin_dashboard.php");
                exit();
            } else {
                header("Location: ../pages/dashboard.php");
                exit();
            }
        } else {
            header("Location: ../pages/login.php?error=wrong_password");
            exit();
        }
    } else {
        header("Location: ../pages/login.php?error=email_not_found");
        exit();
    }
} else {
    header("Location: ../pages/login.php");
    exit();
}

?>