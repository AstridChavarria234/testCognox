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

                               include("../model/Transaction.php");
                               include("../controller/ControllerTransaction.php");

                               $ownerAccount ="ownerAccount";
                               $thirdAccount="thirdAccount";    
                               $statusAccount="display:none";               
           
        try{

       
            $objTransaction= new Transaction("","","","","");
            $objControllerTransaction= new ControllerTransaction($objTransaction);
            
            $objTransaction=$objControllerTransaction->selectAll($_SESSION['identification']);

      if(count($objTransaction)<=0){

        $statusAccount="display:block";

      }

      $numberRow = count($objTransaction);
       $tamPages=4;
       $totalPages= ceil($numberRow/$tamPages);

       if (isset($_GET["page"])) {       

            if($_GET["page"]==1){
                 
                 header('location:ListTransaction.php');
                 $page=1;
                 $ant=1;
                 if($totalPages==1){
                  $sig=1;
                 }else{
                 $sig=$page+1;}

            }else{

              $pagina=$_GET["page"];
              $ant=$page-1;
              if($page>=$totalPages)
                {

                    $sig=$totalPages;
                }else{
              $sig=$page+1;
            }

            }

        }else{
          $page=1;
          $ant=1;
          if($totalPages==1){
                  $sig=1;
                 }else{
                 $sig=$page+1;}

        }



        $startFrom=($page-1)*$tamPages;


        $objTransaction= new Transaction("","","","","");
        $objControllerTransaction= new ControllerTransaction($objTransaction);
        $objTransaction=$objControllerTransaction->countAll($startFrom,$tamPages);
        $dataAccount= (array)$objTransaction;
        $length = count($dataAccount);

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
                <a class=\"dropdown-item\" style=\"\" href=\"ListTransaction.php?page=".$i."'\">Ver transacciones</a>

              </li>
          </ul>
      <form class=\"form-inline my-2 my-lg-0\">
        <a class=\"btn btn-outline-success my-2 my-sm-0\" href=\"CerrarSesion.php\" style=\"color:white\">Cerrar Sesion
        </a>
      </form>
    </div>
  </nav>

  </form>
";

       echo"
        <br><br>
                 <table class='table table-hover'>

                  <tr>
                  <th>Cuenta origen</th>
                  <th>Cuenta destino</th>
                  <th>Monton de la transaccion</th>
                  <th>Fecha de la transaccion</th>

                </tr>

            ";

        for ($i=0;$i<$length; $i++) {
          echo"
              <tr>

                <td>".$dataAccount[$i]["numberAccountOrigen"]."</td>
                <td>".$dataAccount[$i]["numberAccountDestiny"]."</td>
                <td>".$dataAccount[$i]["money"]."</td>
                <td>".$dataAccount[$i]["date"]."</td>
        
              </tr>
              ";
          
        }

        echo"</table>";


        }catch(Exception $e){

            echo "Failed line: " .$e->getLine();

        }

   echo"

    <nav aria-label='Page navigation example'>
    <ul class='pagination list'>

    <li class='page-item'><a class='page-link key' href='ListTransaction.php?page=".$ant."'>Anterior</a></li>"; 
      for($i=1; $i<=$totalPages; $i++){

        if($page==$i){
        echo"
          <li class='page-item active ' ><a class='page-link key' href='#'>".$page."</a></li>";
        }
        else{
          echo"
          <li  class='page-item'><a class='page-link key' href='ListTransaction.php?page=".$i."'>".$i."</a></li>";
        }
      }
       echo"
    
        <li class='page-item'><a class='page-link key' href='ListTransaction.php?page=".$sig."'>Siguiente</a></li>
    </ul>
    </nav>

    <tr>
    <td>  <div class=\"alert alert-warning\" role=\"alert\"  style=\"$statusAccount\">
    <strong>Oh!</strong> No hay transferencias
  </div>
    <tr>
    ";


        echo"
                    
                </div>
                </div>
                </div>
                </body>
                </html>
                "

?> 