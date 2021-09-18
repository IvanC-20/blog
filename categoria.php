<?php  require_once 'includes/helpers.php';  ?>
<?php  require_once 'includes/cabecera.php';  ?>
 

<?php
            $categoria = conseguirCategoria($db, $_GET['id']);
            if(!isset($categoria['id'])){
                header('Location:index.php');
            }
?>


<?php require_once 'includes/lateral.php';    ?>
       
        
<!-- Caja principal -->
<div id="principal">
    
    <h1>Entradas de <?= $categoria['nombre'] ?> </h1>
    <?php $entradas = conseguirEntradas($db, '', $_GET['id']);
          if(!empty($entradas) && mysqli_num_rows($entradas)>= 1): 
                while ($entrada = mysqli_fetch_assoc($entradas)):
    ?>          
        <article class="entrada">
            
            <a href="entrada.php?id=<?= $entrada['id'] ?>">
                <h2> <?= $entrada['titulo']; ?> </h2>
                <span class="fecha"> <?= $entrada['categoria']." | ".$entrada['fecha'];  ?> </span>
                    <p>
                         <?= substr($entrada['descripcion'], 0,180)."..." ?>
                    </p>
            </a>
            
            </article>
    
    
    <?php     
                endwhile;
          else:
    ?>
    </br>
    <div class="alerta" style="text-align: center">No hay entradas en esta categoría!!!</div>
    <?php 
          endif; 
    ?>
 
</div> <!-- Fin principal -->
                
<?php require_once 'includes/pie.php';      



