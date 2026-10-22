# Parche de PHP2Shell para ProyectoFinal

El proyecto usa Laravel y declara compatibilidad con PHP 8.2, pero **no incluye un Dockerfile ni define el runtime del servidor**. El parche requerido corresponde al intérprete PHP, no al paquete `laravel/framework`.

A partir del 21 de octubre de 2026, para remediar CVE-2026-109618 y CVE-2026-109619, ejecuta la aplicación con una rama de PHP soportada y al menos una de estas versiones corregidas:

- PHP 8.2.35
- PHP 8.3.36
- PHP 8.4.27
- PHP 8.5.12

La nueva configuración `.php-version` sugiere PHP 8.2.35 a herramientas de gestión de versiones que reconozcan este archivo, **pero no instala PHP ni garantiza una actualización del servidor**.

## Aplicación y comprobación

1. Identifica dónde se ejecuta el proyecto: hosting compartido, PHP nativo del servidor, contenedor de Laravel Sail o servicio gestionado.
2. Actualiza el intérprete real (PHP-FPM, Apache, CLI y workers) a una versión corregida usando el gestor de paquetes o una imagen oficial compatible; reinicia procesos y colas después.
3. Ejecuta `php -v` en cada entorno y comprueba que PHP-FPM/Apache utiliza la misma versión corregida; `php -v` del host no demuestra la versión del servidor web.
4. Ejecuta `composer check-platform-reqs` y las pruebas disponibles antes de abrir tráfico.
5. Si usas Laravel Sail, revisa y actualiza su imagen PHP de forma independiente.

**No se modificaron dependencias Composer ni la base de datos.** La actualización real del servidor necesita hacerse en el entorno donde esté desplegado.
