<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;

class LoginController {
    public static function login(Router $router){

        $router->render('auth/login');
    }

    public static function logout(Router $router){
        
    }

    public static function olvide(Router $router){

        $router->render('auth/olvide-password', [

        ]);
    }

    public static function recuperar(Router $router){
        
    }

    public static function crear(Router $router){
        $usuario = new Usuario($_POST);

        // Alertas vacias
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->ValidarNuevaCuenta();

            //Revisar que alerta este vacio
            if(empty($alertas)){
                // verificar que el usuario no este registrado 
                $resultado = $usuario->existeUsuario();
                
                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                }else{
                    // Hashear password
                    $usuario->hashPassword();

                    //generar token unico
                    $usuario->crearToken();

                    // enviar el email
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    
                }
            }
        }
        
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
}

?>