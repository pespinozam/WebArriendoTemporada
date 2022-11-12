<?php include("../template/cabecera.php");?>
<?php 

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";

$txtUser=(isset($_POST['txtUser']))?$_POST['txtUser']:"";


$txtPass=(isset($_POST['txtPass']))?$_POST['txtPass']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";



include("../config/bdUsuario.php");

switch($accion){

        case "Agregar":
            $sentenciaSQL= $conexion->prepare("INSERT INTO usuarios (user, pass, rol_id) VALUES ( :user,:pass, '1');");
            $sentenciaSQL ->bindParam(':user',$txtUser);
            $sentenciaSQL ->bindParam(':pass',$txtPass);   
            $sentenciaSQL -> execute();
            header("Location:usuarios.php");
            break;

        case "Modificar":


            $sentenciaSQL= $conexion->prepare("UPDATE usuarios SET user=:user WHERE id=:id");
            $sentenciaSQL->bindParam(':user',$txtUser); 
            $sentenciaSQL->bindParam(':id',$txtID);           
            $sentenciaSQL->execute();

            $sentenciaSQL= $conexion->prepare("UPDATE usuarios SET pass=:pass WHERE id=:id");
            $sentenciaSQL->bindParam(':pass',$txtPass); 
            $sentenciaSQL->bindParam(':id',$txtID);           
            $sentenciaSQL->execute();


            header("Location:usuarios.php");
            break;
            
        case "Cancelar";
            header("Location:usuarios.php");
            break;

        case "Seleccionar":
            $sentenciaSQL= $conexion->prepare("SELECT * FROM usuarios WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);           
            $sentenciaSQL->execute();
            $usuarios=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            $txtUser=$usuarios['user'];
            $txtPass=$usuarios['pass'];
            
            //echo "Presionado botón Seleccionar";
            break;
        
        case "Borrar":
            $sentenciaSQL= $conexion->prepare("DELETE FROM usuarios WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
           
            header("Location:usuarios.php");
            break;
       
}

$sentenciaSQL= $conexion->prepare("SELECT * FROM usuarios");
$sentenciaSQL->execute();
$ListaUsuarios=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);



?>

<div class="col-md-5">

    <div class="card">
        <div class="card-header">
            Datos Usuarios
        </div>
        <div class="card-body">
            <form method ="POST" enctype="multipart/form-data" >
                <div class = "form-group">
                <label for="txtID">ID:</label>
                <input type="text" required readonly class="form-control"value = "<?php echo $txtID; ?>"  name="txtID" id="txtID" placeholder="ID">
                
                </div>

                <div class = "form-group">
                <label for="txtUser">user:</label>
                <input type="text" class="form-control" value = "<?php echo $txtUser; ?>" name="txtUser" id="txtUser" placeholder="user">
                </div>

                <div class = "form-group">
                <label for="txtPass">Pass:</label>
                <input type="text" class="form-control" value = "<?php echo $txtPass; ?>" name="txtPass" id="txtPass" placeholder="pass">
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
                <th>user</th>
                <th>pass</th>
                <th>rol_id</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($ListaUsuarios as $usuarios){?>  
            <tr>
                <td><?php echo $usuarios['id']; ?></td>
                <td><?php echo $usuarios['user']; ?></td>
                <th><?php echo $usuarios['pass']; ?></th>
                <th><?php echo $usuarios['rol_id']; ?></th>
                <td>
                <form  method="post">

                    <input type="hidden" name="txtID" id="txtID" value = "<?php echo $usuarios['id']; ?>" />
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