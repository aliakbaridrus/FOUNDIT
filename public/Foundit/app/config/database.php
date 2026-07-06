<?php

class Database
{
    public static function connect()
    {
        $host = "127.0.0.1";
        $user = "root";
        $pass = "";
        $db   = "foundit_db";
        $port = 3307;

        $conn = mysqli_connect($host, $user, $pass, $db, $port);

        if (!$conn) {
            die("Database Connection Failed: " . mysqli_connect_error());
        }

        mysqli_set_charset($conn, "utf8mb4");

        return $conn;
    }
}
