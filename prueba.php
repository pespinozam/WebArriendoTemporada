<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <form action="calcular.php" method="post">
      <h1>Calcular pedido</h1>
      <label for="">Producto: </label>
      <select name="producto" id="producto">
        <option value="Arroz">Arroz</option>
        <option value="Leche">Leche</option>
        <option value="Azúcar">Azúcar</option>
        <option value="Yogurt">Yogurt</option>
      </select>
      <label for="">Precio: </label>
      <input type="text" name="precio">
      <label for="">Cantidad: </label>
      <input type="text" name="cantidad">
      <input type="submit" value="Calcular">
    </form>
</body>


   
</body>
</html>