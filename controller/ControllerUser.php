<?php 

class ControllerUser {
    var $objUser;

    function __construct($objUser){
    $this->objUser=$objUser;

    }


     function selectUser(){
        $sv="localhost";
        $us="root";
        $ps="123";
        $bd="bankcognox";
        $user=$this->objUser->getUser();
        $password=$this->objUser->getPassword();

        $objConnection = new ControllerConnection();
        $objConnection->openBd($sv,$us,$ps,$bd);
        
        $commandSql="SELECT * FROM user  WHERE identification='".$user."' AND password='".$password."'";
        $recordSet=$objConnection->executeSelect($commandSql);
        $register = $recordSet->fetch_array(MYSQLI_BOTH);
        $objUser1= new User($registro["id"], $register["identification"], $register["password"]);
        $objConnection->closeBd();

        return $objUser1;
    
    
    }


    


}



?>

