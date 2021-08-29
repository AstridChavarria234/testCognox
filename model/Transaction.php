<?php


class Transaction{
    var $code;
    var $numberAccount;
    var $money;
    var $date;
    function __construct($code,$numberAccount,$money,$date)
    {
        $this->code=$code;
        $this->numberAccount=$numberAccount;
        $this->money=$money;
        $this->date=$date;
    }

    function getCode() { return $this->code; }

    function getNumberAccount() { return $this->numberAccount; }

    function setMoney($money) { $this->setMoney = $money; }
    function getMoney() { return $this->money; }


    function getDate() { return $this->date; }
}

?>