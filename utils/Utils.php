 <?php

class Utils{

    function __construct(){}
        
    function makeTransfer($objAccountDestiny,$objControllerAccountOrigen,$accountOrigen,$accountDestiny,$money){
        $objControllerAccountDestiny = new ControllerAccount($objAccountDestiny);
        $objControllerAccountDestiny->updateAccount();
        $objControllerAccountOrigen->updateOrigenAccount();
        $codeTransaction = mt_rand(10000, 20000);
        $date=date("Y-m-d H:i:s");
        $objTransaction = new Transaction($codeTransaction, $accountOrigen,$accountDestiny, $money,$date);
        $objControllerTransaction = new ControllerTransaction($objTransaction);
        $objControllerTransaction->insertTransaction();

        echo "
        <script>
        alert('Numero de transaccion '+$codeTransaction);
        </script>
        ";
       
      }  
    

}

 
?> 