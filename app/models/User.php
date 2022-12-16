<?php

namespace app\models;

require_once 'app/Database.php';
use app\Database;
use PDO;

class User {
    private $id;
    private $name;
    private $email;
    private $phone;
    private $password;

    public function __construct($obj = null) {
        if ($obj != null) {
            $this->id = $obj['id'];
            $this->name = $obj['name'];
            $this->email = $obj['email'];
            $this->phone = $obj['phone'];
            $this->password = $obj['password'];
        }
    }

    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getEmail() { return $this->email; }
    public function getPhone() { return $this->phone; }
    public function getPassword() { return $this->password; }

    public function setName(string $newName) { $this->name = $newName; }
    public function setEmail(string $newEmail) { $this->email = $newEmail; }
    public function setPhone(string $newPhone) { $this->phone = $newPhone; }
    public function setPassword(string $newPassword) { $this->password = $newPassword; }

    public static function getByEmail(string $email) {
        if ($email == null) {
            return null;
        }

        $req = Database::get()->prepare('SELECT * FROM Users WHERE email=?');
        $req->execute([$email]);
        $res = $req->fetch(PDO::FETCH_ASSOC);

        return ($res == null) ? null : $res;
    }

    public static function getPasswordForAuth(string $email) {
        if ($email == null) {
            return null;
        }

        $req = Database::get()->prepare('SELECT password FROM Users WHERE email=?');
        $req->execute([$email]);
        $res = $req->fetch(PDO::FETCH_ASSOC);

        return ($res == null) ? null : $res['password'];
    }

    public function save() {
        $req = Database::get()->prepare('INSERT INTO Users (name, email, phone, password) VALUES (?, ?, ?, ?)');
        $req->execute([$this->name, $this->email, $this->phone, md5($this->password)]);
        return $req;
    }
}
