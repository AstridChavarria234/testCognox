<?php


class Account{

    var $numberAccount;
    var $money;
    var $idUser;
    var $active;
    function __construct($numberAccount,$money,$idUser,$active)
    {
        $this->numberAccount=$numberAccount;
        $this->money=$money;
        $this->idUser=$idUser;
        $this->active=$active;
    }

    
    function getNumberAccount() { return $this->numberAccount; }
    function setMoney($money) { $this->setMoney = $money; }
    function getMoney() { return $this->money; }
    function getIdUser() { return $this->idUser; }
    function getActive() { return $this->active; }

}

?>