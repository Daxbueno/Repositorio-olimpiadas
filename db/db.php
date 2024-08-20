<?php

class Database{
    private $hostname = "bsaddm75r7d7kzoarvoe-mysql.services.clever-cloud.com";
    private $database = "bsaddm75r7d7kzoarvoe";
    private $username = "ubpvin7zbcnzymfz";
    private $password = "GJWvPUy0m80VR7nfLRoQ";
    private $charset = "utf8";

    function conectar(){
        try {
            $conection = "mysql:host=" . $this->hostname ."; dbname=". $this->database ."; charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            $pdo = new PDO($conection, $this->username, $this->password, $options);
            return $pdo;
        } catch (PDOExeption $e) {
            echo 'error conection: '. $e;
            exit;
        }
    }
}