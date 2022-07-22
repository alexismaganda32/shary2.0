Fecha: 1 febrero 2021

## CONFIGURACIONES

1. composer install
2. copiar archivo ".env-example" y crear un archivo nuevo con el nombre de ".env"
	2.1. crear una base de datos
	2.2. configurar archivo ".env" con información de tu base de datos y los datos de correo electrónico
3. php artisan key:generate
4. php artisan migrate:fresh --seed
5. php artisan serve

## NOTAS
- Cuando se elimina algun registro, tomar en cuenta que tambien se eliminan todas sus dependencias.
- Las configuraciónes de email por defecto se encuentran en /resources/views/vendor/ ahí se encuentran las plantillas.

## FRAMEWORKS
- Laravel 6.*
- Log Activities - laravel-activitylog v3 - https://docs.spatie.be/laravel-activitylog/v3/introduction/
