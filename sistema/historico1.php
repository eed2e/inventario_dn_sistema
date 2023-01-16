<?php
    require("../conexion.php");

    $id = $_GET['id'];


    $sqli = mysqli_query($conexion, "SELECT * FROM detallefactura WHERE nofactura = $id");

    $result = mysqli_num_rows($sqli);  


    while ($date = mysqli_fetch_assoc($sqli)) {
        $codproducto = $date['codproducto'];
        $cantidad = $date['cantidad'];
        $fecha = $date['fecha_f'];
        $nombre = $date['nombre'];
        $codcliente = $date['codcliente'];

        $query_ins = mysqli_query($conexion, "INSERT INTO historico(nofactura,codproducto,cantidad,fechas,nombre_c,id_tecnico) VALUES ('$id','$codproducto','$cantidad','$fecha','$nombre','$codcliente')");
var_dump($query_ins);
        

    }

   $query_eliminar = mysqli_query($conexion, "DELETE FROM detallefactura WHERE nofactura = $id");
   $query_eliminarf = mysqli_query($conexion, "DELETE FROM factura WHERE nofactura = $id");

    mysqli_close($conexion);
   header("location: almacen.php");

?>