<?php
require('parciales/header.php');
?>
<h1>Listado de servicios</h1>
<br>
<?php if (!empty($servicios) && is_array($servicios)) : ?>
    <?php foreach ($servicios as $servicio) : ?>
        <div>
            <h2><?php echo htmlspecialchars($servicio['titulo']); ?></h2>
            <p><?php echo htmlspecialchars($servicio['descripcion']); ?></p>
            <p>Precio: <?php echo htmlspecialchars($servicio['precio']); ?></p>
            
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <p>No hay servicios disponibles.</p>
    <a class="ancla" href="<?= BASE_URL ?>index.php?page=inicio">Volver al inicio</a>
<?php endif; ?>
<?php
require('parciales/footer.php');
?>