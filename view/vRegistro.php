<?php
require('parciales/header.php');
?>
<div class="login-">
    <h1>Estas en <?php echo $title ?></h1>
    <form action="index.php?page=registro" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre completo</label>
        <!-- <input type="text" name="nombre" id="nombre" required placeholder="Tu nombre"> -->
        <input type="text" name="nombre" id="nombre" required placeholder="Tu nombre" value="Oswaldo">

        <label for="email">Email</label>
        <!-- <input type="email" name="email" id="email" required placeholder="miCorreo@correo.es"> -->
        <input type="email" name="email" id="email" required placeholder="miCorreo@correo.es" value="miCorreo@correo.es" require>

        <label for="password">Contraseña</label>
        <!-- <input type="password" name="password" id="password" required placeholder="Contraseña requerida"> -->
        <input type="password" value="123456789" name="password" id="password" required placeholder="Contraseña requerida">

        <label for="fechaNacimiento">Fecha de nacimiento</label>
        <input type="date" name="fechaNacimiento" id="fechaNacimiento" value="1963-08-27" required>

        <label for="fotoPerfil">Foto perfil</label>
        <input type="file" name="fotoPerfil" id="fotoPerfil">

        <label for="idioma">Idiomas</label>
        <?php if (isset($idiomas) && is_array($idiomas)) : ?>
            <label for="idioma">Idiomas</label>
            <?php foreach ($idiomas as $idioma) : ?>
                <input type="checkbox" name="idiomas[]" value="<?= $idioma['id_idioma'] ?>" id="idioma_<?= $idioma['id_idioma'] ?>">
                <label for="idioma_<?= $idioma['id_idioma'] ?>"><?= $idioma['idioma'] ?></label><br>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Crear un foreach con los idionmas que incluyamos en un array -->
            <label for="descripcion">Descripción personal</label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="10" placeholder="Escriba algo sobre tí">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis optio voluptas eligendi fugit obcaecati minus.</textarea>
        </textarea>
        <input type="submit" value="Registrarse" name="btnRegistro">
    </form>
    <a class="ancla" href="<?= BASE_URL ?>index.php?page=inicio">Volver al inicio</a>
</div>

<?php
require('parciales/footer.php');
?>