<?php
// auth.php
session_start();

include("../db/db.php");
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];

    // Conectarse a la base de datos
    $con = $db->conectar();

    // Verificar las credenciales del usuario sin usar consultas preparadas y evitando inyecciones SQL
    $sql = $con->prepare("SELECT * FROM usuarios WHERE email = :email AND contraseña = :password");
    $sql->bindParam(':email', $email, PDO::PARAM_STR);
    $sql->bindParam(':password', $contraseña, PDO::PARAM_STR);
    $sql->execute();
    $response = $sql->fetchAll(PDO::FETCH_ASSOC);

    if ($response) {
        // Las credenciales son válidas, iniciar sesión
        $_SESSION["loggedin"] = true;
        $_SESSION["email"] = $email;
        header("Location: ../index.php"); // Redirigir a la página protegida
        exit();
    } else {
        header("Location: ../login.php?fallo=1"); // Redirigir a la página protegida
    }

    mysqli_close($con);
}
?>
