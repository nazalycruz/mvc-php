<?php

//clase controlador principal
//se encarga de cargar los modelos y las vistas

class Controlador{
    public function modelo($modelo){
        require_once '../app/model/'. '.php';
        return new $modelo();
    }

    public function view($view){
        require_once '../app/view/'. '.php';
        return new $view();
    }
}