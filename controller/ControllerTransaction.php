<?php 

class ControlerTransaction {
    var $objTransaction;

    function __construct($objTransaction){
    $this->objTransaction=$objTransaction;

    }


    function insertTransaction(){

		$sv="localhost";
		$us="root";
		$ps="123";
		$bd="bankCognox";
	

        $number=$this->objTransaction->getNumberAccount();
        $moneyAccount=$this->objTransaction->getMoney();
        $dateAccount=$this->objTransaction->getDate();
      
        $objConnection = new ControllerConnection();
        $objConnection->openBd($sv,$us,$ps,$bd);

        $commandSql="INSERT INTO transaction(numberAccount,money,date) VALUES('".$number."','".$moneyAccount."',".$dateAccount.")";
        $objConnection->ejecutarComandoSql($commandSql);
        $objConnection->closeBd();
    }
}
    ?>