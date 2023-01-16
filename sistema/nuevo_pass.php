<?php
include "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['pass']) || empty($_POST['npass']) || empty($_POST['cnpass'])) {
      $alert = '<div class="alert alert-primary" role="alert">
                    Todo los campos son requeridos
                </div>';
    
  } else {
    $id = $_GET['id'];
    $pass = $_POST['pass'];
    $npass = $_POST['npass'];
    $cnpass = $_POST['cnpass'];

    $sqli= mysqli_query($conexion, "SELECT * FROM usuario WHERE idusuario = $id");
    $x = mysqli_fetch_array($sqli);
    if($pass != $x['clave']){
        $alert = '<p>Contraseña actual incorrecta</p>';
    }elseif($npass != $cnpass){
        $alert = '<p>Las nuevas contraseñas no coinciden</p>';
    }else{

        $sql_update = mysqli_query($conexion, "UPDATE usuario SET clave = '$npass' ");
        $alert = '<p>Contraseña actualizado</p>';


    }



    
  }
}

?>


<!-- Begin Page Content -->
<div class="content">

  <div class="row">
    <div class="col-lg-6 m-auto">
      <div class="card">
        <div class="card-header">
          Modificar usuario
        </div>
        <div class="card-body">
          <form class="" action="" method="post">
            <?php echo isset($alert) ? $alert : ''; ?>
            <input type="hidden" name="id" value="<?php echo $idusuario; ?>">
            <div class="form-group">
              <label for="nombre">Contraseña Actual</label>
              <input type="text" placeholder="Ingrese Contraseña Actual" class="form-control" name="pass" id="pass" >

            </div>
            
            <div class="form-group">
              <label for="usuario">Nueva Contraseña</label>
              <input type="text" placeholder="Ingrese Nueva Contraseña" class="form-control" name="npass" id="npass" >

            </div>  <div class="form-group">
              <label for="usuario">Confirmar Contraseña</label>
              <input type="text" placeholder="Ingrese Confirmar Contraseña" class="form-control" name="cnpass" id="cnpass" >

            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Cambiar</button>
            <a href="lista_usuarios.php" class="btn btn-outline-danger">Regresar</a>
          </form>
        </div>
      </div>
    </div>
  </div>


</div>
<?php include_once "includes/footer.php"; ?>