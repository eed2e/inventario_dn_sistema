<?php
    session_start();
    require("../conexion.php");
    
    $iduser = $_SESSION['idUser'];
    $id = $_GET['id'];
    $sqli = mysqli_query($conexion, "SELECT * FROM detallefactura WHERE nofactura = $id");
    $result = mysqli_num_rows($sqli);  

    while ($date = mysqli_fetch_assoc($sqli)) {
        $codproducto = $date['codproducto'];
        $cantidad = $date['cantidad'];
        $fecha = $date['fecha_f'];
        $nombre = $date['nombre'];
        $codcliente = $date['codcliente'];
        $stock_antes = $date['stock_antes'];
        $stock_despues = $date['stock_despues'];

        $query_ins = mysqli_query($conexion, "INSERT INTO `historico`(`nofactura`, `codproducto`, `cantidad`, `fechas`, `nombre_c`, `id_tecnico`, `stock_antes`, `stock_despues`) 
        VALUES  ('$id','$codproducto','$cantidad','$fecha','$nombre','$codcliente','$stock_antes','$stock_despues')");
      
        


    }
    $accion = "Se entrego el pedido con la factura no.  ".$id;
	$query_log = mysqli_query($conexion,"INSERT INTO `log`(`idcliente`, `idusuario`, `accion`) VALUES ($codcliente, $iduser, '$accion')");
	
   $query_eliminar = mysqli_query($conexion, "DELETE FROM detallefactura WHERE nofactura = $id");
   $query_eliminarf = mysqli_query($conexion, "DELETE FROM factura WHERE nofactura = $id");


    mysqli_close($conexion);
   header("location: ventas.php");

?>