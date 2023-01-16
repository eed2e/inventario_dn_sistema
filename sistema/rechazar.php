<?php
if (!empty($_GET['id'])) {
    require("../conexion.php");
    $id = $_GET['id'];
    $query = mysqli_query($conexion, "SELECT * FROM detallefactura WHERE nofactura =$id");
    $result = mysqli_num_rows($query);  
                                  
    if ($result > 0) {
    while ($dato = mysqli_fetch_array($query)) {
        $cod = $dato['codproducto'];
       
        $cant = $dato['cantidad'];
        
        $sql = mysqli_query($conexion, "SELECT * FROM producto WHERE codproducto =$cod");
        $dat = mysqli_fetch_array($sql);
        $ex = $dat['existencia'];
        $total = ($ex+$cant);
       

        $query_update = mysqli_query($conexion, "UPDATE producto SET  existencia= $total  WHERE codproducto =$cod");

        

    


    }

    }

    $query_del = mysqli_query($conexion, "DELETE FROM detallefactura WHERE nofactura =$id");

    $query_delete = mysqli_query($conexion, "DELETE FROM factura WHERE nofactura =$id");
    mysqli_close($conexion);
    



    header("location: pendiente.php");
}
?>