<?php  
require '../bda.php';
require '../admin/config/bdDepartamento.php';

if(isset($_POST['id'])){

    $id = $_POST['id'];
    $token = $_POST['token'];

    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

    if ($token == $token_tmp){

        if(isset($_SESSION['carrito']['departamento'][$id])){
           
            $_SESSION['carrito']['departamento'][$id] += 1;

        }else {

            $_SESSION['carrito']['departamento'][$id]= 1;

        }

        $datos['numero'] = count($_SESSION['carrito']['departamento']);
        $datos['ok'] = true; 
        

    }else{
        $datos['ok'] = false;
    
    }

}else{
    $datos['ok'] = false;
}

echo json_encode($datos);

?> 