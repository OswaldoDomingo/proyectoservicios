<?php
require('parciales/header.php');

?>
<div class="inicio">
    <h1>Estas en <?php echo $title ?></h1>
    <ul>
        <li><a href="index.php?page=login">Iniciar sesión</a></li>
        <li><a href="index.php?page=registro">Registrarse</a></li>
        <li><a href="index.php?page=listado">Ver servicios como invitado</a></li>
    </ul>
</div>
<?php
require('parciales/footer.php');
?>