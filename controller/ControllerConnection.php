<?php

class ControllerConnection{
	
	var $conn;
	function __construct(){
		$this->conn=null;
	}
	
    function openBd($servidor, $usuario, $password,$db){
    	try	{
			$this->conn = new mysqli($servidor, $usuario, $password, $db);
			if ($this->conn->connect_errno) {
			printf("Connect failed: %s\n", $this->conn->connect_error);
			exit();
			}
      	}
      	catch (Exception $e){
          	echo "Failed connected".$e->getMessage()."\n";
      	}

    }

    function closeBd() {
		try{
       $this->conn->close();
		}
      	catch (Exception $e){
			echo "Failed connected".$e->getMessage()."\n";
      	}		
    }

    function executeCommandSql($sql) {
    	try	{
    		
			$this->conn->query($sql);
			}
		catch (Exception $e) {
				echo "Failed not registers: ". $e->getMessage()."\n";
		  }	
		}

	function executeSelect($sql) {
			try	{
				$recordSet=$this->conn->query($sql);
				}
	
			catch (Exception $e) {
					echo " Failed: ". $e->getMessage()."\n";
			  }	
		return $recordSet;
			}   
}
?>