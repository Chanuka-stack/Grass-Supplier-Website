<?php 
require_once 'User.php';
require_once 'DatabaseManager.php';
class UserDAO{
    private $db;
    public function __construct($db) {
        $this->db=$db;
    }

    public function addUser($username,$password) {
        try{
            $query = "INSERT INTO admin (username,password) VALUES (:username, :password)";
            $stmt = $this->db->getConnection()->prepare($query);
            $hashed_password = password_hash($password,PASSWORD_DEFAULT);
            $stmt->bindParam(':username',$username);
            $stmt->bindParam(':password',$hashed_password);
            $stmt->execute();
    
            $id = $this->db->getConnection()->lastInsertId();
            $id = $this->db->getConnection()->lastInsertId();
            $user = new User($username, $hashed_password);
            $user->setId($id);
            $this->db->closeConnection();
            return true;
        }
        catch(PDOException $e) {
           return false;
        } 
    }

    public function getHashPassword($username) {
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        $query="SELECT password FROM admin where username=:username";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':username',$username);
        $stmt->execute();
        $result= $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$result){
            return false;
        }
        $hashedPassword = $result["password"];
        return $hashedPassword;
     }
  
     private function hashPassword($password) {
        $options = [
           'cost' => 12,
        ];
        return password_hash($password, PASSWORD_BCRYPT, $options);
     }

     public function updateUser($id,$username,$password){
        try{
            $stmt = $this->db->getConnection()->prepare("UPDATE admin SET username = :username, password = :password WHERE admin_id = :admin_id");
            $hashed_password = password_hash($password,PASSWORD_DEFAULT);
            $stmt->bindValue(":admin_id", $id);
            $stmt->bindValue(":username", $username);
            $stmt->bindValue(":password", $hashed_password);
            $stmt->execute();
            $this->db->closeConnection();
         
        }
        catch(PDOException $e) {
            return false;
        } 
    } 

    public function deleteUser($id) {
        try{
            $stmt = $this->db->getConnection()->prepare("DELETE FROM admin WHERE admin_id = :admin_id");
            $stmt->bindParam(':admin_id', $id);
            $stmt->execute();
            $this->db->closeConnection();
        }
        catch(PDOException $e) {
            return false;
        } 
    }

    public function getIdByUsername($username) {
        try{
            $stmt = $this->db->getConnection()->prepare("SELECT * FROM admin WHERE username = :username");
            $stmt->bindValue(":username", $username);
            $stmt->execute();
            $result=$stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
        catch(PDOException $e) {
            return false;
        } 
        finally{
            $this->db->closeConnection();
        }
    }
    public function getUserById($id) {
        try{
            $stmt = $this->db->getConnection()->prepare("SELECT * FROM admin WHERE admin_id = :admin_id");
            $stmt->bindValue(":admin_id", $id);
            $stmt->execute();
            $result =$stmt->fetch(PDO::FETCH_ASSOC);
            $this->db->closeConnection();
            return $result;
        }
        catch(PDOException $e) {
            return false;
        } 
    }
}
?>