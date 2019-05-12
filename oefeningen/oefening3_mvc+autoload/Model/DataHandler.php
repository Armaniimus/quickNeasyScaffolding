<?php

/**
 *
 */
class DataHandler {

    function __construct($server, $db, $user, $pass) {
        try {
            $this->conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    private function crudFunc($sql, $bindings) {
        $query = $this->conn->prepare($sql);
        $query->execute($bindings);
        return $query;
    }

    public function create($sql, $bindings = []) {
        return $this->crudFunc($sql, $bindings);
    }

    public function read($sql, $bindings = [], $multible = TRUE) {
        $query = $this->crudFunc($sql, $bindings);

        if ($multible) {
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $data = $query->fetch(PDO::FETCH_ASSOC);
        }
        return $data;
    }

    public function update($sql, $bindings = []) {
        return $this->crudFunc($sql, $bindings);
    }

    public function delete($sql, $bindings = []) {
        return $this->crudFunc($sql, $bindings);
    }
}


?>
