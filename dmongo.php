<?php

// Si usaste Composer, solo necesitas este require
 require 'vendor/autoload.php';

// Si no usaste Composer, coloca aquí la lógica para incluir la librería manualmente.

// 1. Obtener la cadena de conexión de la variable de entorno de App Service
$connectionString = getenv('COSMOSDB_CONNECTION_STRING');

if (!$connectionString) {
    die("Error: La cadena de conexión no está configurada en App Service.");
}

try {
    // Inicializar el cliente de MongoDB
    $client = new MongoDB\Client($connectionString);
    
    // Seleccionar BD y Colección
    $database = $client->selectDatabase("quickstartDB"); 
    $collection = $database->selectCollection("Registro_de_llamadas"); 

    // --- LÓGICA DE TU APLICACIÓN AQUÍ ---
    
    echo "¡Conexión y Operación Exitosas! El App Service PHP está unido a Cosmos DB.";

} catch (Exception $e) {
    echo 'Error al conectar/operar con Cosmos DB: ' . $e->getMessage();
}

?>
