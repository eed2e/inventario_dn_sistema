<?php
session_start();
$iduser = $_SESSION['idUser'];
if (!empty($_GET['id'])) {
    require("../conexion.php");
    $nf = $_GET['id'];

    $sqlii= mysqli_query($conexion, "SELECT * FROM detallefactura WHERE nofactura= $nf");
			  while ($dattaa = mysqli_fetch_assoc($sqlii)) {
			  
				  $mm = $dattaa['cantidad'];
				  $c = $dattaa['codproducto'];
				  $id_instalador = $dattaa['codcliente'];
				  $sqlp= mysqli_query($conexion, "SELECT * FROM producto WHERE codproducto = $c ");
				  $dataprod = mysqli_fetch_assoc($sqlp);
				  $stock = $dataprod['existencia'];
				  $stok = $stock + $mm;
                  $sqliinser = mysqli_query($conexion, "UPDATE producto SET existencia = $stok WHERE codproducto = $c");

				  $sqleliminar = mysqli_query($conexion, "DELETE FROM detallefactura WHERE nofactura= $nf");

                }
                $accion = "Se Cancelo el pedido con factura no. ".$nf;
	            $query_log = mysqli_query($conexion,"INSERT INTO `log`(`idcliente`, `idusuario`, `accion`) VALUES ($id_instalador, $iduser, '$accion')");
	            
                $sqleliminarfac = mysqli_query($conexion, "DELETE FROM factura WHERE nofactura= $nf");
            }
            
    header("location: ventas.php");
?>