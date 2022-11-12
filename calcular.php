<?php
  $producto = $_POST['producto'];
  $precio = $_POST['precio'];
  $cantidad = $_POST['cantidad'];
 ?>
<!DOCTYPE html>
 <html lang="en">
   <head>
     <meta charset="UTF-8">
    <title>Boleta</title>
     <link rel="stylesheet" href="estilos.css">
   </head>
   <body>
     <h1>Total a pagar: </h1>
    <p>Producto: <?php echo $producto;?></p>
     <p>Precio:<?php echo $precio;?></p>
    <p>Cantidad: <?php echo $cantidad;?></p>


    <?php  
      if($producto="Arroz")
      {
          echo "el precio es de" ;
      }
    ?> 

   </body>
</html>
