<?php
    include("db/db.php");
    $db = new Database();
    $con = $db->conectar();
    $email ="";
    $contraseña ="";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Logeo</title>
    <link rel="stylesheet" type="text/css" href="styles/global.css">
    <link rel="stylesheet" type="text/css" href="styles/login.css">
  </head>
  <body>
    <section class="container">
      <form method="post" enctype="multipart/form-data" action="scripts/comprobarlogin.php" class="form">
        <h1>Inicio de sesión</h1>
        <label>Email</label>
        <input name="email" id="email" type="email" required placeholder="Ingrese su email...">
        <label>Contraseña</label>
        <input name="contraseña" id="contraseña" type="password" required placeholder="Ingrese su contraseña...">
        <button type="submit">Iniciar sesión</button>
        <p>¿No tienes una cuenta aun? <a href="register.php">¡Registrate!</a></p>
      </form>
      <?php 
        if(isset($_GET['fallo'])){
          if($_GET['fallo']==1){
            echo '<p style="color:red; margin-top:1em;">Contraseña o mail incorrectos</p>';
          }
          if($_GET['fallo']==2){
            echo '<p style="color:crimson;margin-top: 1em;">No se inicio sesión</p>';
          }
        }
      ?>
    </section>
    </body>
</html>
