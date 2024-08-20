<?php
    include("db/db.php");
    $db = new Database();
    $con = $db->conectar();
    $id= -1;
    $pagina = "login";
?>
<head>
  <title>Personalizacion de usuario</title>
  <link rel="stylesheet" type="text/css" href="styles/global.css">
  <link rel="stylesheet" type="text/css" href="styles/register.css">
</head>    
<body>
  <h1>Registro de usuario</h1>
  <form action="db/manejoBD.php" method="post" enctype="multipart/form-data" class="form">
      <label>Nombre</label>
      <input name="nombre" type="text" required value = "" placeholder="Ingrese su nombre..."/> 
      <label>Email</label>
      <input name="email" type="email" required value = "" placeholder="Ingrese su email..."/>
      <label>Contraseña</label>
      <input name="contraseña" type="password" required value="" placeholder="Ingrese su contraseña...">
      <input name="ID" type="hidden" value="<?php $id ?>">
      <input type="submit" value="Subir datos" name="submit">
      <p>¿Ya tenes una cuenta? <a href="login.php">Inicia sesión!</a></p>
    </form>
  <?php
    if (isset($_GET['fallo'])){
        echo '<p>El mail esta tomado</p>';
    }
  ?>
</body>