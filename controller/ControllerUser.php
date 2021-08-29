<?php 

class ControllerUser {
    var $objUser;

    function __construct($objUser){
    $this->objUser=$objUser;

    }


     function selectUser(){
  
        $user=$this->objUser->getUser();
        $password=$this->objUser->getPassword();

        $objConnection = new ControllerConnection();
        $objConnection->openBd($GLOBALS['serv'],$GLOBALS['us'],$GLOBALS['pass'],$GLOBALS['bdd']);
        
        $commandSql="SELECT * FROM user  WHERE identification='".$user."' AND password='".$password."'";
        $recordSet=$objConnection->executeSelect($commandSql);
        $register = $recordSet->fetch_array(MYSQLI_BOTH);
        $objUser1= new User($register["id"], $register["identification"], $register["password"]);
        $objConnection->closeBd();

        return $objUser1;
    
    
    }


    


}
