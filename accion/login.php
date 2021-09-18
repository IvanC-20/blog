<?php
// Iniciar la sesión y la conexión a la bd
require_once '../includes/conexion.php';

// Recoger datos del formulario

if(isset($_POST)){
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    // Consulta para comprobar credenciales de usuario
    $sql = "SELECT * FROM usuarios WHERE email = '$email' ";
    $login = mysqli_query($db, $sql);
    
    if ($login && mysqli_num_rows($login) == 1){
        $usuario = mysqli_fetch_assoc($login);
          
    // Comprobar contraseña 
    $verify = password_verify($password, $usuario['password']);
    
            if($verify){
    // Utilizar una sesión para guardar los datos del usuario logueado
                $_SESSION['usuario'] = $usuario;
                if($_SESSION['error_login']){
                    unset($_SESSION['error_login']);
                }
            }else{
    //Si algo falla enviar sesión con el fallo
                $_SESSION['error_login'] = "Login incorrecto!";
            }
    }else{
        $_SESSION['error_login'] = "Login incorrecto!";
    }
    
    
}

// Redirigir al index.php
header('Location: ../index.php');















