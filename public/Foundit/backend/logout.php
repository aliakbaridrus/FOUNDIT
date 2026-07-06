<?php

session_start();

// Hapus semua session
$_SESSION = [];

// Hancurkan session
session_destroy();

// Redirect ke login
header("Location: ../pages/login.php");
exit();

?>