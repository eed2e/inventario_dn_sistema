<?php
include_once "includes/header.php";
include "../conexion.php";
// Validar producto

if (empty($_REQUEST['id'])) {
    header("Location: lista_productos.php");
} else {
    $id_producto = $_REQUEST['id'];
    if (!is_numeric($id_producto)) {
        header("Location: lista_productos.php");
    }
    $query_producto = mysqli_query($conexion, "SELECT codproducto, descripcion, proveedor, existencia FROM producto WHERE codproducto = $id_producto");
    $result_producto = mysqli_num_rows($query_producto);

    if ($result_producto > 0) {
        $data_producto = mysqli_fetch_assoc($query_producto);
    } else {
        header("Location: lista_productos.php");
    }
}
// Agregar Productos a entrada
if (!empty($_POST)) {
    $alert = "";
    if (!empty($_POST['cantidad']) || !empty($_POST['producto_id'])) {
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $producto_id = $_GET['id'];
        $usuario_id = $_SESSION['idUser'];
        $query_insert = mysqli_query($conexion, "INSERT INTO entradas(codproducto,cantidad,usuario_id) VALUES ($producto_id, $cantidad, $usuario_id)");
        if ($query_insert) {
            // ejecutar procedimiento almacenado
            $query_upd = mysqli_query($conexion, "CALL actualizar_precio_producto($cantidad,$producto_id)");
            $result_pro = mysqli_num_rows($query_upd);
            if ($result_pro > 0) {
                $alert = '<div class="alert alert-primary" role="alert">
                        Producto actualizado con exito
                    </div>';
            }else {
          $alert = '<div class="alert alert-primary" role="alert">
                        Producto no actualizado
                    </div>';
                    }
        } else {
            echo "error";
        }
        mysqli_close($conexion);
    } else {
        echo "error";
    }
}
?>
<?php include_once "includes/header.php"; ?>
<div class="content">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    Agregar Producto
                </div>
                <div class="card-body">
                    <form action="agregar_prod.php?id=<?php echo $data_producto['codproducto']; ?>" method="post">
                        <?php echo isset($alert) ? $alert : ''; ?>
                        
                        <div class="form-group">
                            <label for="precio">Cantidad de productos Disponibles</label>
                            <input type="number" class="form-control" value="<?php echo $data_producto['existencia']; ?>" disabled>
                        </div>
                        
                        <div class="form-group">
                            <label for="cantidad">Agregar Cantidad</label>
                            <input type="number" placeholder="Ingrese cantidad" name="no" id="no" class="form-control">
                        </div>

                        <input type="submit" value="Actualizar" class="btn btn-primary">
                        <a href="lista_productos.php" class="btn btn-danger">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "includes/footer.php"; ?>