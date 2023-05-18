<?php   
class DatabaseManager {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "evergreen";
    private $conn;

    public function __construct() {
        $this->conn = null;
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->conn;
    }
    public function closeConnection() {
        return $this->conn=null;
    }
}

?>