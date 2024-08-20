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
  include("components/slider.php");
  ?>
  <section>
    <div class="container-products">
      <h1>Productos</h1>
      <div class="list-products">
        <?php
        $sql = $con->prepare("SELECT * FROM productos");
        $sql->execute();
        $response = $sql->fetchAll(PDO::FETCH_ASSOC);
  
        foreach ($response as $row) { 
          $componentes->getCardProducto($row);
        }
      ?>
     </div>
    </div>
  </section>
  <?php
  include("components/footer.php");
  ?>
 <script src="scripts/carrito.js" defer></script>
 <?php
    if(isset($_GET['destroyCarrito'])){
          echo('<script>
            localStorage.clear();
            window.location.href = "index.php";
            </script>');
    
    }?>
 </body>
</html>

