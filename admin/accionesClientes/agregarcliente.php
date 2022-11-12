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

    case "Agregar":

        $sentenciaSQL= $conexion->prepare("INSERT INTO clientes (nombre_completo, correo, username, password) VALUES (:nombre_completo, :correo, :username, :password);");
        $sentenciaSQL->bindParam(':txtnombre_completo',$txtnombre_completo);
        $sentenciaSQL->bindParam(':correo',$txtcorreo);
        $sentenciaSQL->bindParam(':username',$txtusername);
        $sentenciaSQL->bindParam(':password',$txtpassword);
        
        $sentenciaSQL->execute();

        //header("Location:agregardepto.php");
        header("Location:admin/accionesClientes/agregarcliente.php");
        break;


}

$sentenciaSQL= $conexion->prepare("SELECT * FROM clientes");
$sentenciaSQL->execute();
$listaclientes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>
<br>
<div class="col-md-4">
    <br><br><br><br>
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
                    <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value = "Agregar"  class="btn btn-success">Agregar</button>
                    
                </div>
            </form>
       
        
     
        </div>
        
    </div>





    
    
    
</div>
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


               
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>




<?php include("../template/pie.php");?>