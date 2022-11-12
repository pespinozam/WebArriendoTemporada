<?php

$cod_venta = rand(0,9) . date('H') . date('i') . date('s');
// $estado = $_POST['estado'];
// $metodo_de_pago = $_POST['metodo_de_pago'];
// $cantidad = $_POST['cantidad'];
// $id_producto = $_POST['producto_id'];
// $fecha_pago = date('d-m-Y');
// $origen = $_POST['origen'];
// // $token = $_POST['token'];
// $neto = $_POST['neto'];
// $iva = $_POST['iva'];
// $total_pagar = $_POST['total_pagar'];


// for ($i=0; $i < count($id_producto); $i++) { 
//     # code...

// }

// $post = [
//     'buy_order' => $cod_venta,
//     'session_id' => rand(10000,99999),
//     'amount'   => (int) 10000,
//     'return_url' => "http://localhost/sitiowebportafolio/venta/return_pago_webpay.php"
// ];

// // var_dump($post);
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL,"");
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS,$post);  //Post Fields
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


// $headers = [
//     "Tbk-Api-Key-Id" => "597055555532",
//     "Tbk-Api-Key-Secret" => "579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C",
//     "Content-Type" => "application/json",
// ];

// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// $server_output = curl_exec($ch);

// curl_close ($ch);

// var_dump($server_output);

$post = [
    'buy_order' => $cod_venta,
    'session_id' => rand(10000,99999),
    'amount'   => 10000,
    'return_url' => "http://localhost/sitiowebportafolio/venta/return_pago_webpay.php"
];
$url = "https://webpay3gint.transbank.cl/rswebpaytransaction/api/webpay/v1.2/transactions";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    "Tbk-Api-Key-Id:597055555532",
    "Tbk-Api-Key-Secret:579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C",
    "Content-Type:application/json"
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

// var_dump($post);
curl_setopt($curl, CURLOPT_POSTFIELDS, $post);

$resp = curl_exec($curl);
curl_close($curl);

echo json_encode($resp);

?>