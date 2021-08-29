<?php

error_reporting(E_ALL ^ E_NOTICE);
session_start();

include("../model/User.php");
include("../controller/ControllerUser.php");
include("../controller/ControllerConnection.php");

$id = $_POST['txtUser'];
$password = $_POST['txtPassword'];
$statusOpen = "display:none";
$button = $_POST['btn'];

if ($button = "Login") {

    if (isset($id) && isset($password)) {

        $objUser = new User("", $id, $password);
        $objControllerUser = new ControllerUser($objUser);
        $objUser = $objControllerUser->selectUser();

        $_SESSION['identification'] = $objUser->getUser();
        $_SESSION['password'] = $objUser->getPassword();

        if ($objUser->getUser() != null) {

            header('Location:HomeBank.php');
        } else {
            $statusOpen = "display:block";
        }
    }
}


echo "
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>

<link rel=\"StyleSheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css\" type=\"text/css\">
<link rel=\"Stylesheet\" href=\"https://use.fontawesome.com/releases/v5.6.1/css/all.css\" integrity=\"sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP\" crossorigin=\"anonymous\">
<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js\"></script>
<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js\"></script>

<script type=\"text/javascript\">

function validate(){

    var id =document.getElementById(\"user\").value;
    var password =document.getElementById(\"password\").value;
    
    if(id.length==0 ){  
        alert('Usuario requerido'); 
        return false;
    }
    if(password.length==0){

        alert('Clave requerida');
        return false;
    }

    if(isNaN(password)){

        alert('Clave debe ser numerica');
        document.getElementById(\"password\").value = '';
        return false;
    }

    if(password.length>4 ||password.length<4 ){

        alert('Clave debe ser igual a 4 cifras');
        document.getElementById(\"password\").value = '';
        return false;
    }
    if(id.length==0 ){  
        alert('Usuario requerido'); 
        return false;
    }
}
</script>

<style>

html,body{
background-size: cover;
background-repeat: no-repeat;
height: 100%;
font-family: 'Numans', sans-serif;
}

.container{
height: 100%;
align-content: center;
}

.card{
height: 370px;
margin-top: auto;
margin-bottom: auto;
width: 400px;
background-color: rgba(0,0,0,0.5) !important;
}

.social_icon span{
font-size: 50px;
margin-left: 20px;
color: #33FF36;
}

.social_icon span:hover{
color: white;
cursor: pointer;
}

.card-header h3{
color: white;
}

.social_icon{
position: absolute;
right: 20px;
top: -45px;
}

.input-group-prepend span{
width: 50px;
background-color: #33FF36;
color: black;
border:0 !important;
}

input:focus{
outline: 0 0 0 0  !important;
box-shadow: 0 0 0 0 !important;

}

.remember{
color: white;
}

.remember input
{
width: 20px;
height: 20px;
margin-left: 15px;
margin-right: 5px;
}

.login_btn{
color: black;
background-color: #33FF36;
width: 100px;
}

.login_btn:hover{
color: black;
background-color: white;
}

.links{
color: white;
}

.links a{
margin-left: 4px;
}
</style>




<title>Inicio Sesion</title>
</head>
    <body>

    <div class=\"alert alert-warning\" role=\"alert\"  id=\"txtInactivado\" style=\"$statusOpen\">
    <strong>Ups!</strong> El usuario no se encuentra registrado en la base de datos
    </div>
    

    <div class=\"container\">
    <div class=\"d-flex justify-content-center h-100\">
        <div class=\"card\">
            <div class=\"card-header\"><h3>Inicio de Sesion</h3></div>
            <div class=\"card-body\">
            <form action=\"Index.php\" method=\"POST\" onsubmit=\"return validate()\">
                    <div class=\"input-group form-group\">
                        <div class=\"input-group-prepend\">
                            <span class=\"input-group-text\"><i class=\"fas fa-user\"></i></span>
                        </div>
                        <input type=\"text\" class=\"form-control\" id=\"user\" name=\"txtUser\" placeholder=\"Usuario\">
                        
                    </div>
                    <div class=\"input-group form-group\">
                        <div class=\"input-group-prepend\">
                            <span class=\"input-group-text\"><i class=\"fas fa-key\"></i></span>
                        </div>
                        <input type=\"password\" class=\"form-control\" id=\"password\" name=\"txtPassword\" placeholder=\"Clave\">
                    </div>
                    <div class=\"form-group\">
                        <input type=\"submit\"  name =\"btn\" value=\"Login\"  class=\"btn float-right login_btn\">
                    </div>
            
            </div>
        </form>
        </div>
    </div>
</div>
</body>
    </body>
</html>
";
