<?php include("template/cabecera.php");?>
<?php 

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";

$CboHabitaciones=(isset($_POST['CboHabitaciones']))?$_POST['CboHabitaciones']:"";
$txtdescripcion=(isset($_POST['txtdescripcion']))?$_POST['txtdescripcion']:"";
$txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";

$CboEstrellas=(isset($_POST['CboEstrellas']))?$_POST['CboEstrellas']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";



include("config/bdDepartamento.php");

switch($accion){

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
            //header("Location:admin/accionesdepto/modificardepto.php");
            break;
            
        case "Cancelar":
            header("Location:admin/accionesdepto/departamentos.php");
            break;

        case "Seleccionar":
            $sentenciaSQL= $conexion->prepare("SELECT * FROM departamentos WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);           
            $sentenciaSQL->execute();
            $departamento=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            
            $txtNombre=$departamento['nombre'];
            $txthabitaciones=$departamento['habitaciones'];
            $txtdescripcion=$departamento['descripcion'];
            $txtPrecio=$departamento['precio'];
            $txtestrellas=$departamento['estrellas'];
            $txtImagen=$departamento['imagen'];

            //echo "Presionado botón Seleccionar";
            
            break;
       
}

$sentenciaSQL= $conexion->prepare("SELECT * FROM departamentos");
$sentenciaSQL->execute();
$listadepartamentos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="col-md-5">

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
                <label for="txthabitaciones">habitaciones:</label>     
                <label for="CboHabitaciones" required  value = "<?php echo $txthabitaciones; ?>" name="txthabitaciones" id="txthabitaciones" placeholder="habitaciones"> </label>
                <select name="CboHabitaciones">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>   
                </select>
                </div>

                <div class = "form-group">
                <label for="txtdescripcion">descripcion:</label>
                <input type="text" required class="form-control" value = "<?php echo $txtdescripcion; ?>" name="txtdescripcion" id="txtdescripcion" placeholder="descripcion">
                </div>

                <div class = "form-group">
                <label for="txtPrecio">Precio:</label>
                <input type="text" required class="form-control" value = "<?php echo $txtPrecio; ?>" name="txtPrecio" id="txtPrecio" placeholder="Precio">
                </div>


                <div class = "form-group">
                <label for="txtestrellas">estrellas:</label>     
                <label for="CboEstrellas" required  value = "<?php echo $txtestrellas; ?>" name="txtestrellas" id="txtestrellas" placeholder="estrellas"> </label>
                <select name="CboEstrellas">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>     
                </select>
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
                    <button type="submit" name="accion" <?php echo ($accion!=="Seleccionar")?"disabled":"";?> value = "Modificar"  class="btn btn-warning">Modificar</button>
                    <button type="submit" name="accion" <?php echo ($accion!=="Seleccionar")?"disabled":"";?> value = "Cancelar"  class="btn btn-info">Cancelar</button>
                </div>
            </form>
       
        
     
        </div>
        
    </div>





    
    
    
</div>
<div class="col-md-7">
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
                <td><?php echo $departamentos['descripcion']; ?></td>
                <th><?php echo $departamentos['precio']; ?></th>
                <td><?php echo $departamentos['estrellas']; ?></td>
                <td>   

                <img class="img-thumbnail rounded" src="../inicio/asset/img/<?php echo $departamentos['imagen']; ?>" width="50" alt="">  

                </td>

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


<?php include("template/pie.php");?>