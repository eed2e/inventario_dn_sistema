<?php
if (!empty($_GET['id'])) {
    require("../conexion.php");
    $nofactura = $_GET['id'];
    $query_delete = mysqli_query($conexion, "DELETE FROM factura WHERE nofactura = $nofactura");
    $data = mysqli_fetch_assoc($query);
    
    mysqli_close($conexion);
   
    
    header("location: ventas.php");
}
?>