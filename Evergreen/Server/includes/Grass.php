<?php
class Grass{
    private $id;
    private $name;
    private $price;
    public function __construct($name,$price) {
        $this->name=$name;
        $this->price=$price;
    }

    public function setId($id){
        $this->id=$id;
    }
    public function getId(){
        $this->id;
    }
    /*public function setPrice(){
        $this->price=$price;
    }*/
    public function getName(){
        return $this->name;
    }
    public function getPrice(){
        return $this->price;
    }
}
?>