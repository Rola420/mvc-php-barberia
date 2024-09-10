# appsalon-mvc-php
deploy de proyecto mvc-php - Barberia

PARA PODER EJECUTAR LAS PETICIONES A LA BD ES NECESARIO CREAR EL .env EN TU PROYECTO.

EL.env debera estar en la ruta "Barberia/" y el archivo debe contener lo siguiente:

DB_HOST = localhost:3307 //Ajusta este puerto segun tu configuracion en mysql
DB_USER = root
DB_PASS = 
DB_NAME = barberia

//AQUI VAN TUS CREDENCIALES DE mailtrap.io por lo que deberas tener una cuenta para lograr obtener dichas credenciales
EMAIL_HOST = 
EMAIL_PORT = 
EMAIL_USER = 
EMAIL_PASSWORD = 

//En la terminal del proyecto deberas ejecutar el comando: php -S localhost:3000 y dar enter para ejecutar el servidor local.
//obtendrás un resultado como el siguiente:

APP_URL = http://localhost:3000


NOTA: deberas contar con XAMPP para correr el programa, phpmyadmin y gestionar la DB y tambien instalar composer para la ejecución del programa.
