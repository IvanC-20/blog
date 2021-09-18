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
    
     //Recogemos los valores del formulario de mis-datos.php
  $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false; 
  $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
  $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
         
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


// Actualizar usuarios

$guardar_usuario = false;

if (count($errores) == 0){
    $guardar_usuario = true;
    $usuario = $_SESSION['usuario'];
    
    //Comprobar si el email existe
    $sql = "SELECT id, email FROM usuarios WHERE email = '$email'; ";
    $isset_email = mysqli_query($db, $sql);
    $isset_usuario = mysqli_fetch_assoc($isset_email);
    
    if($isset_usuario['id'] == $usuario['id'] || empty($isset_usuario)){
        
        //Actualizar usuario en la tabla de la bd
        $sql = "UPDATE usuarios SET ".
               "nombre = '$nombre', ".
               "apellidos = '$apellidos', ".
               "email = '$email' ".
               "WHERE id = ".$usuario['id'];

        $guardar = mysqli_query($db, $sql);

        //var_dump(mysqli_error($db));
        //die(); /* paro la ejecución */
                if ($guardar){
                    $_SESSION['usuario']['nombre'] = $nombre;
                    $_SESSION['usuario']['apellidos'] = $apellidos;
                    $_SESSION['usuario']['email'] = $email;
                    $_SESSION['completado'] = "Tus datos se han actualizado con éxito";
                }else{
                    $_SESSION['errores'] ['general'] = "Error al actualizar tus datos!"; 
                }
    }else{
             $_SESSION['errores'] ['general'] = "El usuario ya existe!!!";
    }            
                
}else{
        $_SESSION['errores']= $errores;
}

     
}

header('Location: ../mis-datos.php');

