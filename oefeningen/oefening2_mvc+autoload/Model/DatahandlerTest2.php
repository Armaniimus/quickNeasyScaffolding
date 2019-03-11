<?php
/**
 *
 */
class Datahandler {
    function __construct() {
        $server = 'localhost';
        $user = 'root';
        $pass = '';
        $database = 'testDatabase';

        try {
            $this->pdo = new PDO("mysql:host=$server;dbname=$database", $user, $pass);

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    private function crudFunctions($sql, $bindings) {
        try {
            $query = $this->pdo->prepare($sql);
            $query->execute($bindings);
            return $query;
        } catch (\Exception $e) {}
    }

    public function create($sql, $bindings = []) {
        return $this->crudFunctions($sql, $bindings);
    }

    public function read($sql, $bindings = [], $multible = true) {
        $result = $this->crudFunctions($sql, $bindings);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        if ($multible) {
            return $result->fetchAll();
        } else {
            return $result->fetch();
        }
    }

    public function update($sql, $bindings = []) {
        return $this->crudFunctions($sql, $bindings);
    }

    public function delete($sql, $bindings = []) {
        return $this->crudFunctions($sql, $bindings);
    }
}

?>
