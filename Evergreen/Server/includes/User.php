<?php
class User{
    private $id;
    private $username;
    private $password;

    public function __construct($username,$password){
        $this->username=$username;
        $this->password=$password;
    }

    public function setId($id){
        $this->id=$id;
    }
    public function getId(){
        $this->id=$id;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getPassword(){
        return $this->password;
    }
}
?>