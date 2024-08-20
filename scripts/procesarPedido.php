<?php

if (!isset($_POST['productos'])) {
    header("Location: ../index.php");
    exit();
}
header("Location: ../index.php?destroyCarrito=true");
session_start();
echo "Email en sesión: " . htmlspecialchars($_SESSION["email"]) . "<br><br>";
include("../db/db.php");
$db = new Database();
$date = getDateForDatabase();
$con = $db->conectar();
$email = $_SESSION["email"];
echo($email);
$consulta = $con->prepare("SELECT idUsuario FROM usuarios WHERE email=:email");
$consulta->bindParam(':email', $email, PDO::PARAM_STR);
$consulta->execute();
$response = $consulta->fetchAll(PDO::FETCH_ASSOC);
foreach($response as $row){
    $idUsuario = $row['idUsuario'];
}
$consulta = $con->prepare("INSERT INTO pedidos(idUsuario, fechaPedido) VALUES ('$idUsuario', '$date')");
$consulta->execute();
$consulta = $con->prepare("SELECT max(pedidos.idPedido) as idPedido  FROM pedidos WHERE idUsuario='$idUsuario'");
$consulta->execute();
$response = $consulta->fetchAll(PDO::FETCH_ASSOC);
if ($response) {
    foreach($response as $row){
        $idPedido = $row['idPedido'];
    }
    echo "ID del Pedido: " . $idPedido . "<br><br>";
}

function getDateForDatabase(): string {
    $date_formated = date('Y-m-d H:i:s');
    return $date_formated;
}

$productos = json_decode($_POST['productos'], true);
if ($productos) {
    foreach ($productos as $producto) {
        $name = $producto['name'];
        $idProducto = $producto['idProducto'];
        $cantidad = $producto['quantity'];
        $price = $producto['price'];
        $totalPrice = $producto['totalPrice'];
        $image = $producto['image'];
        $consulta = $con->prepare("INSERT INTO productosPedidos(idPedido, idProducto, cantidad) VALUES ('$idPedido', '$idProducto','$cantidad')");
        $consulta->execute();
    }
}


?>
