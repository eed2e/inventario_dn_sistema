<?php include_once "includes/header1.php"; ?>
<div class="content">
	<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<h5>Productos</h5>
				
				<div class="table-responsive">
					<table class="table table-striped table-bordered" id="table">
						<thead class="thead-dark">
							<tr>
								<th>ID</th>
								<th>Imagen</th>
								<th>PRODUCTO</th>
								
								
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