<?php
if (!empty($_GET['id'])) {
    require("../conexion.php");
    $codproducto = $_GET['id'];
        $query = mysqli_query($conexion, "SELECT imagen  FROM producto  WHERE codproducto = $codproducto");  
    $query_delete = mysqli_query($conexion, "DELETE FROM producto WHERE codproducto = $codproducto");
    $data = mysqli_fetch_assoc($query);
    
        $filename = $data['imagen'];

    if (file_exists($filename)) {
        $success = unlink($filename);
    
    }
    mysqli_close($conexion);
   
    
    header("location: lista_productos.php");
}
?>