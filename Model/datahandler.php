<?php
/**
 * @summary This class is used to contain the neccesary crud functions to interact with database records
 * @property object $pdo  a variable to store the connection
 * @method createData() create a database record
 * @method readData()   read a database record
 * @method updateData() update a database record
 * @method deleteData() delete a database record
*/
class DataHandler {
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
     * insert data in the database
     *
     * @param string    $sql the sql query
     * @return array    boolean
     */
    public function createData(string $sql) {
		return $this->conn->query($sql);
	}

    /**
     * reads data from a database
     *
     * @param string    $sql the sql query
     * @param boolean   $multiple (optional) if you want multiple rows or not
     * @return array    the data from the database
     */
    public function readData(string $sql, bool $multiple = true) {
        $sth = $this->pdo->prepare($sql);
        $sth->execute();

        if($multiple) {
            return $sth->fetchAll();

        } else {
            return $sth->fetch();
        }
    }

    /**
     * update data in the database
     *
     * @param string    $sql the sql query
     * @return array    boolean
     */
	public function updateData(string $sql) {
		return createData($sql);
	}

    /**
     * delete data in the database
     *
     * @param string    $sql the sql query
     * @return array    boolean
     */
	public function deleteData(string $sql) {
		return createData($sql);
	}
}
?>
