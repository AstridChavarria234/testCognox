<?php

class ControllerAccount
{
	var $objAccount;

	function __construct($objAccount)
	{
		$this->objAccount = $objAccount;
	}
	function updateAccount()
	{

		$numberAccount = $this->objAccount->getNumberAccount();
		$money = $this->objAccount->getMoney();

		$sv="localhost";
        $us="root";
        $ps="";
        $bd="bankcognox";

        $objConnection=new ControllerConnection();
        $objConnection->openBd($sv,$us,$ps,$bd);

		$commandSql = "SELECT * FROM account  WHERE numberAccount='" . $numberAccount . "'";
		$recordSet = $objConnection->executeSelect($commandSql);
		$register = $recordSet->fetch_array(MYSQLI_BOTH);
		$objRResultAccount = new Account($register["numberAccount"], $register["money"], $register["idUser"],$register["active"]);


		$sumMoneyAccountDestiny = $money + $objRResultAccount->getMoney();
		$commandSql = "UPDATE account SET money=$sumMoneyAccountDestiny WHERE numberAccount='" . $numberAccount . "'";
		$objConnection->executeCommandSql($commandSql);
		$objConnection->closeBd();
	}


	function updateOrigenAccount()
	{

		$sv = "localhost";
		$us = "root";
		$ps = "123";
		$bd = "bankCognox";


		$numberAccount = $this->objAccount->getNumberAccount();
		$money = $this->objAccount->getMoney();
		$idUser = $this->objAccount->getIdUser();

		$objConnection = new ControllerConnection();
        $objConnection->openBd($sv,$us,$ps,$bd);

		$commandSql = "SELECT * FROM account  WHERE numberAccount='" . $numberAccount . "'";
		$recordSet = $objConnection->executeSelect($commandSql);
		$register = $recordSet->fetch_array(MYSQLI_BOTH);
		$objRResultAccount = new Account($register["numberAccount"], $register["money"], $register["idUser"],$register["active"]);

		$quiteMoneyAccountOrigen = $objRResultAccount->getMoney() - $money;
		$commandSql = "UPDATE account SET money=$quiteMoneyAccountOrigen WHERE numberAccount='" . $numberAccount . "'";
		$objConnection->executeCommandSql($commandSql);
		$objConnection->closeBd();
	}



	function select()
	{

		$sv = "localhost";
		$us = "root";
		$ps = "123";
		$bd = "bankCognox";

		$numberAccount = $this->objAccount->getNumberAccount();

		$objConnection = new ControllerConnection();
        $objConnection->openBd($sv,$us,$ps,$bd);

		$commandSql = "SELECT * FROM account  WHERE  numberAccount='" . $numberAccount . "' ";
		$recordSet = $objConnection->executeSelect($commandSql);
		$register = $recordSet->fetch_array(MYSQLI_BOTH);
		$objRResultAccount = new Account($register["numberAccount"], $register["money"], $register["idUser"],$register["active"]);
		$objConnection->closeBd();

		return $objRResultAccount;
	}





	function listAccount($identification)
	{

		$sv = "localhost";
		$us = "root";
		$ps = "123";
		$bd = "bankCognox";
		$objConnection = new ControllerConnection();
        $objConnection->openBd($sv,$us,$ps,$bd);
		$commandSql = "SELECT * FROM account WHERE idUser = $identification AND active=1";

		$recordSet = $objConnection->executeSelect($commandSql);

		while ($register = $recordSet->fetch_array(MYSQLI_BOTH)) {
			$data[] = $register;
		}

		$objConnection->closeBd();
		return $data;
	}
}
