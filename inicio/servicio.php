<?php include("template/cabecerainicio.php");?>

<?php include("../secciones/config/bdsitio.php");?>


<table>
    <tr>
        <td>servicio_id</td>
        <td>nombre</td>
        <td>descripcion</td>
        <td>precio</td>
    </tr>
    <?php 

        $sql= "SELECT * FROM servicios";
        $result=mysqli_query($conexion,$sql);

        while($mostrar= mysqli_fetch_array($result)){
    
    ?>
    <tr>
        <td><?php echo $mostrar ['servicio_id']?></td>
        <td><?php echo $mostrar ['nombre']?></td>
        <td><?php echo $mostrar ['descripcion']?></td>
        <td><?php echo $mostrar ['precio']?></td>

    </tr>
    <?php
        }
    ?>
</table>

















<?php include("template/pieinicio.php");?>




