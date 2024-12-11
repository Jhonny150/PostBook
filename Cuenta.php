<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css" />
    <title id="titulo_app"></title>
    <style>
        .icon-preview {
            font-size: 24px;
            margin-left: 10px;
        }
    </style>
</head>

<body>
<?php
    if (!isset($_COOKIE['usuario'])) {
        header('Location: login.php'); 
        exit;
    }
    ?>
    
    <main>
        <h1>Configuración</h1>
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form>
                    <div class="form-group row">
                        <label for="tituloInput" class="col-sm-4 col-form-label text-right">Título de la App:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="tituloInput">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="bienvenidaInput" class="col-sm-4 col-form-label text-right">Mensaje de Bienvenida:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="bienvenidaInput">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="homeInput" class="col-sm-4 col-form-label text-right">Mensaje Home:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="homeInput">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cambioInput" class="col-sm-4 col-form-label text-right">Mensaje Cambio:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="cambioInput">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="operacionesInput" class="col-sm-4 col-form-label text-right">Mensaje Operaciones:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="operacionesInput">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="configInput" class="col-sm-4 col-form-label text-right">Mensaje Configuración:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="configInput">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cambioIconInput" class="col-sm-4 col-form-label text-right">Icono Cambio:</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="cambioIconInput" onchange="updateIconPreview('cambioIconPreview', this.value)">
                                <option value="fa-solid fa-arrow-right">Cambio</option>
                                <option value="fa-solid fa-sync">Actualizar</option>
                                <option value="fa-solid fa-exchange-alt">Intercambiar</option>
                            </select>
                            <i id="cambioIconPreview" class="icon-preview fa-solid fa-arrow-right"></i>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="operacionesIconInput" class="col-sm-4 col-form-label text-right">Icono Operaciones:</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="operacionesIconInput" onchange="updateIconPreview('operacionesIconPreview', this.value)">
                                <option value="fa-solid fa-cogs">Operaciones</option>
                                <option value="fa-solid fa-tools">Herramientas</option>
                                <option value="fa-solid fa-clipboard-list">Lista</option>
                            </select>
                            <i id="operacionesIconPreview" class="icon-preview fa-solid fa-cogs"></i>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="homeIconInput" class="col-sm-4 col-form-label text-right">Icono Home:</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="homeIconInput" onchange="updateIconPreview('homeIconPreview', this.value)">
                                <option value="fa-solid fa-house">Home</option>
                                <option value="fa-solid fa-home">Inicio</option>
                                <option value="fa-solid fa-hotel">Hotel</option>
                            </select>
                            <i id="homeIconPreview" class="icon-preview fa-solid fa-house"></i>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="configIconInput" class="col-sm-4 col-form-label text-right">Icono Configuración:</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="configIconInput" onchange="updateIconPreview('configIconPreview', this.value)">
                                <option value="fa-solid fa-cog">Configuración</option>
                                <option value="fa-solid fa-sliders-h">Ajustes</option>
                                <option value="fa-solid fa-cogs">Rueda dentada</option>
                            </select>
                            <i id="configIconPreview" class="icon-preview fa-solid fa-cog"></i>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="logoFileInput" class="col-sm-4 col-form-label text-right">Seleccionar Logo:</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" id="logoFileInput" accept="image/*">
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <div class="col-sm-12 text-center">
                            <img id="logoPreview" src="" alt="Logo Preview" class="img-fluid">
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <button class="btn btn-primary" type="button" onclick="guardarConfiguracion()">Guardar Cambios</button>
                    </div>

                    <input type="text" id="logoInput" style="display: none;">
                </form>
            </div>
        </div>

        <div id="footer-bar" class="footer-bar-6">
            <a href="index.php" data-script="js/app.js">
                <i class="fa-solid fa-house"></i>
                <span id="home">Home</span>
            </a>
            <a href="Publicar.php" data-script="js/TipoCambio.js">
                <i class="fa-solid fa-arrow-right"></i>
                <span id="tpcambio">Tipo de Cambio</span>
            </a>
            <a href="Comunidad.php" data-script="js/Operaciones.js">
                <i class="fa-solid fa-cogs"></i>
                <span id="operaciones">Operaciones</span>
            </a>
            <a href="Cuenta.php" data-script="js/Configuracion.js">
                <i class="fa-solid fa-cog"></i>
                <span id="configu">Configuración</span>
            </a>
        </div>
        
    </div>

    </main>

    
</body>



</html>

<script src="js/Configuracion.js"></script>