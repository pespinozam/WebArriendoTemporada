<?php

session_start();

if(!empty($_POST["btnIngresar"])){
    if (!empty($_POST["username"]) and !empty($_POST["password"])) {

        $usuario=$_POST["username"];
        $contra=$_POST["password"];

        $conexion = mysqli_connect("localhost","root", "", "sitio");
        $conexion->set_charset("utf8");

        $sql=$conexion->query(" select * from usuarios where user='$usuario' and pass='$contra'");

        if ($datos=$sql->fetch_object()) {
            $_SESSION["id"]=$datos->id;
            $_SESSION["usuario"]=$datos->user;
            if($datos->rol_id==1){
                header("location:../../admin/index.php");                
            }
            elseif($datos->rol_id==2){
                header("location:../../cliente/index.php");   
            }
            elseif($datos->rol_id==3){
                header("location:../../inicio/inicio.php");   
            }
            elseif($datos->rol_id==4){

                header("location:../../cliente/index.php");   
            }
        } else {
            echo ' 
                <script>
                    alert("Usuario no existe, por favor vuelta a intentar!");
                    window.location = "../index.php";
                </script>';
                }
        
    } else {
        echo ' 
                <script>
                    alert("Campos Vacios, por favor vuelta a intentar!");
                    window.location = "../index.php";
                </script>';
    }
    
}
?>