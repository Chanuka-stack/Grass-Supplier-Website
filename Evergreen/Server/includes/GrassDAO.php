<?php 
require_once 'Grass.php';
require_once 'DatabaseManager.php';
class GrassDAO{
    private $db;
    public function __construct($db) {
        $this->db=$db;
    }

    public function addGrass(Grass $grass) {
        try{
            $query = "INSERT INTO grass (grass_name,price) VALUES (:grass, :price)";
            $stmt = $this->db->getConnection()->prepare($query);
            $name = $grass->getName();
            $price = $grass->getPrice();
            $stmt->bindParam(':grass', $name);
            $stmt->bindParam(':price', $price);
            $stmt->execute();
    
            $id = $this->db->getConnection()->lastInsertId();
            $grass->setId($id);
            $this->db->closeConnection();
            return true;
        }
        catch(PDOException $e) {
           return false;
        } 
    }

    public function getAllGrass(){
        try{
            $stmt = $this->db->getConnection()->prepare("SELECT * FROM grass");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) {
            return false;
        } 
        finally{
            $this->db->closeConnection();
        }
    }

    public function getGrassById($id) {
        try{
            $stmt = $this->db->getConnection()->prepare("SELECT * FROM grass WHERE grass_id = :grass_id");
            $stmt->bindValue(":grass_id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) {
            return false;
        } 
        finally{
            $this->db->closeConnection();
        }
    }

    public function updateGrass($id,$name,$price){
        try{
            $stmt = $this->db->getConnection()->prepare("UPDATE grass SET grass_name = :grass_name, price = :price WHERE grass_id = :grass_id");
          
            $stmt->bindValue(":grass_id", $id);
            $stmt->bindValue(":grass_name", $name);
            $stmt->bindValue(":price", $price);
            $stmt->execute();
            $this->db->closeConnection();
            return true;
        }
        catch(PDOException $e) {
            return false;
        } 
    }    
    public function deleteGrass($id) {
        try{
            $stmt = $this->db->getConnection()->prepare("DELETE FROM grass WHERE grass_id = :grass_id");
            $stmt->bindParam(':grass_id', $id);
            $stmt->execute();
            $this->db->closeConnection();
            return true;
        }
        catch(PDOException $e) {
            return false;
        } 
    }
}

?>