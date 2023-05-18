<?php
require_once 'User.php';
require_once 'UserDAO.php';
class UserAuth{
    private $userDAO;
    
    public function __construct(UserDAO $userDAO) {
        $this->userDAO = $userDAO;
    }

    public function login($username, $password) {
        //$this->userDAO->getHashPassword($username);
        $hashed_password=$this->userDAO->getHashPassword($username);
        if (password_verify($password, $hashed_password)) {
            return true;
        }
        else{
            return false;
        }
    }
}
?>