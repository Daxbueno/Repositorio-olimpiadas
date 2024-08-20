window.onload = function () {
    actualizarCarrito();
    mostrarProductosCarrito();
    mostrarTotalCarrito()
};

if (!localStorage.getItem("pedidos-carrito")) {
    localStorage.setItem("pedidos-carrito", JSON.stringify([]));
}

function mostrarProductosCarrito() {
    const pedidos = JSON.parse(localStorage.getItem("pedidos-carrito"));
    const listCarrito = document.querySelector(".list-carrito");
    const formPedido = document.getElementById("form-pedido");
    const inputProductos = document.getElementById("productos-carrito");

    // Limpiar la lista de carrito antes de agregar productos
    listCarrito.innerHTML = "";

    pedidos.forEach((producto) => {
        const itemCarrito = document.createElement("div");
        itemCarrito.classList.add("card-product");

        itemCarrito.innerHTML = `
            <div class="img-product">
              <img class="img-product" src="${producto.image}" alt="${producto.name}">
            </div>
            <div class="info-product">
              <div>
                <h3 class="title">${producto.name}</h3>
                <div class="container-quantity">
                  <button class="restar" data-id="${producto.idProducto}">-</button>
                  <p>${producto.quantity}</p>
                  <button class="sumar" data-id="${producto.idProducto}">+</button>
                </div>
              </div>
              <div class="container-precio">
                <p>Precio unitario: ${producto.price} USD</p>
                <p class="total-product">Total: ${producto.totalPrice} USD</p>
              </div>
            </div>
        `;

        listCarrito.appendChild(itemCarrito);
    });

    // Agregar eventos a los botones de sumar y restar
    document.querySelectorAll(".sumar").forEach((button) => {
        button.addEventListener("click", (event) => {
            const productId = button.getAttribute("data-id");
            modificarCantidadProducto(productId, 1);
        });
    });

    document.querySelectorAll(".restar").forEach((button) => {
        button.addEventListener("click", (event) => {
            const productId = button.getAttribute("data-id");
            modificarCantidadProducto(productId, -1);
        });
    });

    // Actualizar el campo oculto del formulario con el JSON del carrito
    inputProductos.value = JSON.stringify(pedidos);
}

function modificarCantidadProducto(productId, cantidad) {
    const pedidos = JSON.parse(localStorage.getItem("pedidos-carrito"));

    const producto = pedidos.find((pedido) => pedido.idProducto == productId);

    if (producto) {
        producto.quantity += cantidad;
        producto.totalPrice = producto.quantity * producto.price;

        if (producto.quantity <= 0) {
            const index = pedidos.indexOf(producto);
            pedidos.splice(index, 1);
        }

        localStorage.setItem("pedidos-carrito", JSON.stringify(pedidos));
        actualizarCarrito();
        mostrarProductosCarrito();
        mostrarTotalCarrito()
    }
}

function addToCart(product) {
    const pedidos = JSON.parse(localStorage.getItem("pedidos-carrito"));

    let [newProduct] = pedidos.filter(
        (pedido) => pedido.idProducto == product.idProducto
    );

    if (!newProduct) {
        newProduct = {
            idProducto: product.idProducto,
            name: product.name,
            totalPrice: product.price,
            quantity: 1,
            price: product.price,
            image: product.image,
        };
        pedidos.push(newProduct);
    } else {
        newProduct.quantity += 1;
        newProduct.totalPrice += product.price;
    }

    const newPedidos = pedidos.map((val) =>
        val.idProducto === product.idProducto ? newProduct : val
    );

    localStorage.setItem("pedidos-carrito", JSON.stringify(newPedidos));
    actualizarCarrito();
    mostrarProductosCarrito();
}

function actualizarCarrito() {
    const pedidos = JSON.parse(localStorage.getItem("pedidos-carrito"));
    const cantidad = obtenerTotalQuantitys(pedidos);

    document.getElementById("numero-carrito").innerHTML = cantidad;
}

function obtenerTotalQuantitys(pedidos) {
    let total = 0;
    pedidos.forEach((pedido) => {
        total += pedido.quantity;
    });
    return total;
}
function mostrarTotalCarrito() {
    const pedidos = JSON.parse(localStorage.getItem("pedidos-carrito"));
    const total = pedidos.reduce((acc, pedido) => acc + pedido.totalPrice, 0);
    const totalCarrito = document.getElementById("total-carrito");
    if (totalCarrito) {
        totalCarrito.innerHTML = `Total carrito: ${total.toFixed(2)} USD`;
    }
}