<?php

session_start();

require_once 'app/config.php';
require_once 'app/models/User.php';
use app\models\User;

function isFormSubmitted() {
    return isset($_POST['submit']);
}

if (isFormSubmitted()) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $accPassword = User::getPasswordForAuth($email);
    
    if ($accPassword == null) {
        header('Location: ./');
        die();
    }

    if (md5($password) == $accPassword) {
        $_SESSION['user_id'] = User::getByEmail($email);
        $_SESSION['user'] = User::getByEmail($email);
        $_SESSION['auth'] = 1;
        header('Location: ./');
        die();
    }
}

$page = 'Log in';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require 'app/components/head_content.php' ?>
    </head>
    <body class="bg-light">
        <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
            <div class="p-5 bg-white shadow rounded-3">
                <h4 class="text-center mb-5">Log in to continue</h4>
                <form action="./login" method="POST" class="d-flex flex-column justify-content-center align-items-center mb-4">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" pattern="^[^'\x22`]+$" required>
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating mb-5">
                        <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" minlength="8" maxlength="32" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Log in</button>
                </form>
                <hr class="mb-4">
                <div>
                    <span class="text-secondary me-2">Don't have an account?</span>
                    <a href="./register" class="link-primary">Register</a>
                </div>
            </div>
        </div>
    </body>
</html>
