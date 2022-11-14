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
  

include("../admin/config/bdsitio.php");

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
          <h3><?php echo $departamentoResultado->nombre; ?></h3><input type="text" class="d-none" value="<?php echo $departamentoResultado->nombre; ?>" id="nombreProddepartamento<?php echo $departamentoResultado->id; ?>">
            <ul>
              <li><strong>Habitaciones: </strong><?php echo $departamentoResultado->habitaciones; ?></li>
              <li><strong>Categoria: </strong><?php echo $departamentoResultado->estrellas; ?> Estrellas</li>
              <li><strong>Valor por noche:</strong> <?php echo MONEDA . number_format($departamentoResultado->precio,3,'.','.'); ?>
                  <input type="text" class="d-none" value="<?php echo $departamentoResultado->precio; ?>" id="precioProddepartamento<?php echo $departamentoResultado->id; ?>">
                  <input type="text" class="d-none" value="reserva" id="origenProddepartamento<?php echo $departamentoResultado->id; ?>">
                  <input type="text" class="d-none" value="1" id="cantidadProddepartamento<?php echo $departamentoResultado->id; ?>">
                  <input type="text" class="d-none" value="<?php echo $departamentoResultado->id; ?>" id="idProddepartamento<?php echo $departamentoResultado->id; ?>">
                  <input type="text" class="" value="<?php echo $departamentoResultado->id; ?>" id="prodepartamento<?php echo $departamentoResultado->id; ?>">
              </li>
            </ul>
          </div>

          <h2>Departamento de lujo!</h2>
          <p><?php echo $departamentoResultado->descripcion; ?></p>
          <br><br><br><br><br><br><br><br><br><br>
        <div class="d-grid gap-3 col-12 mx-auto">
          <a href="../paypal2/index.php"><button class = "btn btn-primary" type="button" href="">Arrendar Ahora</button></a>
          <button class = "btn btn-outline-primary" type="button" onclick="addProductoLS('departamento', '<?php echo $departamentoResultado->id; ?>');">Añadir al Carro</button>
        </div>


      </div>
    </div>

    <div class="row mt-5">
      <div class="col-12 col-md-6">
          <h1>TOUR A LA MIERDA</h1><input type="text" class="" value="TOUR A LA MIERDA" id="nombreProdtour1">
      </div>
      <div class="col-12 col-md-6">
          <h4>PRECIO:</h4><input type="text" class="" value="1" id="precioProdtour1">
      </div>
      <div class="col-12 col-md-6">
        <h4>ID:</h4><input type="text" class="" value="1" id="idProdtour1">
      </div>
      <div class="col-12 col-md-6">
        <h4>Cantidad:</h4><input type="text" class="" value="1" id="cantidadProdtour1">
        <input type="text" class="" value="tour" id="origenProdtour1">
      </div>
      <div class="col-12 col-md-6">
        <button class = "btn btn-outline-primary" type="button" onclick="addProductoLS('tour','1');">Añadir al Carro</button>
      </div>
    </div>
  </div>
</main>



<?php include("template/pieinicio.php");?>
