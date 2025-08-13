<?php

include("connection.php"); // Incluye el archivo de conexión a la base de datos
$con = connection(); // Establece la conexión

// Verifica si se recibió el ID del usuario a eliminar por la URL
if(isset($_GET['id'])){
    $id = $_GET['id']; // Obtiene el ID del usuario desde la URL

    // Consulta SQL para eliminar el usuario con el ID especificado
    $sql = "DELETE FROM users WHERE id='$id'";
    $query = mysqli_query($con, $sql); // Ejecuta la consulta

    if($query){
        // Si la eliminación fue exitosa, redirige de nuevo a index.php
        header("Location: index.php");
        exit(); // Es crucial usar exit() después de header()
    } else {
        echo "Error al eliminar el usuario: " . mysqli_error($con);
    }
} else {
    // Si no se proporcionó un ID, redirige a index.php (o muestra un mensaje de error)
    header("Location: index.php");
    exit();
}

?>