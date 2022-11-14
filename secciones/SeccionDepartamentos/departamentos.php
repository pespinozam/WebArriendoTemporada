<?php include("../template/cabecera.php");?>
<?php 

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";

$txtRegiones=(isset($_POST['txtRegiones']))?$_POST['txtRegiones']:"";

$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";

$txthabitaciones=(isset($_POST['txthabitaciones']))?$_POST['txthabitaciones']:"";
$txtdescripcion=(isset($_POST['txtdescripcion']))?$_POST['txtdescripcion']:"";
$txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";

$txtestrellas=(isset($_POST['txtestrellas']))?$_POST['txtestrellas']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";



include("../config/bdsitio.php");

switch($accion){

        case "Agregar":

            $sentenciaSQL= $conexion->prepare("INSERT INTO departamentos (regiones, nombre,habitaciones,descripcion, precio,estrellas, imagen) VALUES (:regiones,:nombre,:habitaciones,:descripcion,:precio,:estrellas,:imagen);");
            $sentenciaSQL->bindParam(':regiones',$txtRegiones);
            $sentenciaSQL->bindParam(':nombre',$txtNombre);
            $sentenciaSQL->bindParam(':habitaciones',$txthabitaciones);
            $sentenciaSQL->bindParam(':descripcion',$txtdescripcion);
            $sentenciaSQL->bindParam(':precio',$txtPrecio);
            $sentenciaSQL->bindParam(':estrellas',$txtestrellas);

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

            $sentenciaSQL= $conexion->prepare("UPDATE departamentos SET regiones=:regiones WHERE id=:id");
            $sentenciaSQL->bindParam(':regiones',$txtRegiones); 
            $sentenciaSQL->bindParam(':id',$txtID);           
            $sentenciaSQL->execute();

            $sentenciaSQL= $conexion->prepare("UPDATE departamentos SET nombre=:nombre WHERE id=:id");
            $sentenciaSQL->bindParam(':nombre',$txtNombre); 
            $sentenciaSQL->bindParam(':id',$txtID);           
            $sentenciaSQL->execute();

            $sentenciaSQL= $conexion->prepare("UPDATE departamentos SET habitaciones=:habitaciones WHERE id=:id");
            $sentenciaSQL->bindParam(':habitaciones',$txthabitaciones); 
            $sentenciaSQL->bindParam(':id',$txtID);           
            $sentenciaSQL->execute();

            $sentenciaSQL= $conexion->prepare("UPDATE departamentos SET descripcion=:descripcion WHERE id=:id");
            $sentenciaSQL->bindParam(':descripcion',$txtdescripcion); 
            $sentenciaSQL->bindParam(':id',$txtID);           
            $sentenciaSQL->execute();




            
            $sentenciaSQL= $conexion->prepare("UPDATE departamentos SET precio=:precio WHERE id=:id");
            $sentenciaSQL->bindParam(':precio',$txtPrecio); 
            $sentenciaSQL->bindParam(':id',$txtID);           
            $sentenciaSQL->execute();



            $sentenciaSQL= $conexion->prepare("UPDATE departamentos SET estrellas=:estrellas WHERE id=:id");
            $sentenciaSQL->bindParam(':estrellas',$txtestrellas); 
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
            
            $txtRegiones=$departamento['regiones'];
            $txtNombre=$departamento['nombre'];
            $txthabitaciones = $departamento['habitaciones'];
            $txtdescripcion = $departamento['descripcion'];
            $txtPrecio=$departamento['precio'];
            $txtestrellas=$departamento['estrellas'];
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

<div class="col-md-12">

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
                    <label for="txtRegiones">Regiones:</label>
                    <label for="txtRegiones" required  value = "<?php echo $txtRegiones; ?>" name="txtRegiones" id="txtRegiones" placeholder="Regiones"> </label>
                <select name="txtRegiones" id="txtRegiones" class = "form-control">
                    <option value="region1">region1</option>
                    <option value="region2">region2</option>
                    <option value="region3">region3</option>
                    <option value="region4">region4</option>
                    <option value="region5">region5</option> 
                </div>
                </select>


                <div class = "form-group">
                <label for="txtNombre">Nombre:</label>
                <input type="text" required class="form-control" value = "<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
                </div>

                <div name="txthabitaciones" id="txthabitaciones" class="form-group">
                    <label for="txthabitaciones" name="txthabitaciones" id="txthabitaciones" >habitaciones:</label>
                    <label for="txthabitaciones" required  value = "<?php echo $txthabitaciones; ?>" name="txthabitaciones" id="txthabitaciones" placeholder="habitaciones"> </label>
                <select name="txthabitaciones" id="txthabitaciones" class = "form-control">
                    <option name="txthabitaciones" id="txthabitaciones" value="1">1 Habitacion</option>
                    <option name="txthabitaciones" id="txthabitaciones" value="2">2 Habitaciones</option>
                    <option name="txthabitaciones" id="txthabitaciones" value="3">3 Habitaciones</option>
                    <option name="txthabitaciones" id="txthabitaciones" value="4">4 Habitaciones</option>
                    
                </div>
                </select>

                <div class = "form-group">
                <label for="txtdescripcion">descripcion:</label>
                <input type="text" required class="form-control" value = "<?php echo $txtdescripcion; ?>" name="txtdescripcion" id="txtdescripcion" placeholder="descripcion">
                </div>


                <div class = "form-group">
                <label for="txtPrecio">Precio:</label>
                <input type="text" required class="form-control" value = "<?php echo $txtPrecio; ?>" name="txtPrecio" id="txtPrecio" placeholder="Precio">
                </div>

                <div class = "form-group">
                    <label for="txtestrellas">Estrellas:</label>
                    <label for="txtestrellas" required  value = "<?php echo $txtestrellas; ?>" name="txtestrellas" id="txtestrellas" placeholder="Estrellas"> </label>
                <select name="txtestrellas" id="txtestrellas" class = "form-control">
                    <option value="1">1 Estrella</option>
                    <option value="2">2 Estrellas</option>
                    <option value="3">3 Estrellas</option>
                    <option value="4">4 Estrellas</option>
                    <option value="5">5 Estrellas</option> 
                </div>
                </select>


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

<br>
<div class="col-md-12">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Regiones</th>
                <th>Nombre</th>
                <th>Habitaciones</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Estrellas</th>
                <th>Imagen</th>
                <th>Acciones</th>
                
                
            </tr>
        </thead>
        <tbody>
        <?php foreach($listadepartamentos as $departamentos){?>
            <tr>
                <td><?php echo $departamentos['id']; ?></td>
                <td><?php echo $departamentos['regiones']; ?></td>
                <td><?php echo $departamentos['nombre']; ?></td>
                <td><?php echo $departamentos['habitaciones']; ?></td>
                <td><?php echo $departamentos['descripcion']; ?></td>
                <th><?php echo $departamentos['precio']; ?></th>
                <td><?php echo $departamentos['estrellas']; ?></td>
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
<br><br><br>