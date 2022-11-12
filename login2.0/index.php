
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>TURISMO REAL</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />

        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="assets/js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
        <link rel="stylesheet" href="assets/css/estilos.css">
    </head>
    <body>
        <!-- Background Video-->
        <video class="bg-video" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop"><source src="assets/mp4/bg.mp4" type="video/mp4" /></video>
        <!-- Masthead-->
        <div class="masthead">
            
            <main>
                    <div class="contenedor__todo">
                        <div class="caja__trasera">
                            <div class="caja__trasera-login">
                                <h3>¿Ya tienes una cuenta?</h3>
                                <p>Inicia sesión para entrar en la página</p>
                                <button class="btn btn-info" id="btn__iniciar-sesion">Iniciar Sesión</button>
                                <button class="btn "><a href="../inicio.php">Inicio</a></button>
                            </div>
                            
                            <div class="caja__trasera-register">
                                <h3>¿Aún no tienes una cuenta?</h3>
                                <p>Regístrate para que puedas iniciar sesión</p>
                                <button class="btn btn-info" id="btn__registrarse"><a >Registrate</a></button>
                                <button class="btn "><a href="../inicio/inicio.php">Inicio</a></button>
                            </div>
                        </div>
                        <!--Formulario de Login y registro-->
                        <div class="contenedor__login-register">
                            <!--Login-->
                            <form action="registro/valida_login.php" class="formulario__login" method="POST">
                                <h2>Iniciar Sesión</h2>
                                <br/><input type="text" name="username"  placeholder="Usuario"><br/>
                                <br/><input type="password" name="password" placeholder="Contraseña"><br/>
                                <button type="submit" value="Iniciar sesión" name="btnIngresar">Iniciar Sesion</button> 
                            </form>
                            <!--Register-->
                            <form action="registro/registro_usuario_be.php"  method="POST" class="formulario__register">
                                <h2>Regístrarse</h2>
                                <input type="text" placeholder="Nombre completo" name="nombre_completo">
                                <input type="text" placeholder="Correo Electronico" name="correo">
                                <input type="text" placeholder="Usuario" name="username">
                                <input type="password" placeholder="Contraseña" name="password">
                                <button>Regístrarse</button>
                            </form>
                        </div>

                    </div>

                    </main>
                    <script src="assets/js/scripts.js"></script>
       
        </div>
        <!-- Social Icons-->
        <!-- For more icon options, visit https://fontawesome.com/icons?d=gallery&p=2&s=brands-->
        <div class="social-icons">
            <div class="d-flex flex-row flex-lg-column justify-content-center align-items-center h-100 mt-3 mt-lg-0">
                <a class="btn btn-dark m-3" href="#!"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-dark m-3" href="#!"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-dark m-3" href="#!"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="assets/js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
