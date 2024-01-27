<?php
require('parciales/header.php');
?>
<div class="login-">
    <h1>Estas en <?php echo $title ?></h1>
    <form action="index.php?page=login" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" required>
        <input type="submit" value="Iniciar sesión">
    </form>
    <a class="ancla" href="<?= BASE_URL ?>index.php?page=inicio">Volver al inicio</a>
    <a class="ancla" href="<?= BASE_URL ?>index.php?page=registro">Registrarse</a>
</div>

<?php
require('parciales/footer.php');
?>