<?php
	session_start();
	$iduser = $_SESSION['idUser'];
	if(empty($_SESSION['active']))
	{
		header('location: ../');
	}
	include "../../conexion.php";
	if(empty($_REQUEST['cl']) || empty($_REQUEST['f']))
	{
		echo "No es posible generar la factura.";
	}else{
		$codCliente = $_REQUEST['cl'];
		$noFactura = $_REQUEST['f'];
		
		$accion = "Se mando a imprimir la factura no. ".$noFactura;
	    $query_log = mysqli_query($conexion,"INSERT INTO `log`(`idcliente`, `idusuario`, `accion`) VALUES ($codCliente, $iduser, '$accion')");
		
		$consulta = mysqli_query($conexion, "SELECT * FROM configuracion");
		$resultado = mysqli_fetch_assoc($consulta);
		$ventas = mysqli_query($conexion, "SELECT * FROM factura WHERE nofactura = $noFactura");
		$result_venta = mysqli_fetch_assoc($ventas);
		$clientes = mysqli_query($conexion, "SELECT * FROM cliente WHERE idcliente = $codCliente");
		$result_cliente = mysqli_fetch_assoc($clientes);
		$productos = mysqli_query($conexion, "SELECT d.nofactura, d.codproducto, d.cantidad, p.codproducto, p.descripcion, p.precio FROM detallefactura d INNER JOIN producto p ON d.nofactura = $noFactura WHERE d.codproducto = p.codproducto");
		require_once 'fpdf/fpdf.php';
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetMargins(8, 0, 0);
		$pdf->SetTitle("Pedido");
        $pdf->SetFont('Arial', 'B', 13);
		$pdf->Cell(35, 8, " ", 0, 0, '');
		$pdf->Ln();
		$pdf->image("img/logo_ok.jpg", 70, 1, 65, 28, 'JPG');
		//$pdf->SetFont('Arial', 'B', 8);
		//$pdf->Cell(15, 5, "Ruc: ", 0, 0, 'L');
		//$pdf->SetFont('Arial', '', 8);
		//$pdf->Cell(20, 5, $resultado['dni'], 0, 1, 'L');
		//$pdf->SetFont('Arial', 'B', 8);
		//$pdf->Cell(15, 5, utf8_decode("Teléfono: "), 0, 0, 'L');
		//$pdf->SetFont('Arial', '', 8);
		//$pdf->Cell(20, 5, $resultado['telefono'], 0, 1, 'L');
		//$pdf->SetFont('Arial', 'B', 8);
		//$pdf->Cell(15, 5, utf8_decode("Dirección: "), 0, 0, 'L');
		//$pdf->SetFont('Arial', '', 8);
		//$pdf->Cell(20, 5, utf8_decode($resultado['direccion']), 0, 1, 'L');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
        $pdf->SetFont('Arial', 'B', 13);
		$pdf->Cell(35, 8, "Ticket: ", 0, 0, '');
		$pdf->SetFont('Arial', 'B', 13);
		$pdf->Cell(65, 8, "Fecha: ", 0, 0, '');
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(35, 8, "Nombre:", 0, 1, '');
		$pdf->SetFont('Arial', '', 12);
		$pdf->Cell(15, 8, $noFactura, 0, 0, 'C');
		$pdf->SetFont('Arial', '', '');
		$pdf->Cell(55, 8, $result_venta['fecha'], 0, 0, 'R');
		$pdf->SetFont('Arial', '', 12);
		$pdf->Cell(115, 8, utf8_decode($result_cliente['nombre']), 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(105, 20, "Detalles del Pedido", 0, 1, 'R');

        $pdf->SetTextColor(0, 0, 0);

		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(5, 5, 'ID', 0, 0, 'R');
		$pdf->Cell(160, 5, 'Nombre', 0, 0, 'C');
		$pdf->Cell(26, 5, 'Cantidad', 0, 1, 'R');
        $pdf->SetFont('Arial', '', 10);
        
		while ($row = mysqli_fetch_assoc($productos)) {
		    $pdf->Cell(8, 5,$row['codproducto'], 1, 0, 'L');
            $pdf->Cell(162, 5,utf8_decode($row['descripcion']), 1, 0, 'L');
            $pdf->Cell(23, 5,$row['cantidad'], 1, 1, 'C');
            
		}
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(125, 3, utf8_decode("________________________________"), 0, 1, 'R');
		$pdf->Ln();
		$pdf->Cell(115, 5, 'Nombre y firma del Tecnico', 0, 1, 'R');
		
		$pdf->SetFont('Arial', 'B', 13);
		$pdf->Cell(125, 3, " ", 0, 0, '');
		$pdf->Ln();
		
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(125, 45, utf8_decode("________________________________"), 0,0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(125, 0, " ", 0, 0, '');
		$pdf->Ln();
		$pdf->Cell(120, 60, 'Nombre y firma del Almacenista', 0, 1, 'R');
		
	    	$pdf->Output("compra.pdf", "I");
		}

?>

