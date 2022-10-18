<?php 

/**Mapear la url ingresada en el navegador 
 * 1.- controlador
 * 2.- metodo
 */

class Core{
    protected $controladorActual ='paginaController';
    protected $metodoActual = 'index';
    protected $parametros = [];

    public function __construct(){
         $url = $this->getUrl();
        
        //busca en controller si el controlador existe
        if(isset($url[0])){
            if(file_exists('../app/controllers/'.ucwords($url[0]).'.php')){
                //si existe se setea como controlador por defecto
                $this->controladorActual = ucwords($url[0]);
                //unset indice o
                unset($url[0]);
            }
        }
        
        //requerir el controlador con indice 0 de la  url
        require_once '../app/controllers/'. $this->controladorActual . '.php';
        $this->controladorActual = new $this->controladorActual();

        //chequea el siguiente indice el cual indica el metodo
        if(isset($url[1])){
            if(method_exists($this->controladorActual, $url[1])){
                //chequeamos al metodo
                $this->metodoActual = $url[1];
                unset($url[1]);
            }
        }
        //trae el metodo
        // echo $this->metodoActual;
        $this->parametros = $url ? array_values($url): [];
        // var_dump($this->controladorActual);
        //llamar callback con parametros array
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
        // unset($url[0]);


    }

    public function getUrl(){
        // echo $_GET['url'];
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }

 }