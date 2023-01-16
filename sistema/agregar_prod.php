<?php
session_start();
$iduser = $_SESSION['idUser'];
if (!empty($_GET['id'])) {
    require("../conexion.php");
    $id = $_GET['id'];
    $new = $_POST['no'];
    $sql= mysqli_query($conexion, "SELECT * FROM producto WHERE codproducto = $id");
    $data = mysqli_fetch_assoc($sql);

    $cantidad= $data['existencia'];
    $nombre= $data['descripcion'];

    $suma = $cantidad + $new;
    $sqli= mysqli_query($conexion, "UPDATE producto SET existencia = $suma  WHERE codproducto = $id" );
    $date = mysqli_fetch_assoc($sqli);
    
    $accion = "Se Agregaron ".$new." ".$nombre ;
	$query_log = mysqli_query($conexion,"INSERT INTO `log`(`idcliente`, `idusuario`, `accion`) VALUES (3233, $iduser, '$accion')");
    
    
    mysqli_close($conexion);
   
    
    header("location: agregar_producto.php?id=$id");
}
?>