<?php
session_start();
require("../conexion.php");
$id = $_POST['cliente_n'];
$iduser = $_SESSION['idUser'];
$x = 1;
$sqll = mysqli_query($conexion, "INSERT INTO mexicanada(no) VALUES ($x)");

$pedirnumero = mysqli_query($conexion, "SELECT MAX(id_gen) AS id_gen FROM mexicanada");
$no = mysqli_fetch_assoc($pedirnumero);
$ff = date("Y-m-d H:i:s");
$nofactura = $no['id_gen'];

$sqli = mysqli_query($conexion, "SELECT * FROM cliente WHERE nombre = '$id'");
$date = mysqli_fetch_assoc($sqli);

$peticion = $date['idcliente'];
$sql = mysqli_query($conexion, "SELECT * FROM peticion");
$result = mysqli_num_rows($sql);
if ($result > 0) {
    $i = 0;
    while ($data = mysqli_fetch_assoc($sql)) {

        $cod = $data['codproducto'];
        $cantidad = $data['cantidad'];
        $nom = $data['descripcion'];
        $stock_antes = $data['stock_antes'];
        $stock_despues = $data['stock_despues'];

        $query_insert = mysqli_query(
            $conexion,
            "INSERT INTO detallefactura(nofactura, codproducto, nom_producto, cantidad,fecha_f, nombre, codcliente, stock_antes, stock_despues) 
            VALUES ('$nofactura', '$cod','$nom', '$cantidad','$ff', '$id', $peticion, $stock_antes, $stock_despues)"
        );
        $accion = "Se manda pedido con la cantidad de ".$cantidad." ".$nom." con la factura no. ".$nofactura;
	    $query_log = mysqli_query($conexion,"INSERT INTO `log`(`idcliente`, `idusuario`, `accion`) VALUES ($peticion, $iduser, '$accion')");

        var_dump($query_insert);
    }
}
$query_ins = mysqli_query($conexion, "INSERT INTO factura(nofactura,fecha,codcliente,auto) VALUES ($nofactura, '$ff', $peticion,$i)");

$query_eliminar = mysqli_query($conexion, "DELETE FROM peticion ");
mysqli_close($conexion);
header("location: nueva_venta.php");
?>