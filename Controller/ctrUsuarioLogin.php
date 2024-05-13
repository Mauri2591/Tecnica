<?php
require_once '../Config/Conexion.php';
require_once '../Model/Usuarios.php';

// Inicio controlador para el Login
if(isset($_SERVER) && $_SERVER["REQUEST_METHOD"] == "POST"){
    require_once '../Model/Usuarios.php';
    $email=$_POST['usuario'];
    $pass=$_POST['password'];
    $usuLogin=new Usuario();
    $usuLogin->login_usuario($email,$pass);    
}

