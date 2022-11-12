<?php
session_start();
if (isset($_SESSION["user"])) {
  header("location:home.php");
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login Administrator</title>
    <link rel="shortcut icon" href="../hotel.png" type="image/x-icon">

    <link rel="stylesheet" href="css/style.css">


</head>

<body>
    <div id="clouds">
        <div class="cloud x1"></div>
        <!-- Time for multiple clouds to dance around -->
        <div class="cloud x2"></div>
        <div class="cloud x3"></div>
        <div class="cloud x4"></div>
        <div class="cloud x5"></div>
        <div class="cloud x5"></div>
    </div>

    <div class="container">
        <div id="login">
            <form method="post">
                <fieldset class="clearfix">
                    <p><span class="fontawesome-user"></span><input type="text" name="user" placeholder="Usuario"
                            onBlur="if(this.value == '') this.value = 'Username'"
                            onFocus="if(this.value == 'Username') this.value = ''" required></p>

                    <p><span class="fontawesome-lock"></span><input type="password" name="pass" value="Password"
                            onBlur="if(this.value == '') this.value = 'Password'"
                            onFocus="if(this.value == 'Password') this.value = ''" required></p>
                    <p><input type="submit" name="sub" value="Login"></p>

                </fieldset>
            </form>
        </div> <!-- Login -->
    </div>
    <div class="bottom">
        <marquee behavior="alternate">
            <h3><a href="../index.php" style="background: darkorange;border: darkcyan groove 5px">REGRESAR A LA PAGINA
                    PRINCIPAL</a></h3>
        </marquee>
    </div>
</body>

</html>

<?php
include('db.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // username and password sent from form 

  $myusername = mysqli_real_escape_string($con, $_POST['user']);
  $mypassword = mysqli_real_escape_string($con, $_POST['pass']);

  $sql = "SELECT id FROM login WHERE usname = '$myusername' and pass = '$mypassword'";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  // $active = $row['active']; //Activacion del Mensaje 

  $count = mysqli_num_rows($result);

  // If result matched $myusername and $mypassword, table row must be 1 row

  if ($count == 1) {

    $_SESSION['user'] = $myusername;

    header("location: home.php");
  } else {
    echo '<script>alert("Contraseñ y/o Usuario es Incorrecta") </script>';
  }
}
?>