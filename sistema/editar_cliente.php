<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['nombre']) ) {
    $alert = '<p class"error">Todo los campos son requeridos</p>';
  } else {
    $idcliente = $_POST['id'];
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];

    $result = 0;
    if (is_numeric($dni) and $dni != 0) {

      $query = mysqli_query($conexion, "SELECT * FROM cliente where (dni = '$dni' AND idcliente != $idcliente)");
      $result = mysqli_fetch_array($query);
      $resul = mysqli_num_rows($query);
    }

    if ($resul >= 1) {
      $alert = '<p class"error">El dni ya existe</p>';
    } else {
      if ($dni == '') {
        $dni = 0;
      }
      $sql_update = mysqli_query($conexion, "UPDATE cliente SET dni = $dni, nombre = '$nombre'  WHERE idcliente = $idcliente");

      if ($sql_update) {
        $alert = '<p class"exito">Tecnico Actualizado correctamente</p>';
      } else {
        $alert = '<p class"error">Error al Actualizar el Tecnico</p>';
      }
    }
  }
}
// Mostrar Datos

if (empty($_REQUEST['id'])) {
  header("Location: lista_cliente.php");
}
$idcliente = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM cliente WHERE idcliente = $idcliente");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_cliente.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $idcliente = $data['idcliente'];
    $dni = $data['dni'];
    $nombre = $data['nombre'];
  }
}
?>
<!-- Begin Page Content -->
<div class="content">

  <div class="row">
    <div class="col-lg-6 m-auto">
      <div class="card">
        <div class="card-header">
          Modificar Tecnico
        </div>
        <div class="card-body">
          <form class="" action="" method="post">
            <?php echo isset($alert) ? $alert : ''; ?>
            <input type="hidden" name="id" value="<?php echo $idcliente; ?>">
            <div class="form-group">
              <label for="dni">Dni</label>
              <input type="number" placeholder="Ingrese dni" name="dni" id="dni" class="form-control" value="<?php echo $dni; ?>">
            </div>
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" placeholder="Ingrese Nombre" name="nombre" class="form-control" id="nombre" value="<?php echo $nombre; ?>">
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Actualizar Tecnico</button>
                    <a href="lista_cliente.php" class="btn btn-primary">Regresar</a>
          </form>
          
        </div>
      </div>
    </div>
  </div>


</div>
<!-- /.container-fluid -->
<?php include_once "includes/footer.php"; ?>