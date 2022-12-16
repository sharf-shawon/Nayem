<?php

require_once 'app/config.php';
require_once 'app/models/Appointment.php';
require_once 'app/models/Doctor.php';
require_once 'app/models/User.php';
use app\models\Appointment;
use app\models\Doctor;
use app\models\User;

session_start();

if (isset($_SESSION['user']) && $_SESSION['user'] != null) {
    $user = new User($_SESSION['user']);
}

if (!isset($_SESSION['auth']) && $_SESSION['auth'] == null) {
    header('Location: ./login');
    die();
}

$page = 'My Appointment List';
$appointments = Appointment::getAll();

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
        <?php if(isset($appointments))
        foreach ($appointments as $appointment)
        { 
            $doctor = Doctor::getById($appointment['doctor_id']);
        ?>
            <div class="card mb-3">
                <div class="card-header">
                    You have an appointment with <?= $doctor['name'] ?>
                </div>
                <div class="card-body">
                    Address: <?= $doctor['address'] ?>
                    <br>
                    Date: <?= $appointment['date'] ?>
                    <br>
                    Time: <?= $appointment['time'] ?>
                    <br>
                </div>
            </div>
        <?php } ?>
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