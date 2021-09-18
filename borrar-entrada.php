<?php  require_once 'includes/helpers.php';  ?>
<?php  require_once 'includes/cabecera.php';  ?>
<?php include_once 'includes/lateral.php';     ?> 

<?php
            $borrar_actual = eliminarEntrada($db, $_GET['id']);
?>            
    <div id="principal"> 
        <?php    
            if($borrar_actual): ?>
                <div class="alerta alerta-exito">
                    La entrada ha sido eliminada correctamente
                </div> 
        <?php
            else:
        ?>
                <div class="alerta-error">
                    La entrada no se ha podido eliminar
                </div>
         <?php 
            endif;
        ?>   
    </div>    
<?php include_once 'includes/pie.php';