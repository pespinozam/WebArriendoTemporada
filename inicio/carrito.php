<?php include("template/cabecerainicio.php");?>

<main>
  <div class="container">

    <div class="row">
      <div class="col-12 justify-content-center d-flex">
        <h2>Carrito de Compras</h2>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-12">
        <div class="table-responsive">
        <table class="table" id="tableProds">
          <thead class="thead-dark">
            <tr>
              <th scope="col" class="d-none">#</th>
              <th scope="col">Nombre</th>
              <th scope="col">Precio</th>
              <th scope="col">Cantidad</th>
              <th scope="col">Total</th>
              <th scope="col">Acción</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
        </table>
        </div>
      </div>
    </div>

    <div class="row my-5">
      <div class="col-12 justify-content-start d-flex">
        <label style="font-weight: bold;">Método de Pago</label>
        <div class="form-check">
            <input class="form-check-input mt-4" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
            <label class="form-check-label" for="flexRadioDefault1">
                <img class="img-fluid" src="assets/img/logo-webpay-plus.png" alt="" style="width: 340px;">
            </label>
        </div>
      </div>
    </div>
    <div class="row m-5">
      <div class="col-12 justify-content-center d-flex">
        <button type="button" class="btn btn-success w-50" onclick="realizarCompra();">Pagar</button>
      </div>
    </div>
  </div>
</main>


<?php include("template/pieinicio.php");?>