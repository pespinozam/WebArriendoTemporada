<?php  
include("../admin/config/bdPaypal.php"); 
include("../admin/config/bdsitio.php");



$json = file_get_contents('php://input');
$datos = json_decode($json, true);

echo '<pre>';
print_r($datos);
echo '</pre>';

if(is_array($datos)){

    $id_transaccion = $datos['detalles'];
}

?> 