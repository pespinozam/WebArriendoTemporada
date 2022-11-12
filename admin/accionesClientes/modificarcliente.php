<?php include("../template/cabecera.php");?>

<?php 

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtnombre_completo=(isset($_POST['txtnombre_completo']))?$_POST['txtnombre_completo']:"";
$txtcorreo=(isset($_POST['txtcorreo']))?$_POST['txtcorreo']:"";
$txtusername=(isset($_POST['txtusername']))?$_POST['txtusername']:"";
$txtpassword=(isset($_POST['txtpassword']))?$_POST['txtpassword']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";



include("../config/bd2.php");

switch($accion){

        case "Modificar":
            $sentenciaSQL= $conexion->prepare("UPDATE clientes SET nombre_completo=:nombre_completo WHERE id=:id");
            $sentenciaSQL->bindParam(':nombre_completo',$txtnombre_completo); 
            $sentenciaSQL->bindParam(':id',$txtID);           
            $sentenciaSQL->execute();
            
            $sentenciaSQL= $conexion->prepare("UPDATE clientes SET correo=:correo WHERE id=:id");
            $sentenciaSQL->bindParam(':correo',$txtcorreo); 
            $sentenciaSQL->bindParam(':id',$txtID);           
            $sentenciaSQL->execute();

            $sentenciaSQL= $conexion->prepare("UPDATE clientes SET username=:username WHERE id=:id");
            $sentenciaSQL->bindParam(':username',$txtusername); 
            $sentenciaSQL->bindParam(':id',$txtID);           
            $sentenciaSQL->execute();

            $sentenciaSQL= $conexion->prepare("UPDATE clientes SET password=:password WHERE id=:id");
            $sentenciaSQL->bindParam(':password',$txtpassword); 
            $sentenciaSQL->bindParam(':id',$txtID);           
            $sentenciaSQL->execute();

            
            header("Location:admin/accionesClientes/modificlarclientes.php");
            break;
            
        case "Cancelar":
            header("Location:admin/accionesClientes/modificlarclientes.php");
            break;

        case "Seleccionar":
            $sentenciaSQL= $conexion->prepare("SELECT * FROM clientes WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);           
            $sentenciaSQL->execute();
            $clientes=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            
            $nombre_completo=$clientes['nombre_completo'];
            $txtcorreo=$clientes['correo'];
            $txtusername=$clientes['username'];
            $txtpassword=$clientes['password'];

            //echo "Presionado botón Seleccionar";
           
            break;
       
}

$sentenciaSQL= $conexion->prepare("SELECT * FROM clientes");
$sentenciaSQL->execute();
$listaclientes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="col-md-5">

    <div class="card">
        <div class="card-header">
            Datos Clientes
        </div>
        <div class="card-body">
            <form method ="POST" enctype="multipart/form-data" >
                <div class = "form-group">
                    <label for="txtID">ID:</label>
                    <input type="text" required readonly class="form-control" value = "<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
                    </div>

                    <div class = "form-group">
                    <label for="txtnombre_completo">nombre_completo:</label>
                    <input type="text" required class="form-control" value = "<?php echo $txtnombre_completo; ?>" name="txtnombre_completo" id="txtnombre_completo" placeholder="nombre_completo">
                    </div>

                    <div class = "form-group">
                    <label for="txtcorreo">correo:</label>
                    <input type="text" required class="form-control" value = "<?php echo $txtcorreo; ?>" name="txtcorreo" id="txtcorreo" placeholder="correo">
                    </div>

                    <div class = "form-group">
                    <label for="txtusername">username:</label>
                    <input type="text" required class="form-control" value = "<?php echo $txtusername; ?>" name="txtusername" id="txtusername" placeholder="Usuario">
                    </div>

                    <div class = "form-group">
                    <label for="txtpassword">password:</label>
                    <input type="password" required class="form-control" value = "<?php echo $txtpassword; ?>" name="txtpassword" id="txtpassword" placeholder="Contraseña">
                </div>
                    
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo ($accion!=="Seleccionar")?"disabled":"";?> value = "Modificar"  class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" <?php echo ($accion!=="Seleccionar")?"disabled":"";?> value = "Cancelar"  class="btn btn-info">Cancelar</button>
                </div>
            </form>
       
        
     
        </div>
        
    </div>





    
    
    
</div>
<div class="col-md-7">
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

                <td>   

                    <form  method="post">
                        <input type="hidden" name="txtID" id="txtID" value = "<?php echo $departamentos['id']; ?>" />
                        <input type="submit" name = accion value="Seleccionar" class="btn btn-primary"/>
                        
                    </form>
            
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php include("../template/pie.php");?>
