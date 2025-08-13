<?php
include('connection.php');
$con = connection();

// Variable para almacenar el ID del usuario a editar
$id = null;
$user = null;

// --- PARTE 1: MOSTRAR EL FORMULARIO CON DATOS ACTUALES ---
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id='$id'";
    $query = mysqli_query($con, $sql);
    $user = mysqli_fetch_array($query); // Obtiene los datos del usuario
}

// --- PARTE 2: ACTUALIZAR LOS DATOS EN LA BASE DE DATOS CUANDO SE ENVÍA EL FORMULARIO ---
if(isset($_POST['id_user_update'])){ // Si se envió el formulario de actualización
    $id_update = $_POST['id_user_update'];
    $name_update = $_POST['name_update'];
    $lastname_update = $_POST['lastname_update'];
    $username_update = $_POST['username_update'];
    $password_update = $_POST['password_update'];
    $email_update = $_POST['email_update'];

    // Es buena práctica limpiar los datos para seguridad
    $name_update = mysqli_real_escape_string($con, $name_update);
    $lastname_update = mysqli_real_escape_string($con, $lastname_update);
    $username_update = mysqli_real_escape_string($con, $username_update);
    $password_update = mysqli_real_escape_string($con, $password_update);
    $email_update = mysqli_real_escape_string($con, $email_update);

    // Consulta SQL para actualizar el usuario
    $sql_update = "UPDATE users SET 
                   name='$name_update', 
                   lastname='$lastname_update', 
                   username='$username_update', 
                   password='$password_update', 
                   email='$email_update' 
                   WHERE id='$id_update'";

    $query_update = mysqli_query($con, $sql_update);

    if($query_update){
        // Si la actualización fue exitosa, redirige de nuevo a index.php
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar el usuario: " . mysqli_error($con);
    }
}

// Si no se proporcionó un ID para editar o se accedió directamente, redirigir
if ($id === null && !isset($_POST['id_user_update'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="css/style.css"> <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="form-section panel">
            <form action="edit_user.php" method="POST">
                <h1>Editar usuario</h1>
                <input type="hidden" name="id_user_update" value="<?= htmlspecialchars($user['id']) ?>">

                <input type="text" name="name_update" placeholder="Nombre" value="<?= htmlspecialchars($user['name']) ?>">
                <input type="text" name="lastname_update" placeholder="Apellido" value="<?= htmlspecialchars($user['lastname']) ?>">
                <input type="text" name="username_update" placeholder="Username" value="<?= htmlspecialchars($user['username']) ?>">
                <input type="password" name="password_update" placeholder="Password" value="<?= htmlspecialchars($user['password']) ?>">
                <input type="email" name="email_update" placeholder="Email" value="<?= htmlspecialchars($user['email']) ?>">

                <input type="submit" value="ACTUALIZAR USUARIO">
            </form>
        </div>
    </div>
</body>
</html>