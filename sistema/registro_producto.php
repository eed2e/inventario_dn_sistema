 <?php include_once "includes/header.php";
  include "../conexion.php";
  if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['minimo']) || empty($_POST['producto']) || empty($_POST['cantidad'] || $_POST['cantidad'] <  0)) {
      $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
    } else {
        $tips = 'jpg';
        $type = array ('image/jpg' => 'jpg');
        $id = $_POST['producto'];
        $id = preg_replace('([^A-Za-z0-9])', '', $id);
        
        
        $nombrefoto1 = $_FILES['image']['name'];
        $ruta1 = $_FILES['image']['tmp_name'];
        $name = $id.'A.'.$tips;
        if(is_uploaded_file($ruta1)){
            $destino = "imagenes_inv/".$name;
            copy($ruta1,$destino);
        }
        
      $producto = $_POST['producto'];
      $cantidad = $_POST['cantidad'];
      $usuario_id = $_SESSION['idUser'];
      $stockm =$_POST['minimo'];
      $query_insert = mysqli_query($conexion, "INSERT INTO producto(descripcion,existencia,stockm,usuario_id,imagen) values ( '$producto','$cantidad','$stockm','$usuario_id','$destino')");
    
        if ($query_insert) {
        $alert = '<div class="alert alert-primary" role="alert">
                Producto Registrado
              </div>';
      } else {
        $alert = '<div class="alert alert-danger" role="alert">
                Error al registrar el producto
              </div>';
      }
    }
  }

  ?>
 <!-- Begin Page Content -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/picnic">
 <div class="content">

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Panel de Administración</h1>
     <a href="lista_productos.php" class="btn btn-primary">Regresar</a>
   </div>

   <!-- Content Row -->
   <div class="row">
     <div class="col-lg-6 m-auto">
       <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
         <?php echo isset($alert) ? $alert : ''; ?>
         <div class="form-group">
             
            <div style="width: 200px"> <!-- this div just for demo display -->
                <label class="dropimage miniprofile">
                    <input name="image" title="Drop image or click me" type="file" id="imagen">
                </label>
             </div>
         <div class="form-group">
           <label for="producto">Producto</label>
           <input type="text" placeholder="Ingrese nombre del producto" name="producto" id="producto" class="form-control">
         </div>
         
         <div class="form-group">
           <label for="cantidad">Cantidad</label>
           <input type="number" placeholder="Ingrese cantidad" class="form-control" name="cantidad" id="cantidad">
         </div>
         <div class="form-group">
           <label for="cantidad">Stock Minimo</label>
           <input type="number" placeholder="Ingrese stock minimo" class="form-control" name="minimo" id="minimo">
         </div>
         <input type="submit" value="Guardar Producto" class="btn btn-primary" name="subir" id="subir">
           </div>
       </form>
     </div>
   </div>
 </div>
<script src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
  [].forEach.call(document.querySelectorAll('.dropimage'), function(img){
    img.onchange = function(e){
      var inputfile = this, reader = new FileReader();
      reader.onloadend = function(){
        inputfile.style['background-image'] = 'url('+reader.result+')';
      }
      reader.readAsDataURL(e.target.files[0]);
    }
  });
});
</script>
