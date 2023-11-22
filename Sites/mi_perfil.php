<?php include('templates/header.html');   ?>
<?php include('config/data.php');   ?>

<body>
    <h1 style="color: #008080;">Mi perfil</h1></br></br>
    <!-- ------------------------------------------------------------------- -->
    <!-- Pon aca la logica de las consultas sobre los datos del Usuario -->

    <!-- ----------------------------------- -->
    <div class='container align-self-center'>
        <h3 style="color: #008080;">informacion del usuario</h3>
        <div class="card" style="width: 18rem; margin-right: 10rem; margin-left: 10rem;">
            <?php foreach ($dataCollected as $p) : ?>
                <div class="card-header" style="background-color:#F0F8FF">
                    Usuario
                </div>
                <div class="card-body">
                    <p class="card-text">Nombre: <?php echo $p[0]; ?></p>
                    <p class="card-text">Email: <?php echo $p[1]; ?></p>
                    <p class="card-text">Username: <?php echo $p[2]; ?></p>
                    <p class="card-text">Edad: <?php echo $p[3]; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    </br></br>
    <!-- ------------------------------------------------------------------- -->
    <!-- Logica listado suscripciones activas de Videojuegos -->
    <!-- y cantidad de horas jugadas -->

    <!-- ----------------------------------- -->
    <!-- Logica listado suscripciones activas de peliculas y series -->
    <!-- y cantidad de horas vistas -->

    <!-- ----------------------------------- -->
    <div class='container align-self-center'>
        <h3 style="color: #008080;">suscripciones actuales</h3>
        <div class="row" style="margin-right: 1rem; margin-left: 1rem;">
            
            <div class="col-sm-6 ">
                <div class="card">
                    <?php foreach ($dataCollected as $p) : ?>
                    <div class="card-header"  style="background-color:#F0F8FF">
                        Videojuegos
                    </div>
                    <div class="card-body">
                        <p class="card-text"> <?php echo $p[0]; ?></p>
                    </div>
                    <div class="card-footer text-muted">
                        cantidad de horas jugadas
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
                <div class="col-sm-6">
                    <div class="card">
                    <?php foreach ($dataCollected as $p) : ?>
                    <div class="card-header"  style="background-color:#F0F8FF">
                        Peliculas
                    </div>
                    <div class="card-body">
                        <p class="card-text"> <?php echo $p[0]; ?></p>
                    </div>
                    <div class="card-footer text-muted">
                        cantidad de horas vistas
                    </div>
                    <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</body>


<?php include('templates/footer.html'); ?>