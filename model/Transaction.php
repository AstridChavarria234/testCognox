<?php


class Transaction{
    var $code;
    var $numberAccountOrigen;
    var $numberAccountDestiny;
    var $money;
    var $date;
    function __construct($code,$numberAccountOrigen,$numberAccountDestiny,$money,$date)
    {
        $this->code=$code;
        $this->numberAccountOrigen=$numberAccountOrigen;
        $this->numberAccountDestiny=$numberAccountDestiny;

        $this->money=$money;
        $this->date=$date;
    }

    function getCode() { return $this->code; }

    function getNumberAccountOrigen() { return $this->numberAccountOrigen; }
    function getNumberAccountDestiny() { return $this->numberAccountDestiny; }


    function getMoney() { return $this->money; }


    function getDate() { return $this->date; }
}

?>