<?php

require_once 'app/config.php';
require_once 'app/models/User.php';
use app\models\User;

function isFormSubmitted() {
    return isset($_POST['submit']);
}

if (isFormSubmitted()) {
    $newUser = new User($_POST);
    $result = $newUser->save();

    if ($result) {
        header('Location: ./login');
    } else {
        header('Location: ./register');
    }

    die();
}

$page = 'Registration';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require 'app/components/head_content.php' ?>
    </head>
    <body class="bg-light">
        <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
            <div class="p-5 my-5 bg-white shadow rounded-3">
                <h4 class="text-center mb-5">Registration</h4>
                <form action="./register" method="POST" class="mb-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="name" placeholder="Name" minlength="4" maxlength="32" required>
                        <label for="floatingInput">Name</label>
                        <div id="passwordHelpBlock" class="form-text">
                            Name must be at least 4 characters long.
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required>
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="phone" class="form-control" id="floatingInput" name="phone" placeholder="01717171717" required>
                        <label for="floatingInput">Phone number</label>
                        <div id="passwordHelpBlock" class="form-text">
                            Phone number has to start with 01 .
                        </div>
                    </div>
                    <div class="form-floating mb-5" aria-describedby="passwordHelpBlock">
                        <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" minlength="8" maxlength="32" required>
                        <label for="floatingPassword">Password</label>
                        <div id="passwordHelpBlock" class="form-text">
                            Your password must be 8-32 characters long.
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="submit" class="btn btn-primary">Register</button>
                    </div>
                </form>
                <hr class="mb-4">
                <div class="d-flex justify-content-center">
                    <span class="text-secondary me-2">Already have an account?</span>
                    <a href="./login" class="link-primary">Log in</a>
                </div>
            </div>
        </div>
    </body>
</html>
