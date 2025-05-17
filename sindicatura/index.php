<?php
session_start();
include 'conexion.php'; // este archivo debe contener tu conexión a MySQL

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $clave = $_POST['contraseña'];

    // Puedes encriptar si la clave está encriptada en la base de datos
    // $clave = hash("sha256", $clave);

    $sql = "SELECT * FROM usuarios WHERE Cedula = ? AND Nombre = ? AND Contraceña = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $cedula, $nombre, $clave);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $_SESSION['usuario'] = $nombre;
        header("Location: ./resources/dashboard.php");
        exit();
    } else {
        $error = "Datos incorrectos. Intente nuevamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <title>Login</title>
</head>
<body class="container">
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <form method="POST" class="form-group mt-5 mb-5 p-5 border border-primary rounded shadow bg-light">
            <h2 class="text-center mb-4">Iniciar Sesión</h2>

            <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

            <label>Cédula:</label>
            <input type="text" name="cedula" required class="form-control mb-3">

            <label>Nombre:</label>
            <input type="text" name="nombre" required class="form-control mb-3">

            <label>Contraseña:</label>
            <input type="password" name="contraseña" required class="form-control mb-4">

            <button class="btn btn-primary btn-lg w-100" type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
