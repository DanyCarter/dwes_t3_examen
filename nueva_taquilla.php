<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Añadir Nueva Taquilla</title>
</head>
<body>
    <h2>Añadir Nueva Taquilla</h2>
    <form action="nueva_taquilla.php" method="post">
        <label for="localidad">Localidad:</label><br>
        <select id="localidad" name="localidad" required>
            <option value="">Seleccione una localidad</option>
            <option value="Gijón">Gijón</option>
            <option value="Oviedo">Oviedo</option>
            <option value="Avilés">Avilés</option>
        </select><br>
        
        <label for="direccion">Dirección:</label><br>
        <input type="text" id="direccion" name="direccion" required><br>
        
        <label for="capacidad">Capacidad:</label><br>
        <input type="number" id="capacidad" name="capacidad" min="1" required><br>
        
        <label for="ocupadas">Taquillas Ocupadas:</label><br>
        <input type="number" id="ocupadas" name="ocupadas" min="0" required><br>
        
        <input type="submit" value="Añadir Taquilla">
    </form>
</body>
</html>





<?php
require_once 'connection.php';

/* function conectarBD()
{
    $cadena_conexion = 'mysql:dbname=nombre_de_tu_base_de_datos;host=localhost';
    $usuario = 'tu_usuario';
    $clave = 'tu_contraseña';

    try {
        $pdo = new PDO($cadena_conexion, $usuario, $clave);
        return $pdo;
    } catch (PDOException $e) {
        echo 'Error al conectar con la BD: ' . $e->getMessage();
        return null;
    }
} */

 $conexion = conectarBD();
 

/*  $conexion = require_once 'connection.php'; */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //? Verificamos que se ha enviado el formulario

    $localidad = $_POST['localidad'];
    $direccion = $_POST['direccion'];
    $capacidad = $_POST['capacidad'];
    $ocupadas = $_POST['ocupadas'];

    $sql = "INSERT INTO PuntosDeRecogida (localidad, direccion, capacidad, ocupadas) VALUES (:localidad, :direccion, :capacidad, :ocupadas)";

    //? Preparo la consulta.
    $consulta = $conexion->prepare($sql);

    //? Asigno valores
    $consulta->bindParam(':localidad', $localidad);
    $consulta->bindParam(':direccion', $direccion);
    $consulta->bindParam(':capacidad', $capacidad);
    $consulta->bindParam(':ocupadas', $ocupadas);
    

    if ($consulta->execute()) {
        echo "Nueva taquilla añadida con éxito.";
    } else {
        echo "Error al añadir la taquilla.";
    }
}
?>

