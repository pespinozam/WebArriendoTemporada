<?php include("../template/cabecera.php");?>
<?php 

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";



include("../config/bd.php");

switch($accion){

        case "Agregar":

            $sentenciaSQL= $conexion->prepare("INSERT INTO departamentos (nombre, precio, imagen) VALUES (:nombre,:precio,:imagen);");
            $sentenciaSQL->bindParam(':nombre',$txtNombre);
            $sentenciaSQL->bindParam(':precio',$txtPrecio);

            $fecha= new DateTime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
            
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

            if($tmpImagen!=""){

                    move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
            }

            $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
            $sentenciaSQL->execute();

            header("Location:departamentos.php");
            break;

        case "Modificar":
            $sentenciaSQL= $conexion->prepare("UPDATE departamentos SET nombre=:nombre WHERE id=:id");
            $sentenciaSQL->bindParam(':nombre',$txtNombre); 
            $sentenciaSQL->bindParam(':id',$txtID);           
            $sentenciaSQL->execute();
            
            $sentenciaSQL= $conexion->prepare("UPDATE departamentos SET precio=:precio WHERE id=:id");
            $sentenciaSQL->bindParam(':precio',$txtPrecio); 
            $sentenciaSQL->bindParam(':id',$txtID);           
            $sentenciaSQL->execute();

            if($txtImagen!=""){

                $fecha= new DateTime();
                $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";     
                $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

                move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
                $sentenciaSQL= $conexion->prepare("SELECT imagen FROM departamentos WHERE id=:id");
                $sentenciaSQL->bindParam(':id',$txtID);           
                $sentenciaSQL->execute();
                $departamento=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
    
                if( isset($departamento["imagen"]) &&($departamento["imagen"]!="imagen.jpg") ){
    
                    if(file_exists("../../img/".$departamento["imagen"])){
    
                        unlink("../../img/".$departamento["imagen"]);
                    
                    }   
                }

                $sentenciaSQL= $conexion->prepare("UPDATE departamentos SET imagen=:imagen WHERE id=:id");
                $sentenciaSQL->bindParam(':imagen',$nombreArchivo);           
                $sentenciaSQL->bindParam(':id',$txtID); 
                $sentenciaSQL->execute();
            }
            header("Location:departamentos.php");
            break;
            
        case "Cancelar":
            header("Location:departamentos.php");
            break;

        case "Seleccionar":
            $sentenciaSQL= $conexion->prepare("SELECT * FROM departamentos WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);           
            $sentenciaSQL->execute();
            $departamento=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            
            $txtNombre=$departamento['nombre'];
            $txtPrecio=$departamento['precio'];
            $txtImagen=$departamento['imagen'];

            //echo "Presionado botón Seleccionar";
            break;
        
        case "Borrar":
            $sentenciaSQL= $conexion->prepare("SELECT imagen FROM departamentos WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);           
            $sentenciaSQL->execute();
            $departamento=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            if( isset($departamento["imagen"]) &&($departamento["imagen"]!="imagen.jpg") ){

                if(file_exists("../../img/".$departamento["imagen"])){

                    unlink("../../img/".$departamento["imagen"]);
                
                }   
            }




            $sentenciaSQL= $conexion->prepare("DELETE FROM departamentos WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
           
            header("Location:departamentos.php");
            break;
       
}

$sentenciaSQL= $conexion->prepare("SELECT * FROM departamentos");
$sentenciaSQL->execute();
$listadepartamentos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="col-md-5">

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
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($listadepartamentos as $departamentos){?>
            <tr>
                <td><?php echo $departamentos['id']; ?></td>
                <td><?php echo $departamentos['nombre']; ?></td>
                <th><?php echo $departamentos['precio']; ?></th>
                <td>  

                <img class="img-thumbnail rounded" src="../../img/<?php echo $departamentos['imagen']; ?>" width="50" alt="">  

                </td>

                <td>   

                    <form  method="post">
                        <input type="hidden" name="txtID" id="txtID" value = "<?php echo $departamentos['id']; ?>" />
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