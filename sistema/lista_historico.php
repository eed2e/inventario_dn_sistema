<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="content">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h5>Historico</h5>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table">
					<thead class="thead-dark">
						<tr>
							<th>Id</th>
							<th>Fecha</th>
							<th>Nombre del Tecnico</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Stock antes del pedido</th>
							<th>Stock despues del pedido</th>
							
						</tr>
					</thead>
					<tbody>
						<?php
						require "../conexion.php";
						$query = mysqli_query($conexion, "SELECT h.nofactura, h.cantidad, h.fechas, h.nombre_c, h.id_tecnico, h.stock_antes, h.stock_despues,  p.codproducto, p.descripcion FROM historico AS h 
						INNER JOIN producto AS p  ON h.codproducto =p.codproducto ORDER BY  h.nofactura DESC ");
						$cli = mysqli_num_rows($query);
                        
						if ($cli > 0) {
							while ($dato = mysqli_fetch_array($query) ) {
						?>
						
								<tr>
									<td><?php echo $dato['nofactura']; ?></td>
									<td><?php echo $dato['fechas']; ?></td>
									<td><?php echo $dato['nombre_c']; ?></td>
									<td><?php echo $dato['descripcion']; ?></td>
									<td><?php echo $dato['cantidad']; ?></td>
									<td><?php echo $dato['stock_antes']; ?></td>
									<td><?php echo $dato['stock_despues']; ?></td>
									<!--<td>
										<button type="button" class="btn btn-primary view_factura" cl="<?php echo $dato['id_tecnico'];  ?>" f="<?php echo $dato['nofactura']; ?>">Ver</button>
									</td>-->
									
								</tr>
						<?php }
						}mysqli_close($conexion); ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>



</div>


<?php include_once "includes/footer.php"; ?>