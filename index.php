
<div style="display:none;">
<?php 
include 'buscador.php';
?>
</div>


<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link type="text/css" rel="stylesheet" href="css/customColors.css" media="screen,projection" />
        <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.css" media="screen,projection" />
        <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" media="screen,projection" />
        <link type="text/css" rel="stylesheet" href="css/index.css" media="screen,projection" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Formulario</title>
    </head>

    <body >

        <div class="contenedor">
            <div class="card rowTitulo">
                <h1>Buscador</h1>
            </div>
            <div class="colFiltros">
           
                <form  id="formulario" method="POST" acction = ""   >
                    <div class="filtrosContenido">
                        <div class="tituloFiltros">
                            <h5>Realiza una busqueda personalizada</h5>
                        </div>
                        

                        <div class="filtroCiudad input-field select">
                            <label for="selectCiudad">Ciudad:</label>
                            <select class="select" name="ciudad" id="selectCiudad">
                                <option value="" selected>Elige una ciudad</option>
                                <!-- Funcion en PHP para determinar select de ciudades -->
                                <?php Ciudades(); ?>
                            </select>
                        </div>

                        <div class="filtroTipo input-field">
                            <label for="selecTipo">Tipo:</label><br>
                            <select name="tipo" id="selectTipo">
                                <option value=""  >Elige un tipo</option>
                                <!-- Funcion en PHP para determinar select de Tipos -->
                                <?php Tipo(); ?>
                              

                            </select>
                        </div>
                        <!-- Determino data-from y data-to del slider mediante variables de php-->
                        <div class="filtroPrecio">
                            <label for="rangoPrecio">Precio:</label>
                            <input type="text" class="js-range-slider" id="rangoPrecio" name="precio" value="" 
                            data-type="double"
                            data-min="0"
                            data-max="100000"
                            data-from= "<?php echo $From ?>" 
                            data-to="<?php echo $To ?>"
                            data-grid="false"
                            data-prefix=$
                            />
                        </div>
                        <div class="botonField">
                            <input type="submit" class="btn white" value="Buscar" id="submitButton"  />
                             
                           
                        </div>
                    </div>
                </form>
            </div>

            <div class="colContenido">
                <div class="tituloContenido card">
                    <h5>Resultados de la busqueda:</h5>
                    <div class="divider "></div>
                    <button type="button" name="todos" class="btn-flat waves-effect" id="mostrarTodos" onclick='verTodas()' 
                        
                        >Mostrar Todos</button>
                    <div>
                        
                    
                    <!-- Muestra los resultados de las consultas -->
                    <div id="VerTodas" style="display: none;"class = "row"  ><?php Todos(); ?></div>   
                    <div  id="Filtro"  name = "filtro" class = "row Filtro"  ><?php if (isset($_POST['ciudad']))  Filtrado(); ?>
                    
                    
                    </div>
                    </div>
             
                    

                </div>

            </div>

        </div>

        <script type="text/javascript" src="js/jquery-3.0.0.js"></script>
        <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
        <script>
        $(document).ready(function() {
            $('select').formSelect();
        });
        </script>
        <script>
            $(".js-range-slider").ionRangeSlider();
        </script>
       
       
    </body>

</html>
