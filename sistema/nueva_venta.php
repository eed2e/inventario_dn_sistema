<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
               <!-- <a href="#" class="btn btn-primary btn_new_cliente"><i class="fas fa-user-plus"></i> Tecnico</a>-->
                <a href="ventas.php" class="btn btn-danger">Pedidos hechos</a>
            </div>
            <div class="card">
                <div class="card-body">
                        <input type="hidden" name="action" value="addCliente">
                        <input type="hidden" id="idcliente" value="1" name="idcliente" required>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <form action= "agregar_pedido.php" method="post">
                                        <label>Nombre del Tecnico</label>
                                            <select class="form-control" id="cliente_n" name="cliente_n">
                                            <?php
                                                    include "../conexion.php";
						    $sqlri= mysqli_query($conexion, "SELECT * FROM peticion");
				                    $datta= mysqli_num_rows($sqlri);  

                                                    $query = mysqli_query($conexion, "SELECT * FROM cliente");
                                                    $result = mysqli_num_rows($query);  
                                                    if ($result > 0) {
                                                        while ($data = mysqli_fetch_assoc($query)) { ?>
                                                        <option><?php echo $data['nombre']; ?></option>
                                                                <?php } 
                                                            }
                                                    ?>
                                                </select>
                                 <?php if ($_SESSION['rol'] != 2 && $datta>0) { ?>
			                        		<button class="btn btn-primary " type="submit" >REALIZAR PEDIDO </button>
                                            <?php } ?> 
                                    </form>                                
                                    <!--<input type="number" name="dni_cliente" id="dni_cliente" class="form-control">-->
                                </div>

                            </div>
                            
                        </div>
                        <h4 class="text-center">Datos del Pedido</h4>

                        <table class="table table-striped table-bordered" id="tt">
						<thead class="thead-dark">
							<tr>
								<th>ID</th>
								<th>Imagen</th>
								<th>PRODUCTO</th>
								
								<th>PETICION</th>
								<?php if ($_SESSION['rol'] != 2) { ?>
									<th>ACCIONES</th>
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php
							include "../conexion.php";

							$query = mysqli_query($conexion, "SELECT * FROM peticion");
							$result = mysqli_num_rows($query);
							
		                    
							if ($result > 0) {
								while ($data = mysqli_fetch_assoc($query)) { ?>
									
                                    <tr>
										<td><?php echo $data['codproducto']; ?></td>
                                        <td><img width="130px" height="110px" src =" <?php echo $data['imagen'] ?> "></td>
										<td><?php echo $data['descripcion']; ?></td>

										
										<td><?php echo $data['cantidad']; ?></td>
										<?php if ($_SESSION['rol'] != 2) { ?>
											<td>
                                            
										<a href = "eliminar_peticion.php? id=<?php echo $data['id_p']; ?>  &  cod=<?php echo $data['codproducto']; ?>"><i class="fas fa-trash-alt"></i></a>

												
											</td>
										<?php } ?>
									</tr>
                                    <?php }
							} ?>
						</tbody>
                        </table>  
                    
                </div>
            </div>
                
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
				<h5>Productos</h5>

				<div class="table-responsive">
					<table class="table table-striped table-bordered" id="table">
						<thead class="thead-dark">
							<tr>
								<th>ID</th>
								<th>Imagen</th>
								<th>PRODUCTO</th>
								
								<th>STOCK</th>
								<th>PETICION</th>

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
                                        <form action="agregar_peticion.php?id=<?php echo $data['codproducto']; ?>" method="post" >

                                        <td><input ip = 'peticion' name = 'peticion' style = "border-radius: 15px;"></input></td>
										<?php if ($_SESSION['rol'] != 2) { ?>
											<td>
                                                    <input type="submit" value="Agregar" class="btn btn-success">
                                                    
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
<script>
function alerta(){
    for($actuall >= 2){
        windows.alert('Poco stock');
    }
}
</script>

<?php include_once "includes/footer.php"; ?>