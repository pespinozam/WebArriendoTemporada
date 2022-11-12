<?php include("../template/cabecera.php");?>

<?php 

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtEmail=(isset($_POST['txtEmail']))?$_POST['txtEmail']:"";
$txtAsunto=(isset($_POST['txtAsunto']))?$_POST['txtAsunto']:"";
$txtMensaje=(isset($_POST['txtMensaje']))?$_POST['txtMensaje']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";



include("../admin/config/bdContacto.php");

switch($accion){
    case "Agregar":

        $sentenciaSQL= $conexion->prepare("INSERT INTO contacto (nombre,email,asunto,mensaje) VALUES (:nombre,:email,:asunto,:mensaje);");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':email',$txtEmail);
        $sentenciaSQL->bindParam(':asunto',$txtAsunto);
        $sentenciaSQL->bindParam(':mensaje',$txtMensaje);

        $sentenciaSQL->execute();

        header("Location:contacto.php");
        break;
}

$sentenciaSQL= $conexion->prepare("SELECT * FROM departamentos");
$sentenciaSQL->execute();
$listadepartamentos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>
<br>
<div class="col-md-4">
    <br><br><br><br>
    <div class="card">
        <div class="card-header">
            Datos Departamentos
        </div>
        <div class="card-body">
            <form method ="POST" enctype="multipart/form-data" >
                <div class = "form-group">
                <label for="txtID">ID:</label>
                <input type="text" required readonly class="form-control" value = "<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
                </div>

                <div class = "form-group">
                <label for="txtNombre">Nombre:</label>
                <input type="text" required class="form-control" value = "<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
                </div>

                <div class = "form-group">
                <label for="txtPrecio">Precio:</label>
                <input type="text" required class="form-control" value = "<?php echo $txtPrecio; ?>" name="txtPrecio" id="txtPrecio" placeholder="Precio">
                </div>

                <div class = "form-group">
                <label for="txtImagen">Imagen:</label>
                <br>
                <?php if($txtImagen!=""){  ?>

                    <img class="img-thumbnail rounded" src="../../img/<?php echo $txtImagen; ?>" width="50" alt="">
                    
                <?php } ?> 
                

                <input type="file"  class="form-control" name="txtImagen" id="txtImagen" placeholder="Imagen">
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
                <th>Habitaciones</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Estrellas</th>
                <th>Imagen</th>
                
                
            </tr>
        </thead>
        <tbody>
        <?php foreach($listadepartamentos as $departamentos){?>
            <tr>
                <td><?php echo $departamentos['id']; ?></td>
                <td><?php echo $departamentos['nombre']; ?></td>
                <td><?php echo $departamentos['habitaciones']; ?></td>
                <td><?php echo $departamentos['descripción']; ?></td>
                <th><?php echo $departamentos['precio']; ?></th>
                <td><?php echo $departamentos['estrellas']; ?></td>
                <td>  

                <img class="img-thumbnail rounded" src="../../inicio/asset/img/<?php echo $departamentos['imagen']; ?>" width="50" alt="">  

                </td>

               
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>




<?php include("../template/pie.php");?>