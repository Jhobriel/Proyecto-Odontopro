<?php
include('connection.php');

$con = connection(); // Obtiene la conexión a la base de datos

// Captura los datos del formulario (ya los tienes en $_POST)
// No necesitas $id = null; si es autoincremental

$name = $_POST['name'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

// --- IMPORTANTE: Limpiar los datos para seguridad (PREVENCIÓN DE INYECCIONES SQL) ---
$name = mysqli_real_escape_string($con, $name);
$lastname = mysqli_real_escape_string($con, $lastname);
$username = mysqli_real_escape_string($con, $username);
$password = mysqli_real_escape_string($con, $password); // ¡Recuerda hashear contraseñas en un proyecto real!
$email = mysqli_real_escape_string($con, $email);

// Consulta SQL para insertar el nuevo usuario
// Asegúrate de que las columnas coincidan con las de tu tabla "users"
$sql = "INSERT INTO users (name, lastname, username, password, email) VALUES ('$name', '$lastname', '$username', '$password', '$email')";

$query = mysqli_query($con, $sql);

if($query){
    // Si la inserción fue exitosa, redirige de nuevo a index.php para mostrar el nuevo usuario
    header("Location: index.php");
    exit(); // Crucial después de header()
} else {
    // Si hay un error, muestra un mensaje de depuración
    echo "Error al agregar usuario: " . mysqli_error($con);
    exit(); // Detiene la ejecución si hay un error
}
?>