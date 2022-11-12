<?php
session_start();
require 'config/bd.php';
require 'config/config.php';

$json = file_get_contents('php://input');
$datos =  json_decode($json, true);

$usuario=$_SESSION["usuario"];
$sentencia=$conexion->prepare("SELECT * FROM clientes WHERE nombre_completo=?; ");
$sentencia->execute([$usuario]);
$usuarioComprando= $sentencia->fetch(PDO::FETCH_OBJ);

$servicios_sel_arrendar=$_SESSION["servicios_arrendados"];
$fechaDesde=$_SESSION["fecha_desde"];
$fechaHasta=$_SESSION["fecha_hasta"];

$emailComprador=$usuarioComprando->correo;
$idComprador=$usuarioComprando->id;

if(is_array($datos)){
    $id_transaccion = $datos ['detalles']['id'];
    $monto = $datos['detalles']['purchase_units'][0]['amount']['value'];
    $status = $datos['detalles']['status'];
    $fecha = $datos['detalles']['update_time'];
    $fecha_nueva = date('Y-m-d H:i:s',strtotime($fecha));

    $sql = $conexion->prepare("INSERT INTO compra (id_transaccion,fecha,status,email,id_cliente,total) VALUES (?,?,?,?,?,?)");
    $sql->execute([$id_transaccion,$fecha_nueva,$status,$emailComprador,$idComprador,$monto]);
    $id = $conexion->lastInsertId();

    if (count($servicios_sel_arrendar)>0) {
        foreach ($servicios_sel_arrendar as $servextra) {


            $sentencia=$conexion->prepare("SELECT * FROM serviciose WHERE ID=?; ");
            $sentencia->execute([$servextra]);
            $servicioExtra= $sentencia->fetch(PDO::FETCH_OBJ);   
            $nombreServicioSeleccionado=$servicioExtra->nombre;

            $id_departamento_arrendado=$datos['detalles']['purchase_units'][0]['reference_id'];
            $sql2 = $conexion->prepare("INSERT INTO detalle_compra (id,id_departamento, servicios_extra, nombre_usuario, total, id_compra, fechaInicio, fechaHasta) VALUES (?,?,?,?,?,?,?,?)");
            $sql2->execute(['',$id_departamento_arrendado, $nombreServicioSeleccionado, $usuario, $monto, $id, $fechaDesde, $fechaHasta]);
        
        }
    }else{

        $id_departamento_arrendado=$datos['detalles']['purchase_units'][0]['reference_id'];
        $sql2 = $conexion->prepare("INSERT INTO detalle_compra (id,id_departamento, servicios_extra, nombre_usuario, total, id_compra, fechaInicio, fechaHasta) VALUES (?,?,?,?,?,?,?,?)");
        $sql2->execute(['',$id_departamento_arrendado, 'Sin servicio Extra', $usuario, $monto, $id, $fechaDesde, $fechaHasta]);

    }

    $sql2 = $conexion->prepare("INSERT INTO historial (id_registro,id_compra, fecha_compra, total_pago, usuario, tipo_compra) VALUES (?,?,?,?,?,?)");
    $sql2->execute(['',$id, $fecha_nueva, $monto, $usuario, '1']);

}       
?>