<?php

namespace app\models;

require_once 'app/Database.php';
require_once 'app/models/User.php';

use app\Database;
use app\models\User;
use PDO;

class Appointment {
    private $id;
    private $doctor_id;
    private $user_id;
    private $date;
    private $time;

    public function __construct($obj = null) {
        if ($obj != null) {
            $this->doctor_id = $obj['doctor'];
            $this->user_id = $_SESSION['user']['id'];
            $this->date = $obj['date'];
            $this->time = $obj['time'];
        }
    }

    public function getId() { return $this->id; }
    public function getDoctor() { return $this->doctor; }
    public function getUser() { return $this->user; }
    public function getDate() { return $this->date; }
    public function getTime() { return $this->time; }

    public function setDoctor(string $doctor_id) { $this->doctor_id = $doctor_id; }
    public function setUser(string $user_id) { $this->user_id = $user_id; }
    public function setDate(string $date) { $this->date = $date; }
    public function setTime(string $time) { $this->time = $time; }

    public static function getAll() {
        $req = Database::get()->prepare('SELECT * FROM Appointments WHERE user_id = ?');
        $req->execute([$_SESSION['user']['id']]);
        $res = $req->fetchAll();

        return ($res == null) ? null : $res;
    }

    public function save() {
        $req = Database::get()->prepare('INSERT INTO Appointments (doctor_id, user_id, date, time) VALUES (?, ?, ?, ?)');
        $req->execute([$this->doctor_id, $this->user_id, $this->date, $this->time]);
        return $req;
    }
}
