<?php include('templates/header.html');   ?>

<body>
    <div class='main'>
        <h1 class='title' style="color:#008080" align="center">Nombre del contenido</h1>
        <br>
        <br>
        
        <!-- -->
        <p style="text-align:center;">
          Especificaciones del contenido
        </p>
        <br>
        <br>

        <!-- -->
        <p style="text-align:center;">
          Tabla con proveedor que lo ofrece y sus precios 
        </p>
        <br>
        <br>
        
        <!-- -->
        <div class='container' style="width: 70%">
          <h3>Seleciona un proveedor para comprar</h3>
          <br>
          <form action='./queries/prodecimiento02.php' method='GET'>
            <select class="form-select form-select-lg mb-3" aria-label="Large select example">
              <option selected>Selecciona un Proveedor</option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
            <button type="submit" class="btn btn-primary" onclick="window.location.href='/Sites/historial_compras.php'">Submit</button>
          </form>
        </div>


    </div>
  <br>
  <br>
  <br>
</body>
</html>
