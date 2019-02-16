<?php
/**
 * @summary This class is used to contain the neccesary crud functions to interact with database records
 * @property object $pdo  a variable to store the connection
 * @method createData() create a database record
 * @method readData()   read a database record
 * @method updateData() update a database record
 * @method deleteData() delete a database record
*/
class DataHandler{
    public $pdo;

    /**
     * constructor for the datahandler
     *
     * @param string $database      database name for the connection
     * @param string $username      database username for the connection
     * @param string $password      database password for the connection
     */
    public function __construct(string $database, string $username, string $password) {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=$database;", $username, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch(PDOexeption $e) {
            $this->showError("Error: " . $e->getMessage());
        }
    }

    /**
     * used to insert data in the database
     *
     * @param string    $sql the sql query
     * @param array     $bindings (optional) the bindings used in the query
     * @return int      last insert id
     */
    public function createData(string $sql, array $bindings = []) {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($bindings);
        return $this->pdo->lastInsertId();
    }

    /**
     * reads data from a database
     *
     * @param string    $sql the sql query
     * @param array     $bindings (optional) the bindings for the query
     * @param boolean   $multiple (optional) if you want multiple rows or not
     * @return array    the data from the database
     */
    public function readData(string $sql, array $bindings = [], bool $multiple = true) {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($bindings);

        if($multiple) {
            return $sth->fetchAll();

        } else {
            return $sth->fetch();
        }
    }

    /**
     * updates data in the database
     *
     * @param string    $sql the sql query
     * @param array     $bindings (optional) the bindings for the query
     * @return int      last insert id
     */
    public function updateData(string $sql, array $bindings = []) {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($bindings);
        return $this->pdo->lastInsertId();
    }

    /**
     * deletes data in the database
     *
     * @param string    $sql the sql query
     * @param array     $bindings (optional) the bindings for the query
     * @return bool     if the query completed or not
     */
    public function deleteData(string $sql, array $bindings = []) {
        $sth = $this->pdo->prepare($sql);
        return $sth->execute($bindings);
    }
}
?>
