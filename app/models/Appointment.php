<?php

namespace app\models;

require_once 'app/Database.php';
use app\Database;
use PDO;

class Appointment {
    private $id;
    private $name;
    private $address;
    private $symptoms;
    private $speciality;

    public function __construct($obj = null) {
        if ($obj != null) {
            $this->id = $obj['id'];
            $this->name = $obj['name'];
            $this->address = $obj['address'];
            $this->symptoms = $obj['symptoms'];
            $this->speciality = $obj['speciality'];
        }
    }

    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getAddress() { return $this->address; }
    public function getSymptoms() { return $this->symptoms; }
    public function getSpeciality() { return $this->speciality; }

    public function setName(string $name) { $this->name = $name; }
    public function setAddress(string $address) { $this->address = $address; }
    public function setSymptoms(string $symptoms) { $this->symptoms = $symptoms; }
    public function setSpeciality(string $speciality) { $this->speciality = $speciality; }

    public static function getAppointments() {
        $req = Database::get()->prepare('SELECT * FROM Appointments WHERE user_id = ?');
        $req->execute([$symptom]);
        $res = $req->fetchAll();

        return ($res == null) ? null : $res;
    }

    public function save() {
        $req = Database::get()->prepare('INSERT INTO Appointments (name, address, symptoms, speciality) VALUES (?, ?, ?, ?)');
        $req->execute([$this->name, $this->address, $this->symptoms, $this->speciality]);
        return $req;
    }
}
