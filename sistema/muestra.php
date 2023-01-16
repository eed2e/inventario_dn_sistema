<?php include_once "includes/header.php"; 
$fac=$_GET['id'];
?>

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
            <h5>Productos por autorizar</h5>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <a href="autorizar.php?id=<?php echo $fac ?>" class="btn btn-success">AUTORIZAR<i class="fas fa-check"></i></a></tab> </tab> <a href="rechazar.php?id=<?php echo $fac ?>" class="btn btn-danger">RECHAZAR        </tab><i class="fas fa-times"></i></a>
        </div>
        <div class="col">
            
        </div>
    </div>

    <div class="row">

        <div class="col-lg-12">    
            <div class="row">
            

			<div class="col-lg-12">
				
                
                <div class="col-lg-6">
                
                </div>

				<div class="table-responsive">
					<table class="table table-striped table-bordered" id="table">
						<thead class="thead-dark">
							<tr>
								<th>NOMBRE DEL PRODUCTO </th>
								<th>CANTIDAD</th>
								
							</tr>
						</thead>
						<tbody>
                        <?php
                                include "../conexion.php";
                                
                                
                                
                                $sqlpp = mysqli_query($conexion, "SELECT * FROM detallefactura WHERE nofactura=$fac");
                                
                               
                                $result = mysqli_num_rows($sqlpp);  
                                  
                                if ($result > 0) {
                                    while ($dato = mysqli_fetch_array($sqlpp)) {
                                       
                                ?>
                                        <tr>
                                            <td><?php echo $dato['nom_producto']; ?></td>

                                            <td> <?php echo $dato['cantidad']; ?></td>
                                            
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