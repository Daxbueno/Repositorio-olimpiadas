<?php
include("db/db.php");
include("scripts/componentes.php");

$db = new Database();

$con = $db->conectar();

$componentes = new Componentes();

session_start();
if (isset($_SESSION["loggedin"])){
  if ($_SESSION["loggedin"] == true){
    $usuariologeado = $_SESSION["email"];
  }
  else{
    header("Location: login.php?fallo=2"); // Redirigir a la página protegida
  }
}
else{
  header("Location: login.php?fallo=2"); // Redirigir a la página protegida
}
$email = $usuariologeado;
$consulta = $con->prepare("SELECT idUsuario FROM usuarios WHERE email=:email");
$consulta->bindParam(':email', $email, PDO::PARAM_STR);
$consulta->execute();
$response = $consulta->fetchAll(PDO::FETCH_ASSOC);
foreach($response as $row){
    $idUsuario = $row['idUsuario'];
}
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Deportes al Aire Libre</title>
    <link rel="stylesheet" type="text/css" href="styles/index.css">
    <link rel="stylesheet" type="text/css" href="styles/global.css">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>
<body>
  <?php 
  include("components/header.php");
  ?>
  <section>
    <div class="container-products">
      <h1>Productos</h1>
      <div class="list-products">
        <?php
        $sql = $con->prepare("SELECT * FROM pedidos WHERE idUsuario='$idUsuario'");
        $sql->execute();
        $response = $sql->fetchAll(PDO::FETCH_ASSOC);
  
        foreach ($response as $row) { 
          $componentes->getPedidos($row);
        }
      ?>
     </div>
    </div>
  </section>
  <?php
  include("components/footer.php");
  ?>
 </body>
</html>

