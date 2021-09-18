<?php
//Conexion a base de datos

/* Operador ternario evita tener que hacer esto cada vez:
 * 
 * if(isset($_POST[nombre])){
 *      $nombre = $_POST[nombre];
 * }else{
 *      $nombre = false;
 */

if(isset($_POST)){
    require_once '../includes/conexion.php';
    
    if (!isset($_SESSION)){
        session_start();
    }
    //Recogemos los valores del formulario de registro
  $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false; 
  $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
  $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
  $password = isset($_POST['password']) ? mysqli_real_escape_string($db,$_POST['password']) : false;       
  //var_dump($_POST);  


//Array de errores

$errores = array();


//Validar los datos antes de guardarlos

// Validar campo nombre
if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
    $nombre_validado = true;
}else{
    $nombre_validado = false;
    $errores['nombre'] = "El nombre no es válido"; 
}

// Validar campo apellidos

if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
    $apellidos_validado = true;
}else{
    $apellidos_validado = false;
    $errores['apellidos'] = "Los apellidos no son válidos"; 
}

// Validar campo email

if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
    $email_validado = true;
}else{
    $email_validado = false;
    $errores['email'] = "El email no es válido"; 
}

// Validar la contraseña

if (!empty($password)){
    $password_validado = true;
}else{
    $password_validado = false;
    $errores['password'] = "Completar el campo contraseña"; 
}

// Insertar usuarios

$guardar_usuario = false;

if (count($errores) == 0){
    $guardar_usuario = true;
    
    //Cifrar la contraseña
    $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=> 4]);
    //Insertar usuario en la bd
    $sql = "INSERT INTO usuarios VALUES(null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE()); ";
    $guardar = mysqli_query($db, $sql);
    
//    var_dump(mysqli_error($db));
//    die(); /* paro la ejecución */
            if ($guardar){
                $_SESSION['completado'] = "El registro se ha completado con éxito";
            }else{
                $_SESSION['errores'] ['general'] = "Error al insertar usuario!"; 
            }
}else{
        $_SESSION['errores']= $errores;
     }
}

header('Location: ../index.php');

