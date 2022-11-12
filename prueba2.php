<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <form method= "post" action=""><br>
            ingrese el numero uno: <br>
            <input type= "text" name="numero1"><br>
            ingrese el numero dos : <br>
            <input type= "text" name="numero2"><br>
            <input type="submit" value="sumar"><br>
        </form>

</body>

<?php
$numero1=$_POST['numero1'];
$numero2=$_POST['numero2'];
$suma= $numero1 + $numero2;
     echo "la suma de" .$numero1. " mas " .$numero2. "es igual a:". $suma; 
?>



</html>