<?php include("../template/cabecera.php");?>

<?php 

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtdescripcion=(isset($_POST['txtdescripcion']))?$_POST['txtdescripcion']:"";
$txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";



include("../config/bdsitio.php");

switch($accion){
    case "Agregar":

        $sentenciaSQL = $conexion ->prepare("INSERT INTO servicios(nombre,descripcion,precio) VALUES (:nombre,:descripcion,:precio);");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':descripcion',$txtdescripcion);
        $sentenciaSQL->bindParam(':precio',$txtPrecio);
        $sentenciaSQL->execute();

    case "Modificar":


        $sentenciaSQL= $conexion->prepare("UPDATE servicios SET nombre=:nombre WHERE id=:id");
        $sentenciaSQL->bindParam(':nombre',$txtNombre); 
        $sentenciaSQL->bindParam(':id',$txtID);           
        $sentenciaSQL->execute();

        $sentenciaSQL= $conexion->prepare("UPDATE servicios SET descripcion=:descripcion WHERE id=:id");
        $sentenciaSQL->bindParam(':descripcion',$txtdescripcion); 
        $sentenciaSQL->bindParam(':id',$txtID);           
        $sentenciaSQL->execute();
            
        $sentenciaSQL= $conexion->prepare("UPDATE servicios SET precio=:precio WHERE id=:id");
        $sentenciaSQL->bindParam(':precio',$txtPrecio); 
        $sentenciaSQL->bindParam(':id',$txtID);           
        $sentenciaSQL->execute();

        header("Location:servicios.php");
        break;

    case "Cancelar":
        header("Location:servicios.php");
        break;
            
    case "Seleccionar":
        $sentenciaSQL= $conexion->prepare("SELECT * FROM servicios WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);           
        $sentenciaSQL->execute();
        $servicios=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
                
        $txtNombre=$servicios['nombre'];
        $txtdescripcion = $servicios['descripcion'];
        $txtPrecio=$servicios['precio'];
    
    
        //echo "Presionado botón Seleccionar";
        break;


    case "Borrar":

        $sentenciaSQL= $conexion->prepare("DELETE FROM servicios WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
           
        header("Location:servicios.php");
        break;

}

$sentenciaSQL= $conexion->prepare("SELECT * FROM servicios");
$sentenciaSQL->execute();
$listaservicios=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>



<div class="col-md-5">

    <div class="card">
        <div class="card-header">
            Datos Servicios Extras
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
                <label for="txtdescripcion">descripcion:</label>
                <input type="text" required class="form-control" value = "<?php echo $txtdescripcion; ?>" name="txtdescripcion" id="txtdescripcion" placeholder="descripcion">
                </div>


                <div class = "form-group">
                <label for="txtPrecio">Precio:</label>
                <input type="text" required class="form-control" value = "<?php echo $txtPrecio; ?>" name="txtPrecio" id="txtPrecio" placeholder="Precio">
                </div>

               


                
                
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value = "Agregar"  class="btn btn-success">Agregar</button>
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
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Acciones</th>
                
                
            </tr>
        </thead>
        <tbody>
        <?php foreach($listaservicios as $servicios){?>
            <tr>
                <td><?php echo $servicios['id']; ?></td>
                <td><?php echo $servicios['nombre']; ?></td>
                <td><?php echo $servicios['descripcion']; ?></td>
                <th><?php echo $servicios['precio']; ?></th>
        

                    
                <td>

            
                    <form  method="post">

                        <input type="hidden" name="txtID" id="txtID" value = "<?php echo $servicios['id']; ?>" />



                        <input type="submit" name = accion value="Seleccionar" class="btn btn-primary"/>
                        <input type="submit" name = accion value="Borrar" class="btn btn-danger"/>

                    </form>
            
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php include("../template/pie.php");?>




