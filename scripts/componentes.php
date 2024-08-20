<?php

class Componentes {
  public function getCardProducto($row) {
    ?>
      <div class="card-product">
        <div class="card-product-img">
          <img src="<?php echo htmlspecialchars($row['imagen']); ?>"/>
        </div>
        <div class="card-product-info">
          <div>
            <h3 class="title"><?php echo htmlspecialchars($row['nombre']); ?></h3>
            <h5 class="text-caracteristicas">caracteristicas</h5>
            <p class="descripcion"><?php echo htmlspecialchars($row['descripcion']); ?></p>
           
          </div>
          <div class="container-precio">
            <h5 class="text-precio">Precio</h5>
            <p class="precio"><?php echo htmlspecialchars($row['precio']); ?> USD</p>
            <button class="add-carrito boton" data-name="<?php echo htmlspecialchars($row['nombre']); ?>" data-price="<?php echo htmlspecialchars($row['precio']); ?>" 
            data-id="<?php echo htmlspecialchars($row['idProducto']); ?>" data-image="<?php echo htmlspecialchars($row['imagen']); ?>">Añadir al carrito</button>
          </div>
        </div>
      </div>
    <?php
  }
  public function getPedidos($row) {
    ?>
      <div class="card-product">
        <div class="card-product-info">
          <div>
            <h3 class="title">Id pedido:<?php echo htmlspecialchars($row['idPedido']); ?></h3>
            <p class="descripcion">id usuario:<?php echo htmlspecialchars($row['idUsuario']); ?></p>
          </div>
          <div class="container-precio">
            <p class="precio"><?php echo htmlspecialchars($row['fechaPedido']); ?></p>
          </div>
        </div>
      </div>
    <?php
  }
}

?>
