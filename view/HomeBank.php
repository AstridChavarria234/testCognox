 <?php
         error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
session_start();


if(!isset($_SESSION['identification']) && !isset($_SESSION['password']))
header('Location:Index.php');

                      include("../controller/configBd.php");
                      include("../controller/ControllerConnection.php");
                      include("../model/User.php");
                      include("../controller/ControllerUser.php");
                      include("../model/TransactionBank.php");

$ownerAccount ="ownerAccount";
$thirdAccount="thirdAccount";

                  
                
echo"
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>

<link rel=\"StyleSheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css\" type=\"text/css\">
<link rel=\"Stylesheet\" href=\"https://use.fontawesome.com/releases/v5.6.1/css/all.css\" integrity=\"sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP\" crossorigin=\"anonymous\">
<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js\"></script>
<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js\"></script>
<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js\"></script>


<title>Home</title>
</head>
    <body>

    <form action=\"TransactionBank.php\" method=\"POST\">
    <nav class=\"navbar navbar-expand-lg navbar-dark bg-dark\">
    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarTogglerDemo01\" aria-controls=\"navbarTogglerDemo01\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
      <span class=\"navbar-toggler-icon\"></span>
    </button>
    <div class=\"collapse navbar-collapse\" id=\"navbarToggler\">
      <a class=\"navbar-brand\" href=\"#\">HOME BANK</a>
      <ul class=\"navbar-nav mr-auto mt-2 mt-lg-0\">


      </li>
        
                <li class=\"nav-item dropdown\">
        
                <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownMenuLink\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                Transacciones Bancarias
                </a>
                <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdownMenuLink\">
                <a class=\"dropdown-item\"style=\"\" href=\"TransactionBank.php?type=$ownerAccount\">Cuentas propias</a>
                <a class=\"dropdown-item\" style=\"\" href=\"TransactionBank.php?type=$thirdAccount\"\">Cuentas terceros</a>
                <a class=\"dropdown-item\" style=\"\" href=\"ListTransaction.php\">Ver transacciones</a>

              </li>
          </ul>
      <form class=\"form-inline my-2 my-lg-0\">
        <a class=\"btn btn-outline-success my-2 my-sm-0\" href=\"CerrarSesion.php\" style=\"color:white\">Cerrar Sesion
        </a>
      </form>
    </div>
  </nav>

  </form>

  </body>
  </html>
";
 