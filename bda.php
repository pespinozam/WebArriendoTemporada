<?php 

define("KEY_TOKEN","BbCmJzLr.c-032003*");
define("MONEDA","$");

$num_cart=0;
if (isset($_SESSION['carrito']['departamento'])){
    $num_cart = count($_SESSION['carrito']['departamento']);
}
?>