<?php include("template/cabecera.php");?>
<?php 

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";



include("config/bdsitio.php");

switch($accion){
      
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
           
            //header("Location:deptoborrar.php");
            break;
       
}

$sentenciaSQL= $conexion->prepare("SELECT * FROM departamentos");
$sentenciaSQL->execute();
$listadepartamentos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>

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
                        <input type="submit" name = accion value="Borrar" class="btn btn-danger"/>
                    </form>
            
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>


<?php include("template/pie.php");?>