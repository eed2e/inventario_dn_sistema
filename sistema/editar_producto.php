<?php
session_start();

include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
      if (empty($_POST['producto']) ) {
      $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
  } else {
        $iduser = $_SESSION['idUser'];
     
           
        $tips = 'jpg';
        $type = array ('image/jpg' => 'jpg');
        $id = $_POST['producto'];
        $minimo = $_POST['stock'];
        $id = preg_replace('([^A-Za-z0-9])', '', $id);
        
        $nombrefoto1 = $_FILES['image']['name'];
        $ruta1 = $_FILES['image']['tmp_name'];
        $name = $id.'.'.$tips;
           
        if(is_uploaded_file($ruta1)){
            $destino = "imagenes_inv/".$name;
            copy($ruta1,$destino);
        }
        $codproducto = $_GET['id'];
        $producto = $_POST['producto'];
          
          if($destino==""){
               $query_update = mysqli_query($conexion, "UPDATE producto SET descripcion = '$producto', stockm = '$minimo' WHERE codproducto = $codproducto");
              if ($query_update) {
                  $alert = '<div class="alert alert-primary" role="alert">
                     Modificado
                    </div>';
    } else {
      $alert = '<div class="alert alert-primary" role="alert">
                Error al Modificar
              </div>';
    }
          }else{
          
          
    $query_update = mysqli_query($conexion, "UPDATE producto SET descripcion = '$producto', stockm = '$minimo', imagen = '$destino' WHERE codproducto = $codproducto");
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
        $accion = "Se edito el Producto".$producto;
	    $query_log = mysqli_query($conexion,"INSERT INTO `log`(`idcliente`, `idusuario`, `accion`) VALUES (3233, $iduser, '$accion')"); 
  }
}

// Validar producto

if (empty($_REQUEST['id'])) {
  header("Location: lista_productos.php");
} else {
  $id_producto = $_REQUEST['id'];
  if (!is_numeric($id_producto)) {
    header("Location: lista_productos.php");
  }
  $query_producto = mysqli_query($conexion, "SELECT p.codproducto, p.descripcion,p.imagen,p.stockm FROM producto p WHERE p.codproducto = $id_producto");
  $result_producto = mysqli_num_rows($query_producto);

  if ($result_producto > 0) {
    $data_producto = mysqli_fetch_assoc($query_producto);
  } else {
    header("Location: lista_productos.php");
  }
}
?>
       }
      
<!-- Begin Page Content -->
<div class="content">

  <div class="row">
    <div class="col-lg-6 m-auto">
      <div class="card">
        <div class="card-header">
          Modificar producto
        </div>
        <div class="card-body">
          <form action="" method="post" enctype="multipart/form-data">
            <?php echo isset($alert) ? $alert : ''; ?>
            <td><img width="130px" height="110px" src =" <?php echo  $data_producto['imagen'] ?> "></td>
            <input type="file" name="image" id="image">
            <div class="form-group">
              <label for="producto">Producto</label>
              <input type="text" class="form-control" placeholder="Ingrese nombre del producto" name="producto" id="producto" value="<?php echo $data_producto['descripcion']; ?>">

            </div>
            <div class="form-group">
              <label for="producto">Stock minimo</label>
              <input type="text" class="form-control" placeholder="Ingrese nombre del producto" name="stock" id="stock" value="<?php echo $data_producto['stockm']; ?>">

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