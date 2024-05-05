<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Foto Astronómica del Día - NASA</title>
</head>
<body>
    <h1>Foto Astronómica del Día</h1>
    <?php
    // Código PHP para obtener y mostrar la foto astronómica del día
    // Insertar aquí el código anterior para realizar la solicitud y mostrar los datos
    $apiKey = "FWVOzvbUwOf5VkP3kchsnu8sDlIfOPTvyvPsrKJO"; // Reemplaza con tu propia clave de API
    $apiUrl = "https://api.nasa.gov/planetary/apod?api_key=$apiKey";


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);


    $response = curl_exec($ch);
    $error = curl_error($ch);


    curl_close($ch);


    if ($error) {
        echo "Error: $error";
    } else {
        $apodData = json_decode($response, true);


        if ($apodData && isset($apodData['title'])) {
            echo "Título: " . $apodData['title'] . "<br>";
            echo "Fecha: " . $apodData['date'] . "<br>";
            echo "Explicación: " . $apodData['explanation'] . "<br>";
            echo '<img src="' . $apodData['url'] . '" alt="' . $apodData['title'] . '"><br>';
        } else {
            echo "No se pudo obtener la información de la NASA.";
        }
    }
    ?>
</body>
</html>
