<h1>hola</h1>
<?php
include_once 'conexion.php';

// Consulta para obtener direcciones desde la base de datos
$sql = "SELECT TRIM(SUBSTRING_INDEX(`DIRECCION`, '(', 1)) as DIRECCION FROM coordenadas ORDER BY DIRECCION ASC";
$result = $conn->query($sql);

// Verificar si se obtuvieron resultados
if ($result) {
    while ($row = $result->fetch_assoc()) {
        // Obtener la dirección de la fila actual
        $direccion = $row["DIRECCION"];

        // Realizar la geocodificación utilizando la API de Google Maps
        $geocode_url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($direccion) . "&key=AIzaSyBpceXYHlvmvjSmUN_0vh5gK4qFkZ6982Y";

        // Manejar la solicitud a la API de Google Maps
        $geocode_data = json_decode(@file_get_contents($geocode_url), true);

        if ($geocode_data && $geocode_data['status'] === 'OK') {

            // Obtener las coordenadas
            $latitud  = $geocode_data['results'][0]['geometry']['location']['lat'];
            $longitud = $geocode_data['results'][0]['geometry']['location']['lng'];


            // Puedes hacer lo que quieras con las coordenadas, por ejemplo, imprimir o almacenar en la base de datos
            echo "Dirección: $direccion - Latitud: $latitud - Longitud: $longitud<br>";
        } else {
            // Manejar errores en la geocodificación          
            $error_message = isset($geocode_data['error_message']) ? $geocode_data['error_message'] : 'Error en la geocodificación';
            echo "$error_message para la dirección: $direccion<br>";
        }
    }
} else {
    // Manejar errores en la consulta SQL
    echo "Error en la consulta SQL: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
