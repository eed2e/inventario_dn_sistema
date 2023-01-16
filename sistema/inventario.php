<?php
     include_once "includes/header.php"; 
     include "../conexion.php";
                                 
                                $sacarnumero = mysqli_query($conexion, "SELECT MAX(codproducto) AS codproducto FROM producto");
                                $no = mysqli_fetch_assoc($sacarnumero);  
                                $num  = $no['codproducto'];
                                
                                $r=rand(1,$num);
                                $r1=rand(1,$num);  
     ?>
    <div class="content">
        <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                        <h5>INVENTARIO</h5>
                        
                    

						
                    
                    <div class="table-responsive">

                        <table class="table table-striped table-bordered" id="table">
                            <thead class="thead-dark">
                            <tr>
								<th>ID</th>
								<th>Imagen</th>
								<th>PRODUCTO</th>
								<th>STOCK</th>
								<th>EXISTENCIA</th>
							</tr>
                            </thead>
                            <tbody>
                                <?php
                                include "../conexion.php";
                                
                                
                                
                                $sqlpp = mysqli_query($conexion, "SELECT * FROM producto WHERE codproducto = $r");
                                $sqlpp1 = mysqli_query($conexion, "SELECT * FROM producto WHERE codproducto = $r1");

                                $result = mysqli_num_rows($sqlpp);  
                                $result1 = mysqli_num_rows($sqlpp1);  
                                if ($result > 0) {
                                    $data = mysqli_fetch_assoc($sqlpp);  
                                    $data1 = mysqli_fetch_assoc($sqlpp1);  ?>
                                    <form action="realizar_inventarios.php?id=<?php echo $data['codproducto']; ?>&&id1=<?php echo $data1['codproducto']; ?>" method="post" >
                                    <tr>   
                                        <td><?php echo $data['codproducto']; ?></td>
                                        <td><img  width="130px" height="110px" src =" <?php echo $data['imagen'] ?> "></td>
                                        <td><?php echo $data['descripcion']; ?></td>
                                        <td><?php echo $data['existencia']; ?></td>
                                        <td><input ip = 'peticion' name = 'peticion' style = "border-radius: 15px;"></input></td>   
									</tr>
                                    <tr>    
                                        <td><?php echo $data1['codproducto']; ?></td>
                                        <td><img  width="130px" height="110px" src =" <?php echo $data1['imagen'] ?> "></td>
                                        <td><?php echo $data1['descripcion']; ?></td>
                                        <td><?php echo $data1['existencia']; ?></td>
                                        <td><input ip = 'peticion1' name = 'peticion1' style = "border-radius: 15px;"></input></td>        
                                    </tr>
                                    <button title ='Completado la carga' class="btn btn-success" type="submit">completo </button>
                                    </form>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>            
                </div>
                
            </div>
    </div>
    