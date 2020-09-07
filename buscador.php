<?php


// Funcion para filtrar Ciudades y quitar duplicadas.
        function Ciudades(){   
              $data = file_get_contents("data-1.json");
           $places = json_decode($data);
           
              $Ciudad = array_column($places, 'Ciudad');
                
                $Ciudad=array_unique($Ciudad);

                foreach($Ciudad as $Ciudades): 

                if($_POST['ciudad'] == $Ciudades){
                // Retorna la opcion seleccionada           
                            ?>
                            <option value="<?php echo $Ciudades; ?>"selected <?php   ?> > <?php echo $Ciudades; ?></option>
                <?php
                // Retorna la opciones no seleccionadas
                    }if($_POST['ciudad'] != $Ciudades){ 
                            ?><option value="<?php echo $Ciudades ; ?>" ?php   ?> <?php echo $Ciudades; ?></option>
                <?php
                        }
                endforeach; 
} 

?>
<?php
// Funcion para filtrar Tipos y Filtrar Duplicados.
        function Tipo(){   
              $data = file_get_contents("data-1.json");
           $places = json_decode($data);
           
              $Tipo = array_column($places, 'Tipo');
                
                $Tipo=array_unique($Tipo);

                foreach($Tipo as $Tipos): 
                
                    if($_POST['tipo'] == $Tipos){
                // Retorna la opcion seleccionada           
                            ?>
                            <option value="<?php echo $Tipos; ?>"selected <?php   ?> > <?php echo $Tipos; ?></option>
                <?php
                // Retorna la opciones no seleccionadas
                    }if($_POST['tipo'] != $Tipos){ 
                            ?><option value="<?php echo $Tipos ; ?>" ?php   ?> <?php echo $Tipos; ?></option>
                <?php
                        }
                endforeach; 

        } 

?>
<?php
// Funcion para Ver Todos.
        function Todos(){   
            $data = file_get_contents("data-1.json");
            $places = json_decode($data);

                foreach($places as $place):

                $Direccion  = $place->Direccion;
                $Ciudad     = $place->Ciudad;
                $Telefono   = $place->Telefono;
                $CP         = $place->Codigo_Postal;
                $Tipo       = $place->Tipo;
                $Precio     = $place->Precio;

               
                ?>
    
    <div class="card col s12 m12 l12 xl12">
        <div class="card-image col s3 m3 l3 xl3">
            <img src="./img/home.jpg">
        </div>
        
            <div class="card-content col s9 m9 l9 xl9">
                <p><strong>Direccion:</strong> <?php echo $Direccion; ?></p>
                <p><strong>Ciudad: </strong><?php echo $Ciudad; ?></p>
                <p><strong>Telefono: </strong><?php echo $Telefono; ?></p>
                <p><strong>Codigo Postal: </strong><?php echo $CP; ?></p>
                <p><strong>Tipo: </strong><?php echo $Tipo; ?></p>
                <p style="display: inline;"><strong>Precio: <h6 style="color:orange; display:inline"><?php echo $Precio; ?></h6> </strong></p>
            </div>
    </div>

<?php endforeach; 

} 

?>
<?php
// Funcion para Ver Filtrados.

        function Filtrado(){

       

            $selectCiudad =  $_POST['ciudad']; //Obtengo dato de select Ciudad
            $selectTipo = $_POST['tipo'];       // Obtengo dato de select Tipo

            $selectPrecio = $_POST['precio'];   //Obtengo dato de select Precio
            $separador = ";";
            $arrayPrecio = explode($separador, $selectPrecio); //Separo el dato obtenido de slider Precio

            $From =  $arrayPrecio[0];  //Obtengo precio desde
            settype($From,'int');      // Lo convierto a valor numerico
           
            $To = $arrayPrecio [1];     // Obtengo Precio Hasta
            settype($To,'int');         // Lo convierto en valor numerico
          

            $data = file_get_contents("data-1.json");
            $places = json_decode($data);
         
            
            array_multisort(array_column($places, 'Precio'), SORT_ASC, SORT_NATURAL, $places); //Ordeno el Arreglo en forma Ascendente por Precio
         
            
            foreach ($places as $place) {
                $Direccion  = $place->Direccion;
                $Ciudad     = $place->Ciudad;
                $Telefono   = $place->Telefono;
                $CP         = $place->Codigo_Postal;
                $Tipo       = $place->Tipo;
                $Precio     = $place->Precio;
              
                
                $PrecioSinSigno = explode("$", $Precio); //Elimino el signo $
                $PrecioLimpio = str_replace(",","",$PrecioSinSigno); //Elimino la coma
             
                

                $PrecioEnNunero = $PrecioLimpio[1]; //Obtengo el valor neto de Precio
                 settype($PrecioEnNunero,'int');    // Lo convierto en numero para compararlo con From y To
       
                
                if (($PrecioEnNunero >$From) && ($PrecioEnNunero < $To) && //Filtro Valores Desde y Hasta

                
                    (($Ciudad == $selectCiudad && $selectTipo =="") //Filtro por Ciudad o Tipo en Blanco
                    ||($Tipo == $selectTipo && $selectCiudad == "") //Filtro por Tipo o Ciudad en Blanco
                    || ($Ciudad == $selectCiudad && $Tipo == $selectTipo) // Filtro por Ciudad y Tipo
                    || ($selectCiudad == "" && $selectTipo == "") // Filtro solo por precio
                    )
                    ) {
                    ?> 
        <!-------- GENERO TEMPLATE FILTRADO ------->

    <div class="card col s12 m12 l12 xl12">
        <div class="card-image col s3 m3 l3 xl3">
            <img src="./img/home.jpg">
        </div>
        
            <div class="card-content col s9 m9 l9 xl9">
                <p><strong>Direccion:</strong> <?php echo $Direccion; ?></p>
                <p><strong>Ciudad: </strong><?php echo $Ciudad; ?></p>
                <p><strong>Telefono: </strong><?php echo $Telefono; ?></p>
                <p><strong>Codigo Postal: </strong><?php echo $CP; ?></p>
                <p><strong>Tipo: </strong><?php echo $Tipo; ?></p>
                <p style="display: inline;"><strong>Precio: <h6 style="color:orange; display:inline"><?php echo $Precio; ?></h6> </strong></p>
            </div>
    </div>
<?php       

            }
            }
            
        }

   //DETERMINO VALORES INICIALES Y DE BUSQUEDA DE SLIDER
    $selectPrecio = $_POST['precio'];   //Obtengo dato de select Precio
    $separador = ";";
    $arrayPrecio = explode($separador, $selectPrecio); //Separo el dato obtenido de slider Precio
  
    if ($selectPrecio == ""){
         $From = 200;
       
    } else $From = $arrayPrecio[0];  //Obtengo precio desde
            settype($From, 'int');    // Lo convierto a valor numerico  
            echo $From;
         
    if ($selectPrecio == "") {
        $To = 80000;
   }else $To = $arrayPrecio[1];    //Obtengo precio Hasta
            settype($To, 'int');   // Lo convierto a valor numerico
            echo $To;

    

?>


