<?php

//redireccionando pagina

function redireccionar($pagina){
    header('localhost'.RUTA_URL. $pagina);
}