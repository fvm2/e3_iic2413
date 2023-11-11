<?php include('templates/header.html');   ?>

<body>
    <div class='main'>
        <h1 class='title' align="center">Blockbuster 2.0</h1>
        <p style="text-align:center;">La plataforma de películas, series y juegos</p>

            <form  action='login.php' method='GET'>
                <input class='btn' type='submit' value='Usuario'>
            </form>

        <h1 align="center">  </h1>

        <div class='container'>
            <h3>Ver base de datos 1</h3>
                <form  action='consultas/bdd_1.php' method='GET'>
                    <input class='btn' type='submit' value='Consultar'>
                </form>
        </div>
            
        <div class='container'>
            <h3>Ver base de datos 2</h3>
                <form  action='consultas/bdd_2.php' method='GET'>
                    <input class='btn' type='submit' value='Consultar'>
                </form>
        </div>
    
    </div>
  <br>
  <br>
  <br>
</body>
</html>
