  <?php

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
session_start();

  if (!isset($_SESSION['identification']) && !isset($_SESSION['password']))
    header('Location:Index.php');

  include("../controller/configBd.php");
  include("../controller/ControllerConnection.php");
  include("../model/User.php");
  include("../controller/ControllerUser.php");
  include("../model/Account.php");
  include("../controller/ControllerAccount.php");
  include("../model/Transaction.php");
  include("../controller/ControllerTransaction.php");
  include("../utils/Utils.php");


  $ownerAccount = "ownerAccount";
  $thirdAccount = "thirdAccount";

  $button = $_POST['transfer'];
  $statusMoney = "display:none";
  $statusOwner = "display:none";
  $statusTransaction = "display:none";
  $statusThird = "display:none";
  $statusExists = "display:none";
  $statusActive = "display:none";

  $objControllerListAccount = new ControllerAccount("");
  $data = $objControllerListAccount->listAccount($_SESSION['identification']);

  if (isset($button)) {
    $accountOrigen = $_POST['txtAccountOrigen'];
    $accountDestiny = $_POST['txtAccountDestiny'];

    $money = $_POST['txtMoney'];
    $objAccountDestiny = new Account($accountDestiny, $money, "","");
    $objAccountOrigen = new Account($accountOrigen, $money, $SESSION["identification"],"");

    $objControllerAccountOrigen = new ControllerAccount($objAccountOrigen);
    $objResultAccountOrigen = $objControllerAccountOrigen->select();

    $objControllerResultDestiny = new ControllerAccount($objAccountDestiny);
    $objResultAccountDestiny = $objControllerResultDestiny->select();



    if (!empty($objResultAccountDestiny->getIdUser()) && $objResultAccountDestiny->getIdUser() != null) {
      if($objResultAccountDestiny->getActive()==1 && $objResultAccountOrigen->getActive()==1){
        if ($objResultAccountOrigen->getMoney() < $money) {
          $statusMoney = "display:block";
        } else {
          if ($_GET["type"] == "ownerAccount") {
            if ($objResultAccountDestiny->getIdUser() == $objResultAccountOrigen->getIdUser()) {
              $objUtils = new Utils();
              $objUtils->makeTransfer(
                $objAccountDestiny,
                $objControllerAccountOrigen,
                $accountOrigen,
                $accountDestiny,
                $money
              );
            } else {
              $statusOwner = "display:block";
            }
          }
  
          if ($_GET["type"] == "thirdAccount") {
            if ($objResultAccountDestiny->getIdUser() != $objResultAccountOrigen->getIdUser()) {
              $objUtils = new Utils();
              $objUtils->makeTransfer($objAccountDestiny, $objControllerAccountOrigen, $accountOrigen, $accountDestiny, $money);
            } else {
              $statusThird = "display:block";
            }
          }
        }
      }else{
        $statusActive = "display:block";

      }
     
    } else {
      $statusExists = "display:block";
    }
  }





  echo "
                        <!DOCTYPE html>
                        <html>
                        <head>
                        <meta charset='UTF-8'>
                  
                        <link rel=\"StyleSheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css\" type=\"text/css\">
                        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js\"></script>
                        <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js\"></script>
                        <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js\"></script>
                        <title>HomeBank</title>
                        <script type=\"text/javascript\">

                        function validate(){
                        
                                var accountOrigen =document.getElementById(\"txtAccountOrigen\").value;
                                var accountDestiny =document.getElementById(\"txtAccountDestiny\").value;
                                var money =document.getElementById(\"txtMoney\").value;
                            

                              if(accountOrigen ==accountDestiny){

                                  alert('La cuenta de origen es igual a la destino');
                                  return false;
                              }
      
                              if(money<=0){
                                  alert('El valor debe ser mayor a 0 para transferir');
                                  return false;
                              }
                  
                          
                        }
                        </script>
                      
                        </head>
                            <body>
                        
                            <form action=\"\" method=\"POST\">
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
          
                <form method=\"POST\" enctype=\"multipart/form-data\" onsubmit=\"return validate();\"> <br><br>

                <div class=\"container\" id=\"mi_tabla\">
                <br><br><br>
               <table class=\"table table-hover table-success tableFixHead\" >
                  <thead>
                    <tr class=\"\">
                      <th scope=\"col\">Transaccion Bancaria</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      
                      <td>
                      <label class=\"form-control\">Cuenta origen</label>
                      <select id=\"txtAccountOrigen\" name=\"txtAccountOrigen\"
                      class=\"form-control\" aria-label=\".form-select-sm example\">

    ";
  for ($i = 0; $i < count($data); $i++) {
    echo '<option value=' . $data[$i][0] . '>' . $data[$i][0] . '</option >';
  }

  echo "
  </select>
                      </td>

                        
                      <td><input type=\"text\" class=\"form-control\" id=\"txtAccountDestiny\" name=\"txtAccountDestiny\" placeholder=\"Cuenta Destino\" required>
                      <br></td>

                        
                      <td><input type=\"text\" class=\"form-control\" id=\"txtMoney\" name=\"txtMoney\" placeholder=\"Monto a transferir\" required>
                      <br></td>
                      <td> <button type=\"submit\" class=\"btn btn-primary\" value=\"transfer\"  name=\"transfer\">Transferir</button> <td>
                    </tr>
          
                    <tr>
                  
                  </div>
                    <tr>

                    <tr>
                    <td>  <div class=\"alert alert-warning\" role=\"alert\" style=\"$statusMoney\">
                    <strong>Oh!</strong> No hay cupo suficiente en la cuenta origen
                  </div>
                    <tr>
                    <tr>
                    <td>  <div class=\"alert alert-warning\" role=\"alert\"  style=\"$statusOwner\">
                    <strong>Oh!</strong> La cuenta destino no es propia
                  </div>
                    <tr>

                    <tr>
                    <td>  <div class=\"alert alert-warning\" role=\"alert\"  style=\"$statusThird\">
                    <strong>Oh!</strong> La cuenta destino no es de un tercero
                  </div>
                    <tr>

                    <tr>
                    <td>  <div class=\"alert alert-warning\" role=\"alert\"  style=\"$statusExists\">
                    <strong>Oh!</strong> La cuenta destino no existe
                  </div>
                    <tr>

                    <tr>
                    <td>  <div class=\"alert alert-warning\" role=\"alert\"  style=\"$statusActive\">
                    <strong>Oh!</strong> La cuenta no esta activa
                  </div>
                    <tr>

                  
                  </tbody>
                </table>
              </div>
                </form>                    
                            </body>
                        </html>
                        ";
  ?>