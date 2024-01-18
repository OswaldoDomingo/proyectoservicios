# Proyecto MVC servicios para desarrollo web servicios

## Pasos del proyecto MVC
Tener una entrada index.html desde donde se irán haciendo todas las peticiones al los controladores y desde ahí se cargarán las vistas.

## Configuración de VirtualHost
```apache
<VirtualHost *:80>
    ServerAdmin webmaster@proyectoservicios.test
    DocumentRoot "c:/servidor/apache24/htdocs/proyectoservicios"
    ServerName proyectoservicios.test
    ErrorDocument 400 /index.php?page=error
    ErrorDocument 401 /index.php?page=error
    ErrorDocument 403 /index.php?page=error
    ErrorDocument 404 /index.php?page=error
    ErrorDocument 500 /index.php?page=error
    ErrorLog "logs/proyectodaw.test-error.log"
    CustomLog "logs/proyectodaw.test-access.log" common
    <Directory "c:/servidor/apache24/htdocs/proyectoservicios">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
        DirectoryIndex index.php index.html
    </Directory>
</VirtualHost>
```
## Directorio view/parciales
En este directorio dejo las partes de código como header y footer que se repiten en muchas páginas
