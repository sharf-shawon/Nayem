<?php

require_once 'app/config.php';
require_once 'app/models/Doctor.php';
use app\models\Doctor;

function isFormSubmitted() {
    return isset($_POST['submit']);
}

if (isFormSubmitted()) {
    $newDoctor = new Doctor($_POST);
    $result = $newDoctor->save();

    if ($result) {
        header('Location: ./register-doctor');
    } else {
        header('Location: ./register');
    }

    die();
}

$page = 'Doctor Registration';

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
                <form action="./register-doctor" method="POST" class="mb-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" minlength="4" maxlength="32" required>
                        <label for="name">Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" minlength="4" maxlength="32" required>
                        <label for="address">Chamber Address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="symptoms" name="symptoms" placeholder="Symptoms" minlength="4" maxlength="32" required>
                        <label for="symptoms">Symptoms</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="speciality" name="speciality" placeholder="Speciality" minlength="4" maxlength="32" required>
                        <label for="speciality">Speciality</label>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="submit" class="btn btn-primary">Register Doctor</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
