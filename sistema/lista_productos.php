<?php include_once "includes/header.php"; ?>
<div class="content">
	<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<h5>Productos</h5>
				<?php if ($_SESSION['rol'] != 2) { ?>
				<a href="registro_producto.php" class="btn btn-warning">Nuevo</a>
				<?php } ?>
				<div class="table-responsive">
					<table class="table table-striped table-bordered" id="table">
						<thead class="thead-dark">
							<tr>
								<th>ID</th>
								<th>Imagen</th>
								<th>PRODUCTO</th>
								
								<th>STOCK</th>
								<?php if ($_SESSION['rol'] != 2) { ?>
									<th>ACCIONES</th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php
							include "../conexion.php";

							$query = mysqli_query($conexion, "SELECT * FROM producto");
							$result = mysqli_num_rows($query);
							if ($result > 0) {
								while ($data = mysqli_fetch_assoc($query)) { ?>
									<tr>
										<td><?php echo $data['codproducto']; ?></td>
                                        <td><img width="130px" height="110px" src =" <?php echo $data['imagen'] ?> "></td>
										<td><?php echo $data['descripcion']; ?></td>
										
										<td><?php echo $data['existencia']; ?></td>
										<?php if ($_SESSION['rol'] != 2) { ?>
											<td>
												<a title = 'Agregar😮' href="agregar_producto.php?id=<?php echo $data['codproducto']; ?>" class="btn btn-primary"><i class="fas fa-plus"></i></a>
												<a title ='Cambiar Stock🙄' href="editar_stock.php?id=<?php echo $data['codproducto']; ?>" class="btn btn-info"><i class="fa fa-minus" aria-hidden="true"></i></a>
												<a title ='Editar registro 🤪' href="editar_producto.php?id=<?php echo $data['codproducto']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>

												<form action="eliminar_producto.php?id=<?php echo $data['codproducto']; ?>" method="post" class="confirmar d-inline">
													<button title ='Eliminar Producto 😪' class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
												</form>
												
											</td>
										<?php } ?>
									</tr>
							<?php }
							} ?>
						</tbody>

					</table>
				</div>

			</div>
		</div>
</div>
<?php include_once "includes/footer.php"; ?>