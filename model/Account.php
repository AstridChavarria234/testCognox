<?php


class Account{

    var $numberAccount;
    var $money;
    var $idUser;
    function __construct($numberAccount,$money,$idUser)
    {
        $this->numberAccount=$numberAccount;
        $this->money=$money;
        $this->idUser=$idUser;
    }

    
    function getNumberAccount() { return $this->numberAccount; }

    function setMoney($money) { $this->setMoney = $money; }
    function getMoney() { return $this->money; }

   
    function getIdUser() { return $this->idUser; }
}

?>