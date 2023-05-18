<?php
require_once '../includes/DatabaseManager.php';
require_once '../includes/UserDAO.php';


    if(isset($_POST['user_name'])){
        $username=$_POST['user_name'];
        $db = new DatabaseManager();
        $udao = new UserDAO($db);
        $result = $udao->getIdByUsername($username);
        if(empty($result)){
            echo json_encode("green");
            exit;
        }
        echo json_encode("red");
        exit;        
    }
?>