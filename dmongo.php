<?php

// 1. CARGA DE DEPENDENCIAS (EL VÍNCULO A LA CARPETA 'vendor/' CREADA POR AZURE)
require 'vendor/autoload.php';

// 2. CONEXIÓN A COSMOS DB
$connectionString = getenv('COSMOSDB_CONNECTION_STRING'); // El nombre que definiste en App Service

if (!$connectionString) {
    die("Error: La cadena de conexión de Cosmos DB no está disponible.");
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
