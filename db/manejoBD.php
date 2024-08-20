<?php

ob_start(); // Inicia el buffer de salida

session_start();

include("db.php");
$db = new Database();
$con = $db->conectar();

$ID = $_POST['ID'];
$nombre = $_POST['nombre'];
$contraseña = $_POST['contraseña'];
$email = $_POST['email'];

if (($_SERVER["REQUEST_METHOD"] == "POST") && ($ID == -1)) {
  $email = $_POST['email'];
  echo $email;
  echo '<br>';
  $sql = $con->prepare("SELECT *
          FROM usuarios 
          WHERE email='$email'");
  $sql->execute();
  $response = $sql->fetchAll(PDO::FETCH_ASSOC);
  if ($response) {
    $_SESSION["email"] = $email;
    header("Location: ../register.php?fallo=1");
    exit();
  }
}
if (isset($_GET["Eliminar"])){
  $Eliminar = $_GET["Eliminar"];
}
else{
  $Eliminar = -1;
}


// Si no hay una ID, redirigimos a login.php
header("Location: ../login.php");
ob_end_flush(); // Liberar el buffer de salida antes de redirigir


echo htmlspecialchars($_POST['nombre']);print(" ");
print("<br> Su E-mail es: ");
echo htmlspecialchars($_POST['email']);
echo('La id deberia estar acaaa '.$ID);

if ($Eliminar==1){
  echo($ID);
  //$consulta = "DELETE FROM alunos WHERE ID = $ID";
  $consulta = $con->prepare("DELETE FROM usuarios WHERE idUsuarios = '$ID';");
  $consulta->execute();
}
else{
    $consulta = $con->prepare("INSERT INTO usuarios(nombre, email, contraseña) VALUES ('$nombre', '$email', '$contraseña')");
    $consulta->execute();
  }
  $response = $consulta->fetchAll(PDO::FETCH_ASSOC);
echo ($response);
?>