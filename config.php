<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $databaseName = "gym";

    $conn = mysqli_connect($server, $user, $password, $databaseName);

    if (!$conn) {
        die ("<script>alert('Connection Failed!')</script>". mysqli_connect_error());
    } else {
        header('Database Connected Successfully!');
    }
    
?>