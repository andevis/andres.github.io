    <?php
  


    // Configura la conexión
    $HOST = "localhost"; // Puede ser diferente dependiendo de tu configuración
    $USER = "root";
    $PASSWORD = "";
    $DATABASE = "eyc_proyecto";
    
    // Crear la conexión
$conn = new mysqli($HOST, $USER, $PASSWORD, $DATABASE);
 
// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
} else {
    echo "Conexión exitosa"; 

}
?>