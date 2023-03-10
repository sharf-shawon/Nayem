<?php

require_once 'app/config.php';
require_once 'app/models/User.php';
require_once 'app/models/Doctor.php';

use app\models\User;
use app\models\Doctor;
$page = 'Search Doctor';


session_start();

if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
    $user = new User($_SESSION['user']);
}

if (isset($_POST['symptom']) && $_POST['symptom'] != null) {
    $doctors = Doctor::getBySymptom($_POST['symptom']);
}

if (isset($_POST['speciality']) && $_POST['speciality'] != null) {
    $doctors = Doctor::getBySpeciality($_POST['speciality']);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'app/components/head_content.php' ?>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand user-select-none"><?= WEB_TITLE ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <?php require_once('app/components/navbar.php');?>
            </div>
        </div>
    </nav>
    <div class="container bg-white shadow p-3 my-5 rounded-3">
        <form action="/" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="card-header">Search by Symptoms</div>
                    <div class="card card-body">
                        <select class="form-control" name="symptom" id="symptom" >
                            <option></option>
                            <option value="Fever">Fever</option>
                            <option value="Stomach Ache">Stomach Ache</option>
                            <option value="Depression">Depression</option>
                        </select>
                        <input class="btn btn-primary mt-3" type="submit" value="Search">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-header">Search by Speciality</div>
                    <div class="card card-body">
                        <select class="form-control" name="speciality" id="speciality" >
                            <option></option>
                            <option value="Medicine">Medicine</option>
                            <option value="Urologist">Urologist</option>
                            <option value="Depressionist">Depressionist</option>
                        </select>
                        <input class="btn btn-primary mt-3" type="submit" value="Search">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="container bg-white shadow p-3 my-5 rounded-3">
        <?php if(isset($doctors))
        foreach ($doctors as $doctor)
        { ?>
            <div class="card mb-3">
                <div class="card-header">
                    <?= $doctor['name'] ?>
                </div>
                <div class="card-body">
                    Address: <?= $doctor['address'] ?>
                    <br>
                    Speciality: <?= $doctor['speciality'] ?>
                    <br>
                    Symptoms: <?= $doctor['symptoms'] ?>
                    <br>
                    <a href="/book-appointment?doctor_id=<?= $doctor['id']?>" class=" m-3 btn btn-primary">Book Appointment</a>
                </div>
            </div>
        <?php } ?>
    </div>
</body>

</html>