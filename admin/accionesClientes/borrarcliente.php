<?php 

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtEmail=(isset($_POST['txtEmail']))?$_POST['txtEmail']:"";
$txtUsuario=(isset($_POST['txtUsuario']))?$_POST['txtUsuario']:"";
$txtContraseña=(isset($_POST['txtContraseña']))?$_POST['txtContraseña']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";



include("../config/bd2.php");

switch($accion){
    case "Borrar":
        
        $sentenciaSQL= $conexion->prepare("DELETE FROM clientes WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $clientes=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
       
        header("Location:admin/accionesClientes/borrarcliente.php");
        break;
   
}

$sentenciaSQL= $conexion->prepare("SELECT * FROM clientes");
$sentenciaSQL->execute();
$listaclientes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="col-md-6">
    <br><br><br><br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Usuario</th>
                <th>Contraseña</th>
               
                
                
            </tr>
        </thead>
        <tbody>
        <?php foreach($listaclientes as $clientes){?>
            <tr>
                <td><?php echo $clientes['id']; ?></td>
                <td><?php echo $clientes['nombre_completo']; ?></td>
                <td><?php echo $clientes['correo']; ?></td>
                <td><?php echo $clientes['username']; ?></td>
                <th><?php echo $clientes['password']; ?></th>

                <td>   

                    <form  method="post">
                        <input type="hidden" name="txtID" id="txtID" value = "<?php echo $clientes['id']; ?>" />
                        <input type="submit" name = accion value="Borrar" class="btn btn-danger"/>
                    </form>
            
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
