<?php
    $username = $_POST['username'];
    $password = $_POST['password'];

    session_start();
    $_SESSION['username']=$username;
    include 'conexion_be.php';

    $consulta = "SELECT rol_id FROM usuarios WHERE user='$username' and pass='$password'";
    $resultado = mysqli_query($conexion, $consulta);

    $filas = mysqli_num_rows($resultado);
    if($resultado==1){
        header("location:../BienvenidaAdmin.php");
    }
    elseif($resultado==3){
        
        header("location:../../inicio.php");
    }
    else {
        echo '
            <script>
                alert("Usuario no existe, por favor verifique los datos introducidos");
                window.location = "../login.php";
            </script>';
        exit;

        session_destroy();
    }
?>