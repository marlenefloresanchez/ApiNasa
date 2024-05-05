<?php
// Configura la cabecera para indicar que vamos a devolver JSON
header("Content-Type: application/json");

// Tu clave API de la NASA
$api_key = "FWVOzvbUwOf5VkP3kchsnu8sDlIfOPTvyvPsrKJO";

// URL para la solicitud (en este caso, la imagen del día)
$url = "https://api.nasa.gov/planetary/apod?api_key={$api_key}";

// Configurar cURL para hacer la solicitud HTTP
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

// Realizar la solicitud
$response = curl_exec($ch);

// Verificar errores de cURL
if ($response === false) {
    echo json_encode([
        "error" => "Error al obtener datos de la API",
        "details" => curl_error($ch)
    ]);
    curl_close($ch);
    exit;
}

curl_close($ch);

// Decodificar la respuesta JSON
$json_response = json_decode($response, true);

// Verificar errores de JSON
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode([
        "error" => "Error al decodificar JSON",
        "details" => json_last_error_msg()
    ]);
    exit;
}

// Devolver la respuesta JSON al cliente
echo json_encode($json_response);
?>
