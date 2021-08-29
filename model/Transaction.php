<?php


class Transaction{

    var $numberAccount;
    var $money;
    var $date;
    function __construct($numberAccount,$money,$date)
    {
        $this->numberAccount=$numberAccount;
        $this->money=$money;
        $this->date=$date;
    }

    
    function getNumberAccount() { return $this->numberAccount; }

    function setMoney($money) { $this->setMoney = $money; }
    function getMoney() { return $this->money; }

   
    function getDate() { return $this->date; }
}

?>