<?php include("template/cabecerainicio.php");?>

<?php

require '../bda.php';
$id = isset($_GET['id']) ? $_GET['id']:'';
$token = isset($_GET['token']) ? $_GET['token']:'';

if($id == '' || $token == ''){
    echo 'Error al procesar peticion';
    exit;
} else {

    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

    if ($token == $token_tmp) {
    } else{
        echo 'Error al procesar la petición';
        exit;
    }}

include("../admin/config/bdDepartamento.php");

    if (!isset($_GET['id'])) {
      header ("Location:inicio.php");
    }

    $id=$_GET['id'];
    $sentencia=$conexion->prepare("SELECT * FROM departamentos WHERE id=?; ");
    $sentencia->execute([$id]);
    $departamentoResultado= $sentencia->fetch(PDO::FETCH_OBJ);


?>

<main>
  <div class="container">
    <div class="row">
      
      <div class="col-md-6 order-md-1">
      <img src="../img/<?php echo $departamentoResultado->imagen; ?>" alt="">
      </div>

      <div class="col-md-6 order-md-2">
        <div class="portfolio-info">
          <h3><?php echo $departamentoResultado->nombre; ?></h3>
            <ul>
              <li><strong>Habitaciones: </strong><?php echo $departamentoResultado->habitaciones; ?></li>
              <li><strong>Categoria: </strong><?php echo $departamentoResultado->estrellas; ?> Estrellas</li>
              <li><strong>Valor por noche:</strong> <?php echo MONEDA . number_format($departamentoResultado->precio,3,'.','.'); ?></li>
            </ul>
          </div>

          <h2>Departamento de lujo!</h2>
          <p><?php echo $departamentoResultado->descripcion; ?></p>
          <br><br><br><br><br><br><br><br><br><br>
        <div class="d-grid gap-3 col-12 mx-auto"">
          <a href="../paypal2/index.php"><button class = "btn btn-primary" type="button" href="">Arrendar Ahora</button></a>
          <button class = "btn btn-outline-primary" type="button" onclick="addProducto (<?php echo $id;?>, '<?php  echo $token_tmp; ?>')">Guardar</button>
        </div>


      </div>
    </div>
  </div>
</main>



<?php include("template/pieinicio.php");?>
