<?php

    include 'conexion_be.php';

    $nombre_completo = $_POST['nombre_completo'];
    $correo = $_POST['correo'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    #$password = hash('sha512', $password);

    if (strlen($nombre_completo)==0 || strlen($correo)==0 || strlen($username)==0 || strlen($password)==0){
        echo '
            <script>
                alert("Debes completar todos los campos para registrarte");
                window.location = "../index.php";
            </script>
        ';
    }
    
    $query = ("INSERT INTO clientes(nombre_completo, correo, username, password)
                VALUES ('$nombre_completo', '$correo', '$username', '$password')");

    $query2 = ("INSERT INTO usuarios VALUES ('', '$username', '$password', '3')");



    $verificar_correo = mysqli_query($conexion, "SELECT * FROM clientes WHERE correo='$correo'");

    if(mysqli_num_rows($verificar_correo) > 0){
        echo '
            <script>
                alert("Este correo ya esta registrado, intenta con otro diferente");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }

    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM clientes WHERE username='$username'");

    if(mysqli_num_rows($verificar_usuario) > 0){
        echo '
            <script>
                alert("Este usuario ya esta registrado, intenta con otro diferente");
                window.location = "../index.php";
            </script>
        ';
        exit();
    }

    
    $ejecutar = mysqli_query($conexion, $query);
    $ejecutar2 = mysqli_query($conexion, $query2);

    if ($ejecutar && $ejecutar2){
        echo '
            <script>
                alert("Usuario almacenado exitosamente");
                window.location = "../index.php";
            </script>
        ';
    }else{
        echo '
            <script>
                alert("Intentalo de nuevo, usuario no almacenado");
                window.location = "../index.php";
            </script>
        ';
    }
    

    mysqli_close($conexion);
?>