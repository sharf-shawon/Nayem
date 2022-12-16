<?php

require_once 'app/config.php';
require_once 'app/models/Appointment.php';
require_once 'app/models/Doctor.php';
require_once 'app/models/User.php';
use app\models\Appointment;
use app\models\Doctor;
use app\models\User;

session_start();

if (!isset($_SESSION['auth']) && $_SESSION['auth'] == null) {
    header('Location: ./login');
    die();
}

$page = 'Appointment Booking';
$doctors = Doctor::getAll();

function isFormSubmitted() {
    return isset($_POST['submit']);
}

if (isFormSubmitted()) {
    $newAppointment = new Appointment($_POST);
    $result = $newAppointment->save();

    if ($result) {
        header('Location: ./list-appointment');
    } else {
        header('Location: ./book-appointment');
    }
    die();
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require 'app/components/head_content.php' ?>
    </head>
    <body class="bg-light">
        <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
            <div class="p-5 my-5 bg-white shadow rounded-3">
                <h4 class="text-center mb-5">Appointment Booking</h4>
                <form action="./book-appointment" method="POST" class="mb-4">
                    <div class="form-floating mb-3">
                        <select class="form-control" name="doctor" id="doctor">
                            <option></option>
                            <?php foreach ($doctors as $doctor) { ?>
                                <option value="<?php echo $doctor['id'] ?>" <?php echo (isset($_GET['doctor_id']) && $_GET['doctor_id'] == $doctor['id']) ? 'selected' : ''; ?>><?php echo $doctor['name'] ?></option>
                            <?php } ?>
                        </select>
                        <label for="doctor">Select Doctor</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="date" name="date" required>
                        <label for="date">Appointment Date</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="time" class="form-control" id="time" name="time" required>
                        <label for="time">Appointment Time</label>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="submit" class="btn btn-primary">Book Appointment</button>
                    </div>
                </form>
                <hr class="mb-4">
                <div class="d-flex justify-content-center">
                    <span class="text-secondary me-2">Already have an account?</span>
                    <a href="./index" class="link-primary">Search Doctor</a>
                </div>
            </div>
        </div>
    </body>
</html>
