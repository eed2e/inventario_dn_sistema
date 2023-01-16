<?php
if (!empty($_GET['id'])) {
    require("../conexion.php");
    $id = $_GET['id'];



    $query_update = mysqli_query($conexion, "UPDATE factura SET auto=0 WHERE nofactura =$id");
    mysqli_close($conexion);
   



    header("location: pendiente.php");
}
?>