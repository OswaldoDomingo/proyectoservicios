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
## La idea del proyecto
Tener una entrada index.html desde donse se irán haciendo todas las peticiones al los controladores y desde ahí se cargarán las vistas.