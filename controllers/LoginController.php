<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;
use UConverter;

class LoginController {
    public static function login(Router $router){
        $alertas = [];
        

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);

            $alertas = $auth->validarLogin();
        }

        $router->render('auth/login', [
            'alertas' => $alertas,
            
        ]);
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
                    $email->enviarConfirmacion();

                    // crear el usuario
                    $resultado = $usuario->guardar();
                    if($resultado){
                        header('Location: /mensaje');
                    }
                }
            }
        }
        
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router) {
        $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router) {
        $alertas = [];

        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);

        if(empty($usuario) || $usuario->token === ''){
            // mostrar mensaje de error
            Usuario::setAlerta('error', 'Token no Válido');
        }else {
            // modificar a usuario confirmado
            $usuario->confirmado = '1';
            $usuario->token = '';
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente');
        }
        //obtener alertas
        $alertas = Usuario::getAlertas();
        // renderizar la vista
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }
}

?>