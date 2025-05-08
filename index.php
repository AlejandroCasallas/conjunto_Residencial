<?php
// Definir constantes útiles para la aplicación
define('ROOT_PATH', __DIR__); // Ruta absoluta de la raíz del proyecto

// Obtener la ruta solicitada
$requestUri = $_SERVER['REQUEST_URI'];

// Eliminar el prefijo de la base de reescritura
$basePath = str_replace('/conjunto/', '', dirname($_SERVER['SCRIPT_NAME']));
$basePath = rtrim($basePath, '/') . '/'; // Asegúrate de que hay un solo '/' al final

// Eliminar cualquier cadena de consulta de la URL
$requestUri = explode('?', $requestUri)[0];

// Obtener la ruta relativa
$route = str_replace($basePath, '', $requestUri);
$route = '/' . trim($route, '/'); // Asegúrate de que la ruta comience con un '/'

// Dependiendo de la ruta, incluir el archivo correspondiente
switch ($route) {
    case '/':
        include 'App/Views/home.php';
        break;
    case '/apartamentos':
        include 'App/Views/apartamentos.php';
        break;

    // funciones tipo API
    case '/getApartaments':
        include 'App/Controllers/apartment-controller.php';
        getApartments();
        break;
    case '/postApartments':
        include 'App/Controllers/apartment-controller.php';
        postApartments();
        break;

    case '/deleteApartment':
        include 'App/Controllers/apartment-controller.php';
        deleteApartment();
        break;

    default:
        http_response_code(404);
        include 'App/Views/404.php';
        break;
}
?>