<?php
class Registro
{

    public function registro()
    {
        require_once('model/cModeloSingelton.php');
        
        // Inicializar array de errores
        $errores = [];
        $nombre = '';
        $email = '';
        $password = '';
        $fechaNacimiento = '';
        $fotoPerfil = '';
        $descripcion = '';
        $idioma = '';
        $seleccionIdiomas = [];

        // Se incluye el modelo de la base de datos que se va a utilizar.
        $modelo = ModeloSingelton::getInstance();

        // Obtener los idiomas y pasarlos al controlador Registro
        $modelo->obtenerIdiomas();
        
        //controller/cLogin.php
        $title = Config::$title = 'Registro';

        //Agrega esto para depurar
        // echo "<pre>";
        // print_r($idiomas);
        // echo "</pre>";




        // Verificar si el formulario ha sido enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnRegistro'])) {
            // Sanitización y validación
            $nombre = recoge("nombre");
            $email = recoge("email");
            $password = recoge("password");
            $fechaNacimiento = recoge("fechaNacimiento");
            $fotoPerfil = recoge("fotoPerfil");
            $descripcion = recoge("descripcion");
            $idioma = recoge("idioma");


            // Validaciones
            // Validación del nombre
            // La función cTexto comprueba si el nombre cumple con las condiciones especificadas
            // Argumentos:
            // - $nombre: el valor recogido del formulario para el campo 'nombre'
            // - 'nombre': la clave que usaremos en el array de errores
            // - $errores: el array donde se almacenarán los mensajes de error
            // - 30: longitud máxima permitida para el nombre
            // - 1: longitud mínima permitida para el nombre
            // - true: indica si se permiten espacios en blanco en el nombre
            // - true: indica si la validación es case-insensitive (no distingue entre mayúsculas y minúsculas)
            if (!cTexto($nombre, 'nombre', $errores, 30, 1, true, true)) {
                // Si la validación falla, añadimos un mensaje de error al array de errores
                $errores['nombre'] = "El nombre no es válido. Debe tener entre 1 y 30 caracteres y solo puede contener letras y espacios.";
            }

            // Validación del email
            // Utilizamos filter_var con el filtro FILTER_VALIDATE_EMAIL
            // para comprobar si el email es válido
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Si el email no es válido, añadimos un mensaje de error al array de errores
                $errores['email'] = "El email no es válido.";
            }

            // Validación de la fecha de nacimiento
            // La función unixFechaAAAAMMDD verifica si la fecha está en el formato correcto (AAAA-MM-DD)
            // y si es una fecha válida. Además, convierte la fecha a un timestamp Unix.
            // - $fechaNacimiento: valor recogido del formulario
            // - 'f_nacimiento': nombre del campo en la base de datos
            // - $errores: array donde se almacenarán los mensajes de error
            if (!unixFechaAAAAMMDD($fechaNacimiento, 'f_nacimiento', $errores)) {
                // Si la validación falla, añadimos un mensaje de error al array de errores
                $errores['f_nacimiento'] = "La fecha de nacimiento no es válida o no está en el formato correcto (AAAA-MM-DD).";
            }

            // Validación de la contraseña
            // Aquí validamos que la longitud de la contraseña sea adecuada.
            // Podemos añadir más reglas según las necesidades de seguridad, como verificar la presencia
            // de números, mayúsculas, minúsculas, caracteres especiales, etc.
            if (strlen($password) < 6) {
                // Si la contraseña es demasiado corta, añadimos un mensaje de error al array de errores
                $errores['pass'] = "La contraseña debe tener al menos 6 caracteres.";
            }

            // Además, podemos hashear la contraseña antes de guardarla en la base de datos
            // Esto se hace normalmente justo antes de insertar la contraseña en la base de datos
            // y no en esta parte del código de validación.

            // Definir las extensiones de archivo válidas y el tamaño máximo para la foto de perfil
            $extensionesValidas = ['jpg', 'png']; // Solo se permiten archivos JPG y PNG
            $maxFileSize = 5 * 1048576; // 5 MB en bytes

            $directorioSubidas = __DIR__ . '/../public/img/usuarios/';

            // Validar la foto de perfil
            // Se llama a la función cFile con los siguientes parámetros:
            // - 'fotoPerfil': el nombre del campo del archivo en el formulario
            // - $errores: la referencia al array de errores donde se almacenarán los mensajes de error
            // - $extensionesValidas: las extensiones de archivo permitidas
            // - 'ruta/a/tu/directorio/de/subida': la ruta donde se guardará el archivo subido
            // - $maxFileSize: el tamaño máximo del archivo
            if (!cFile('fotoPerfil', $errores, $extensionesValidas, $directorioSubidas, $maxFileSize)) {
                // Si hay un error en la carga del archivo, se añadirá automáticamente al array $errores
                // No es necesario añadir un mensaje de error adicional aquí, ya que cFile se encarga de ello
            }

            // Validación de la descripción
            /*
             Sanitización: La función recoge sanitiza el valor del campo 'descripción', eliminando espacios innecesarios y tags HTML.
             Validación: Se llama a cTexto para validar la descripción. Los parámetros incluyen la longitud máxima y mínima, 
             si se permiten espacios, y si la validación es sensible a mayúsculas.
             Manejo de Errores: Si la validación falla (por ejemplo, si la descripción es demasiado larga, demasiado corta, 
             o contiene caracteres no permitidos), cTexto añade un mensaje de error al array $errores.
             */

            // Parámetros para la función cTexto
            $maxLongitud = 300; // Longitud máxima permitida
            $minLongitud = 10;  // Longitud mínima permitida
            $permitirEspacios = true;
            $caseSensitive = false; // No sensible a mayúsculas

            // Llamada a cTexto para validar la descripción
            if (!cTexto($descripcion, 'descripción', $errores, $maxLongitud, $minLongitud, $permitirEspacios, $caseSensitive)) {
                // Si la validación falla, un mensaje de error se añade a $errores
                // El mensaje específico ya es manejado dentro de la función cTexto
            }

            // En este punto, si $errores está vacío, la descripción ha pasado la validación.
            // Si hay errores, se deben mostrar al usuario.
            //$seleccionIdiomas =[]; // Array para almacenar los idiomas seleccionados
            // Valida las selecciones de idiomas
            // 'cCheck' comprueba si los valores seleccionados están en los idiomas disponibles

            if (!cCheck($seleccionIdiomas, 'idiomas', $errores, array_column($modelo->obtenerIdiomas(), 'id_idioma'))) {
                foreach ($errores as $error) {
                    echo "<p>Error: $error</p>";
                }
            } else {
                echo "<p>Selección de idiomas guardada correctamente.</p>";
            }
        }




        if (count($errores) == 0) {
            // No hay errores en la validación, podemos proceder con el registro
            // Hashear la contraseña
            $passwordHash = hashPassword($password);

            // Todos los datos son válidos, proceder con el registro
            $modelo = ModeloSingelton::getInstance();
            //llama al método obtenerIdiomas() para obtener los idiomas disponibles desde la base de datos.
            $idiomasDisponibles = $modelo->obtenerIdiomas();

            $resultado = $modelo->registrarUsuario($nombre, $email, $passwordHash, $fechaNacimiento, $fotoPerfil, $descripcion, $idioma);

            if ($resultado) {
                // Registro exitoso
                $mensajeExito = "Usuario registrado con éxito.";
            } else {
                // Error en el registro
                $mensajeError = "Error al registrar el usuario.";
            }
        } else {
            // Hay errores en la validación$idiomasDisponibles = []; // Array para almacenar los idiomas disponibles

            $mensajeError = "Se encontraron errores en el formulario.";
        }


        // Pasar errores y mensajes a la vista
        require_once('view/vRegistro.php');
    }
}
