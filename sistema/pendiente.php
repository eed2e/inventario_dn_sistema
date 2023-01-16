<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            
                
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Administrador </label>
                        <p style="font-size: 16px; text-transform: uppercase; color: blue;"><?php echo $_SESSION['nombre']; ?></p>
                    </div>
                </div>
               
            </div>
            <div class="row">
			<div class="col-lg-12">
				<h5>Productos por autorizar</h5>

				<div class="table-responsive">
					<table class="table table-striped table-bordered" id="table">
						<thead class="thead-dark">
							<tr>
								<th>NOMBRE DEL TECNICO</th>
								

								<?php if ($_SESSION['rol'] != 2) { ?>
									<th>ACCIONES</th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
                        <?php
                                include "../conexion.php";
                                
                                
                                
                                $sqlpp = mysqli_query($conexion, "SELECT * FROM factura f  INNER JOIN cliente c  ON f.codcliente = c.idcliente ");

                                $result = mysqli_num_rows($sqlpp);  
                                  
                                if ($result > 0) {
                                    while ($dato = mysqli_fetch_array($sqlpp)) {
                                        if($dato['auto']==1){
                                ?>
                                        <tr>
                                            <td><?php echo $dato['nombre']; ?></td>
                                            
                                            <td>
                                                
                                                <a href="muestra.php?id=<?php echo $dato['nofactura']; ?>" class="btn btn-success">VER<i class="fas fa-check"></i></a>
                                                
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