<?php 
    require_once 'includes/conexion.php';
    require_once 'includes/helpers.php'; 
?>

<!Doctype HTML>

<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Blog de videojuegos</title>
        <link rel="stylesheet" type="text/css" href="./assets/css/estilos.css"/>
    </head>
    
    <body>
        <!-- Cabecera -->
        <header id="cabecera">
            <div id="logo">
                <a href="index.php">
                   Blog de videojuegos                
                </a>
            </div>
        
        
        <!-- Menú -->
        
        <nav id="menu">
            <ul>
                <li>
                    <a href="index.php">Inicio</a>
                </li>
                
                <?php 
                    $categorias = conseguirCategorias($db); 
                    if(!empty($categorias)):
                        while($categoria = mysqli_fetch_assoc($categorias)): 
                ?>
                            <li>
                                <a href="categoria.php?id=<?=$categoria['id']?>" > <?= $categoria['nombre'] ?></a>
                            </li>
                <?php   
                        endwhile; 
                     endif;
                ?>
                
                <li>
                    <a href="index.php">Sobre mí</a>
                </li>
                
                <li>
                    <a href="index.php">Contacto</a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </nav>
        </header>
 <div id="contenedor">        
        
