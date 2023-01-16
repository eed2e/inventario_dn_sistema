<?php
$alert = '';
session_start();
if (!empty($_SESSION['active'])) {
  header('location: sistema/');
} else {
  if (!empty($_POST)) {
    if (empty($_POST['usuario']) || empty($_POST['clave'])) {
      $alert = '<div class="alert alert-danger" role="alert">
  Ingrese su usuario y su clave
</div>';
    }else {
      require_once "conexion.php";
	$hoy = date("Y-m-d H:i:s");
	$m = date('d', strtotime($hoy));
	$sqlie= mysqli_query($conexion, "SELECT * FROM factura");
	
	
	while ($datte = mysqli_fetch_assoc($sqlie)) {
		  $ff = $datte['fecha'];
		  $nf = $datte['nofactura'];
		  $f = date('d', strtotime($ff));
		  
		  if($m != $f){
			  
			  $sqlii= mysqli_query($conexion, "SELECT * FROM detallefactura WHERE nofactura= $nf");
			  while ($dattaa = mysqli_fetch_assoc($sqlii)) {
			  
				  $mm = $dattaa['cantidad'];
				  $c = $dattaa['codproducto'];
				  $sqlp= mysqli_query($conexion, "SELECT * FROM producto WHERE codproducto = $c ");
				  $dataprod = mysqli_fetch_assoc($sqlp);
				  $stock = $dataprod['existencia'];
				  $stok = $stock + $mm;
				  
				
				  $sqliinser = mysqli_query($conexion, "UPDATE producto SET existencia = $stok WHERE codproducto = $c");

				  
				  $sqleliminar = mysqli_query($conexion, "DELETE FROM detallefactura WHERE nofactura= $nf");
				  
			  }
			  $sqleliminarfac = mysqli_query($conexion, "DELETE FROM factura WHERE nofactura= $nf");
		  }
		  
  }
	    
      
      
      $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
      $clave = mysqli_real_escape_string($conexion, $_POST['clave']);
      /*if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
         $alert = '<div class="alert alert-danger" role="alert">
              capchat incompleto
            </div>';
        session_destroy();
       
        }
        $secretKey = "Put your secret key here";
        $ip = $_SERVER['REMOTE_ADDR'];
        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=6LfWJKMaAAAAAPEF_LMjnHg-s8WzkDLmsOyJqnrP' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        // should return JSON with success as true
        if($responseKeys["success"]) {
                echo '<h2>Thanks for posting comment</h2>';
        } else {
                     $alert = '<div class="alert alert-danger" role="alert"> complete el recaptchat</div>';
        }*/
      $query = mysqli_query($conexion, "SELECT u.idusuario, u.nombre, u.correo,u.usuario,r.idrol,r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE u.usuario = '$user' AND u.clave = '$clave'");
      mysqli_close($conexion);
      $resultado = mysqli_num_rows($query);
      if ($resultado > 0) {
        $dato = mysqli_fetch_array($query);
        $_SESSION['active'] = true;
        $_SESSION['idUser'] = $dato['idusuario'];
        $_SESSION['nombre'] = $dato['nombre'];
        $_SESSION['email'] = $dato['correo'];
        $_SESSION['user'] = $dato['usuario'];
        $_SESSION['rol'] = $dato['idrol'];
        $_SESSION['rol_name'] = $dato['rol'];
        
        header('location: sistema/index.php');
        
      } else {
        $alert = '<div class="alert alert-danger" role="alert">
              Usuario o Contrase単a Incorrecta
            </div>';
        session_destroy();
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head><meta charset="euc-jp">

  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>DigitalNet Inventario</title>

  <!-- Custom fonts for this template-->
  <link href="sistema/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="sistema/css/sb-admin-2.min.css" rel="stylesheet">
  <script src='https://www.google.com/recaptcha/api.js'></script>
  
  <style type="text/css">
  body {
  background-image: url("sistema/img/logo1.jpg");
  
}
</style>
</head>

<body >

  <div class="container">

    
    <div class="row justify-content-center ">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-4 shadow-lg my-5">
        
          <div class="card-body p-0">

            <div class="row">
              <div class="col-lg-6 d-none d-lg-block ">
                  <br>
                  <br>
                  <br><br>
                  <br>
                  <br>
                  <br>
                  <div>
                <img src="sistema/img/logo_ok.jpg" width="800px" height="1000px" class="img-thumbnail center">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Iniciar Sesion</h1>
                  </div>
                  <form class="user" method="POST">
                    <?php echo isset($alert) ? $alert : ""; ?>
                    <div class="form-group">
                      <label for="">Usuario</label>
                      <input type="text" class="form-control" placeholder="Usuario" name="usuario"></div>
                    <div class="form-group">
                      <label for="">Contraseña</label>
                      <input type="password" class="form-control" placeholder="Contraseña" name="clave">
                    </div>
                     <div class="form-group">
                                            <div class="col-md-9"><div class="g-recaptcha" data-sitekey="6LfWJKMaAAAAANgy3mGBQqfkOsqWhsKCEGmIGua9"></div></div>
                                        </div>

						<script type="text/javascript">
					
						         grecaptcha.ready(function() {
						              grecaptcha.execute('reCAPTCHA_site_key', {action: 'homepage'}).then(function(token) {
						              });
						          });
						        function getUrlVars() {
						            var vars = {};
						            var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
						                vars[key] = value;
						            });
						            return vars;
						       			 }
						
						        var error = getUrlVars()["error"];
						        window.onload=function(){
						            if(error=="1"){
						                alert("Nombre y contrase���a incorrectos, por favor vuelva a intentarlo.");
						                return false;
						            } else if(error=="2"){
						                alert("No existe la sesi���n, por favor ingrese nuevamente sus datos.");
						                return false;
						            } else if(error=="3"){
						                alert("Usted no tiene permisos para ingresar a esta secci���n. Por favor, vuelva a ingresar.");
						                return false;
						            } else if(error=="4"){
						                alert("Usted no tiene permisos para ingresar a esta secci���n.");
							                return false;
							            }
						        };
						    </script>
                    <input type="submit" value="Iniciar" class="btn btn-primary">
                    <hr>
                  </form>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="sistema/vendor/jquery/jquery.min.js"></script>
  <script src="sistema/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="sistema/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="sistema/js/sb-admin-2.min.js"></script>

</body>

</html>