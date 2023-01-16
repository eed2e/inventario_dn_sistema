<?php
session_start();
include_once "includes/header.php";
include "../conexion.php";
$iduser = $_SESSION['idUser'];
$id_cliente = '3233';
$id = $_GET['id'];
$query_producto = mysqli_query($conexion, "SELECT codproducto, descripcion, existencia FROM producto  WHERE codproducto = $id");
$data_producto = mysqli_fetch_assoc($query_producto);
$nombre = $data_producto['descripcion'];

if (!empty($_POST)) {
  $alert = "";
  
      if (empty($_POST['nstock']) ) {
      $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
  } else {
       
        $stockn = $_POST['nstock'];
        $stock = $_POST['stock'];
          
          if($destino==""){
               $query_update = mysqli_query($conexion, "UPDATE producto SET existencia = '$stockn' WHERE codproducto = $id");
               $accion = "Se cambio el stock de ".$stock." a la cantidad de ".$stockn." del producto ".$nombre;
	           $query_log = mysqli_query($conexion,"INSERT INTO `log`(`idcliente`, `idusuario`, `accion`) VALUES ($id_cliente, $iduser, '$accion')");
              if ($query_update) {
                    $alert = '<div class="alert alert-primary" role="alert">
                     Modificado
                    </div>';
                } else {
                    $alert = '<div class="alert alert-primary" role="alert">
                    Error al Modificar
                    </div>';
                }
            }
    }
    header("Location: lista_productos.php");
}

   
    

?>
       }
      
<!-- Begin Page Content -->
<div class="content">

  <div class="row">
    <div class="col-lg-6 m-auto">
      <div class="card">
        <div class="card-header">
          Modificar stock
        </div>
        <div class="card-body">
          <form action="" method="post" >
            <?php echo isset($alert) ? $alert : ''; ?>
            <div class="form-group">
              <label for="producto">stock actual</label>
              <input type="text" class="form-control" placeholder="Ingrese nombre del producto" name="stock" id="stock" value="<?php echo $data_producto['existencia']; ?>">

            </div><div class="form-group">
              <label for="producto">cambiar stock</label>
              <input type="text" class="form-control" placeholder="Ingrese nombre del producto" name="nstock" id="nstock" >

            </div>
            
            <input type="submit" value="Actualizar Producto" class="btn btn-outline-primary">
            <a href="lista_productos.php" class="btn btn-outline-danger">Regresar</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End of Main Content -->
<?php include_once "includes/footer.php"; ?>