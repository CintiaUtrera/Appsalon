<?php

namespace Controllers;

use MVC\Router;

class LoginController {
    public static function login(Router $router){

        $router->render('auth/login');
    }

    public static function logout(Router $router){
        
    }

    public static function olvide(Router $router){
        
    }

    public static function recuperar(Router $router){
        
    }

    public static function crear(Router $router){
        
        $router->render('auth/crear-cuenta', [

        ]);
    }
}

?>