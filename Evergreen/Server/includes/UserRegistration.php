<?php
require_once 'UserDAO.php';

class UserRegistration {
    private $userDAO;

    public function __construct(UserDAO $userDAO) {
        $this->userDAO = $userDAO;
    }

    public function register($username, $password) {
        $this->userDAO->addUser($username, $password);
        return true;
    }
}
?>
