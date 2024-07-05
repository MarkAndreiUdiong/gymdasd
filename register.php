<?php
session_start();

include "config.php";

if (isset($_POST["submit"])) {
    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $cpassword = $_POST["cpassword"];

    var_dump($_POST);

    $statement = $conn->prepare("SELECT * FROM user WHERE fname = ? OR email = ?");
    $statement->bind_param("ss", $username, $email);
    $statement->execute();
    $statement->get_result();

    if ($statement->num_rows() === 0) {
        if($password == $cpassword) {
            $statement = $conn->prepare("INSERT INTO user (fname, email, password, cpassword) VALUES (?, ?, ?, ?)");
            $statement->bind_param("ssss", $email, $password, $cpassword);
            
            if ($statement->execute()) {
                echo"<script>alert('Registration Successfully!');";
                header("Location: login.php");
                exit();
            } else {
                echo "<script>alert('Failed to register, please try again later!')</script>";
            }
        } else {
            echo "<script>alert('Password does not match!')</script>";
        }
    } else{
        echo "<script>alert('Email is already taken')</script>";
    }
    $statement->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PABUHAT FITNESS GYM | REGISTRATION </title>
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <main>
        <div class="container" id="container">
            <div class="form-container sign-in-container">
                <form action="" method="post">
                    <h1> REGISTRATION </h1>
                    <span>or use your account</span>
                    <input type="text" name="fname" id="fname" placeholder="Full Name"/>
                    <input type="text" name="gender" id="gender" placeholder="Gender"/>
                    <input type="text" name="age" id="age" placeholder="Age"/>
                    <input type="text" name="height" id="height" placeholder="Height"/>
                    <input type="text" name="weight" id="weight" placeholder="Weight"/>
                </form>
            </div>
            <div class="overlay-container">
                <form method="post" class="overlay">
                        <div class="overlay-panel overlay-right">
                        <img src="img/logo1.png" alt="Pabuhat Fitness Gym" width="125">
                        <input type="email" name="email" id="email" placeholder="Email"/>
                        <input type="password" name="password" id="password" placeholder="Password"/>
                        <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password"/>
                        <button type="submit" name="submit"> Sign Up </button>
                        <p> Already have an account? <a href="login.php"> Sign In</a></p>
                    </div>
                </form>
            </div>
        </div>

        <footer>
            <p> Copyright © PABUHAT FITNESS GYM 2024 </p>
        </footer>
    </main>


    <script src="script.js"></script>
</body>
</html>