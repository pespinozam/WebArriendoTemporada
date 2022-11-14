<?php include("template/cabecerainicio.php");?>


<section id="hero" class="d-flex align-items-center">
  <div class="container position-relative" data-aos="fade-up" data-aos-delay="500">
      <h1>Bienvenido</h1>
      <h2>En Arriendo Temporada encontraras lo que deseas, con vistas hermosas y precios accesibles</h2>
      <a href="#departamento" class="btn-get-started scrollto">Ver más....</a>
    </div>
</section>
<div class="container">
  <div class="row">
<?php 
require '../bda.php';


include("../admin/config/bdsitio.php");
$sentenciaSQL= $conexion->prepare("SELECT * FROM departamentos");
$sentenciaSQL->execute();
$listadepartamentos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);



?>


<div id="departamento" class="section-title">
          <span>Departamentos</span>
          <h2>Departamentos</h2>
          <p>Todo lo que deseas lo encontraras</p>
</div>
<?php foreach($listadepartamentos as $departamento){  ?>
    <div class="col-md-3">
        <div class="card">
            <img class="card-img-top img-thumbnail rounded mx-auto d-block" style="max-with: 204px; max-height: 250px; min-with: 204px; min-height: 250px;" src="../img/<?php echo $departamento['imagen']?>" alt="">
            <div class="card-body">
                <h4 class="card-title"><?php echo $departamento['nombre']?></h4>
                <p><?php echo $departamento['precio']?></p>
                <a href="detalle.php?id=<?php echo $departamento['id'];?>&token=<?php echo hash_hmac('sha1',$departamento['id'],KEY_TOKEN);?>" class="btn btn-primary" >Mas Informacion</a>
           </div>
        </div>
    </div>
<?php } ?>

<section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <span>Services</span>
          <h2>Services</h2>
          <p>Sit sint consectetur velit quisquam cupiditate impedit suscipit alias</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
            <div class="icon-box">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4><a href="">transporte desde/hacia el departamento</a></h4>
              <p>se le envía un documento de  coordinación del servicio 48h antes de su llegada, con la información de lugar, horario, vehículo y conductor  que estará a cargo del servicio. Igualmente, un día antes del check out, el cliente recibe un informativo similar. </p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="150">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4><a href="">tours</a></h4>
              <p>Si el cliente ha contratado tours, a su llegada recibirá la información de coordinación del servicio, pudiendo  también contratarlo durante su estadía</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4><a href="">Entrega de Llaves</a></h4>
              <p>Al retirarse, el departamento es recepcionado por un funcionario de la empresa, quien verifica el estado del  departamento, posibles multas por uso inadecuado, etc.</p>
            </div>
          </div>

          

        </div>

      </div>
</section><!-- End Services Section -->

<section id="team" class="team">
      <div class="container">

        <div class="section-title">
          <span>Team</span>
          <h2>Team</h2>
          <p>Sit sint consectetur velit quisquam cupiditate impedit suscipit alias</p>
        </div>

        <div class="row">
          <div class="col-lg-3 col-md-3 d-flex align-items-stretch" data-aos="zoom-in">
            <div class="member">
              <img src="../login2.0/assets/img/team/boris.png" alt="">
              <h4>Boris Reyes</h4>
              <span>Jefe de Desarrollo</span>
              <p>
              Desarrollador Pagina Web
              </p>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-3 d-flex align-items-stretch" data-aos="zoom-in">
            <div class="member">
              <img src="../login2.0/assets/img/team/jose2.png" alt="">
              <h4>Jose Manriquez</h4>
              <span>General Management</span>
              <p>
              Desarrollador de Aplicacion Android
              </p>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-3 d-flex align-items-stretch" data-aos="zoom-in">
            <div class="member">
              <img src="../login2.0/assets/img/team/carlos2.png" alt="">
              <h4>Carlos Baeza</h4>
              <span>Product Owner</span>
              <p>
                Encargado de reuniones y puntos de vista respectivo del cliente
              </p>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-3 d-flex align-items-stretch" data-aos="zoom-in">
            <div class="member">
              <img src="../login2.0/assets/img/team/Luiz.png" alt="">
              <h4>Luis Zurita</h4>
              <span></span>
              <p>
                Encargado de la realizacion del proceso de Informes y Busqueda de informacion
              </p>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

      </div>
</section><!-- End Team Section -->



    <!-- ======= Contact Section ======= -->




<?php 
$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtEmail=(isset($_POST['txtEmail']))?$_POST['txtEmail']:"";
$txtAsunto=(isset($_POST['txtAsunto']))?$_POST['txtAsunto']:"";
$txtMensaje=(isset($_POST['txtMensaje']))?$_POST['txtMensaje']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";



include("../admin/config//bdsitio.php");

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
<section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <span>Contactanos</span>
          <h2>Contactanos</h2>
          <p>Si tienes dudas puedes enviarnos un mensaje explicando que pasa y te lo resolveremos.</p>
        </div>

        <div class="row" data-aos="fade-up">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <i class="bx bx-map"></i>
              <h3>Nuestra Ubicacion</h3>
              <p>Cam. El Alba 12881, Las Condes, Región Metropolitana</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-envelope"></i>
              <h3>Email</h3>
              <p>info@duocuc.cl</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-phone-call"></i>
              <h3>Puedes Llamar a nuestra oficinas</h3>
              <p>+56 9 6252 5998</p>
            </div>
          </div>

        </div>

        <div class="row" data-aos="fade-up">

          <div class="col-lg-6 ">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3330.87900218887!2d-70.50779964867301!3d-33.40032080223426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9662cc15795f8555%3A0x78594ceeb4b0b1b5!2sDuoc%20UC!5e0!3m2!1ses-419!2scl!4v1666323660859!5m2!1ses-419!2scl" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>

          
</section><!-- End Contact Section -->

<?php include("template/pieinicio.php");?>