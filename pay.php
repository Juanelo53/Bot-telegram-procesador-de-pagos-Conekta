<?php
require_once('config/variables.php');
require_once('functions/functions.php');
require_once("business/Payment.php"); // AQUI ENCONTRARAS EL CODIGO PARA PONER LA API KEY PRIVADA
extract($_REQUEST);

$oPayment= new Payment($conektaTokenId, $card,$name,$description,$total,$email);

if($oPayment->pay()){
    echo json_encode('Pago exitoso');
}else{
    echo json_encode($oPayment->error);
}

?>