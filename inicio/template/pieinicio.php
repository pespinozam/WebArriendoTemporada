  </div>
</div>
</main><!-- End #main -->
<footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="footer-info">
              <h3>Day</h3>
              <p>
                A108 Adam Street <br>
                NY 535022, USA<br><br>
                <strong>Phone:</strong> +1 5589 55488 55<br>
                <strong>Email:</strong> info@example.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Day</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/day-multipurpose-html-template-for-free/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
    function addProducto (id,token){
      let url= '../Arrendar/carrito.php'
      let formData = new FormData()
      formData.append('id',id)
      formData.append('token',token)

      fetch(url,{
        method:'POST',
        body: formData,
        mode : 'cors'
      }).then(response => response.json())
      .then(data=>{
        if(data.ok){
          let elemento = document.getElementById("num_cart")
          elemento.innerHTML = data.numero
        }
      })
    }
  </script>


  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
     
  <script>
    toastr.options = {
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "2000",
    }
    var l = localStorage;
    
    function getProductosLS(producto_id, origen){
      const data = l.getItem("productos");
      const data_nueva = []
      $.each(JSON.parse(data), function (index, prod) { 
        if (prod['producto_id'] != producto_id && prod['origen'] != origen) {
          data_nueva.push(prod)
        }
        
      });
      return data_nueva;
    }
    function eliminarProductoLS(producto_id, origen){
      const data = l.getItem("productos");
      const data_old = JSON.parse(data)
      const data_nueva = []
      $.each(data_old, function (index, prod) { 
        if (prod['producto_id'] != producto_id && prod['origen'] != origen) {
          data_nueva.push(prod)
        }
        
      });
      l.setItem("productos", JSON.stringify(data_nueva));
      countCarrito();
      verCarrito();
      toastr.success('Producto eliminado exitosamente', 'Listo!');
      return data_nueva;
    }
    function verCarrito(){
      $('#tableProds tbody').empty();
      const data = l.getItem("productos");
      const data_nueva = []
      $.each(JSON.parse(data), function (index, prod) { 
        
        var row = `<tr>
              <td class="d-none">${prod['producto_id']}</td>
              <td>${prod['nombre']}</td>
              <td>${prod['precio']}</td>
              <td>${prod['cantidad']}</td>
              <td>${prod['total_pagar']}</td>
              <td><button type="button" class="btn btn-sm btn-danger" onclick="eliminarProductoLS('${prod['producto_id']}', '${prod['origen']}');">Eliminar</button></td>
              </tr>`;

        $('#tableProds tbody').append(row);
      });
      return data_nueva;
    }
    function countCarrito(){
      const data = l.getItem("productos");
      var contador = 0
      $.each(JSON.parse(data), function (index, prod) { 
        
        contador += 1;
      });

      if (contador == 0) {
        var row = `<tr>
              <td colspan="5" class="text-center">No hay productos en el carro</td>
              </tr>`;

        $('#tableProds tbody').append(row);
      }

      $('#num_cart').text(contador);
      return contador;
    }
    // function existeProductoLS(){
    //   const data = l.getItem("producto_id");
    //   $.each(JSON.parse(data), function (indexInArray, valueOfElement) { 
    //      console.log(valueOfElement)
    //   });
    //   return data;
    // }

    function addProductoLS(origen,cod){
      // console.log(typeof JSON.parse(data));

      // return false;
      // console.log("id" + origen + cod)
      var ids = "#idProd" + origen + cod
      var nombre = "#nombreProd" + origen + cod
      var precio = $('#precioProd' + origen + cod).val();
      var cantidad = $('#cantidadProd' + origen + cod).val();
      var origen = $('#origenProd' + origen + cod).val();
      var nombre = $(nombre).val();
      var id = $(ids).val();
      // var producto_id = $('#idProd' + origen + cod).val();
      // console.log(producto_id)
      var total_a_pagar = parseInt(precio) * parseInt(cantidad);
      var iva = total_a_pagar * 0.19;
      var neto = total_a_pagar - iva;
      var data = getProductosLS(id, origen);
      var datatida = {
        "precio": precio,
        "cantidad": cantidad,
        "total_pagar": total_a_pagar,
        "producto_id": id,
        "origen": origen,
        "iva": iva,
        "neto": neto,
        "nombre": nombre,
      }

      data.push(datatida)
      console.log(data);
      l.setItem("productos", JSON.stringify(data));
      countCarrito();
      toastr.success('Producto agregado exitosamente', 'Listo!'); 
    } 

    function realizarCompra(){
      const data = l.getItem("productos");
      const estado = "Pendiente Pago"
      const forma_pago = "WebPay"
      // $estado = $_POST['estado'];
      // $metodo_de_pago = $_POST['metodo_de_pago'];
      var producto_id = []
      var cantidad = []
      var neto = []
      var iva = []
      var nombre = []
      var origen = []
      var precio = []
      var total_pagar = []
      $.each(JSON.parse(data), function (index, prod) { 
        producto_id.push(prod['producto_id'])        
        cantidad.push(prod['cantidad'])        
        neto.push(prod['neto'])        
        iva.push(prod['iva'])        
        nombre.push(prod['nombre'])        
        origen.push(prod['origen'])        
        precio.push(prod['precio'])        
        total_pagar.push(prod['total_pagar'])        
      });
      var data_post = {
        "producto_id": producto_id,
        "cantidad": cantidad,
        "neto": neto,
        "iva": iva,
        "nombre": nombre,
        "origen": origen,
        "precio": precio,
        "total_pagar": total_pagar,
        "metodo_de_pago": forma_pago,
        "estado": estado,
      } 
      $.ajax({
        type: "post",
        url: "http://localhost/sitiowebportafolio/venta/create_carrito_compra.php",
        data: data_post,
        dataType: "json",
        success: function (response) {
          console.log(response)
        }
      });
  }
  </script>
  <script>
  $(document).ready(function () {
    verCarrito();
    countCarrito();
  });
  </script>
</body>

</html>