 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" type="text/css" href="styles/carrito.css">
    <link rel="stylesheet" type="text/css" href="styles/global.css">
</head>
<body>
  <?php 
  include("components/header.php");
  ?>
  <section>
    <h1>Carrito</h1>
    <section class="section-carrito">
      <div class="list-carrito">

      </div>
      <div id="total-carrito">
      <!-- El total del carrito se mostrará aquí -->
    </div>
    <form id="form-pedido" action="scripts/procesarPedido.php" method="POST">
        <input type="hidden" name="productos" id="productos-carrito">
        <button class="boton-container" type="submit">Hacer pedido</button>
      </form>
    </section>
    <script src="scripts/mostrarCarrito.js"></script>
  </section>
</body>
</html>

