<?php


class User{

    var $id;
    var $user;
    var $password;
    function __construct($id,$user,$password)
    {
        $this->id=$id;
        $this->user=$user;
        $this->password=$password;
    }

    function setId($id) { $this->setId = $id; }
    function getId() { return $this->id; }

    function setUser($user) { $this->setUser = $user; }
    function getUser() { return $this->user; }

    function setPassword($password) { $this->setPassword = $password; }
    function getPassword() { return $this->password; }
}

?>