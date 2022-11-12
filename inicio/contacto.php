<?php include("template/cabecerainicio.php");?>
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
    case "Cancelar":
        header("Location:contacto.php");
        break;
}


$sentenciaSQL= $conexion->prepare("SELECT * FROM contacto");
$sentenciaSQL->execute();
$listacontacto=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="col-md-5">

    <div class="card">
        <div class="card-header">
            Datos Departamentos
        </div>
        <div class="card-body">
            <form method ="POST" enctype="multipart/form-data" >

                <div class = "form-group">
                <label for="txtNombre">Nombre:</label>
                <input type="text" required class="form-control" value = "<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
                </div>

                <div class = "form-group">
                <label for="txtEmail">Email:</label>
                <input type="text" required class="form-control" value = "<?php echo $txtEmail; ?>" name="txtEmail" id="txtEmail" placeholder="Email">
                </div>

                <div class = "form-group">
                <label for="txtAsunto">Asunto:</label>
                <input type="text" required class="form-control" value = "<?php echo $txtAsunto; ?>" name="txtAsunto" id="txtAsunto" placeholder="Asunto">
                </div>

                <div class = "form-group">
                <label for="txtMensaje">Mensaje:</label>
                <input type="text" required class="form-control" value = "<?php echo $txtMensaje; ?>" name="txtMensaje" id="txtMensaje" placeholder="Mensaje">
                </div>              
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value = "Agregar"  class="btn btn-success">Enviar</button>
                    
                </div>
            </form>   
        </div>
    </div>
</div>
<br><br><br><br>



<?php include("template/pieinicio.php");?>