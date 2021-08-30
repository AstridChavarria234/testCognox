<?php 

class ControllerTransaction {
    var $objTransaction;

    function __construct($objTransaction){
    $this->objTransaction=$objTransaction;

    }


    function insertTransaction(){

		$sv="localhost";
		$us="root";
		$ps="123";
		$bd="bankCognox";
	
        $codeAccount=$this->objTransaction->getCode();
        $numberAccountOrigen=$this->objTransaction->getNumberAccountOrigen();
        $numberAccountDestiny=$this->objTransaction->getNumberAccountDestiny();

        $moneyAccount=$this->objTransaction->getMoney();
        $dateAccount=$this->objTransaction->getDate();

        $objConnection=new ControllerConnection();
        $objConnection->openBd($sv,$us,$ps,$bd);
        $commandSql="INSERT INTO transaction(code,numberAccountOrigen,numberAccountDestiny,money,date) VALUES('".$codeAccount."','".$numberAccountOrigen."','".$numberAccountDestiny."',".$moneyAccount.",'".$dateAccount."')";
        $objConnection->executeCommandSql($commandSql);
        $objConnection->closeBd();
    }


    function selectAll($identification){

		$sv="localhost";
		$us="root";
		$ps="123";
		$bd="bankCognox";
    
        $objConnection=new ControllerConnection();
        $objConnection->openBd($sv,$us,$ps,$bd);
        $commandSql="SELECT * FROM TRANSACTION";
        $recordSet=$objConnection->executeSelect($commandSql);

        $cont=0;
        $cuan=0;
        
        while($register = $recordSet->fetch_all(MYSQLI_BOTH)){

            $data = (array)($register);
            $numberAccountOrigen =$data[$cont][1];
            $command="SELECT * FROM account  WHERE idUser=$identification 
            AND numberAccount='" . $numberAccountOrigen . "'";
            $record=$objConnection->executeSelect($command);
            $dataRegister = $record->fetch_array(MYSQLI_BOTH);

            if(count($dataRegister)>0){
                
                $transaction=$data;
            }

            $cont=$cont++;
        }
        
        $cont=0;
        $objConnection->closeBd();
        return $transaction;

    }


    function countAll($startFrom,$tamPages){


        $sv="localhost";
		$us="root";
		$ps="123";
		$bd="bankCognox";
        
        $objConnection=new ControllerConnection();
        $objConnection->openBd($sv,$us,$ps,$bd);
        $commandSql="SELECT *  FROM transaction LIMIT ".$startFrom." , ".$tamPages."";
        $recordSet=$objConnection->executeSelect($commandSql);      
            while($register = $recordSet->fetch_all(MYSQLI_BOTH)){
    
                $transactionPage=(array)$register;
        
            }
          
       
        $objConnection->closeBd();
        return $transactionPage;

    }
        
}