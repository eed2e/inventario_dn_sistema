<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="content">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<a href="nueva_venta.php" class="btn btn-danger">Nuevo pedido</a>
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
							<th>ID Tecnico</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						require "../conexion.php";
						$query = mysqli_query($conexion, "SELECT f.nofactura, f.fecha, f.codcliente, f.estado, c.idcliente, c.dni, c.nombre, f.auto FROM factura f INNER JOIN cliente c  ON f.codcliente =c.idcliente");
						mysqli_close($conexion);
						$cli = mysqli_num_rows($query);

						if ($cli > 0) {
							while ($dato = mysqli_fetch_array($query)) {
								if($dato['auto']==0){
						?>
								<tr>
									<td><?php echo $dato['nofactura']; ?></td>
									<td><?php echo $dato['fecha']; ?></td>
									<td><?php echo $dato['nombre']; ?></td>
									<td><?php echo $dato['codcliente']; ?></td>
									<td>
										<button type="button" class="btn btn-primary view_factura" cl="<?php echo $dato['codcliente'];  ?>" f="<?php echo $dato['nofactura']; ?>">Ver</button>
										<a href="historico.php?id=<?php echo $dato['nofactura']; ?>" class="btn btn-success"><i class="fas fa-check"></i></a>
                                        <form action="eliminar_pedido.php?id=<?php echo $dato['nofactura']; ?>" method="post" class="confirmar d-inline">
                                            <?php
										    if ($_SESSION['rol'] == 3) {?>
													<button title ='Eliminar pedido' class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
													<?php
										    }
										  ?>
										</form>
									</td>
								</tr>
						<?php }}
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>



</div>


<?php include_once "includes/footer.php"; ?>