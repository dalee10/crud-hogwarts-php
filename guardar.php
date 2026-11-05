<?php
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idEstudiante = $_POST['idEstudiante']; // Vendrá con número si estamos editando
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];
    $anio_cursado = $_POST['anio_cursado'];
    $idCasa = $_POST['idCasa'];

    if (!empty($idEstudiante)) {
        // Si hay un ID, actualizamos el registro existente (EDITAR)
        $sql = "UPDATE Estudiante 
                SET nombre='$nombre', apellido='$apellido', edad='$edad', anio_cursado='$anio_cursado', idCasa='$idCasa' 
                WHERE idEstudiante=$idEstudiante";
    } else {
        // Si no hay ID, creamos un registro nuevo (GUARDAR)
        $sql = "INSERT INTO Estudiante (nombre, apellido, edad, anio_cursado, idCasa) 
                VALUES ('$nombre', '$apellido', '$edad', '$anio_cursado', '$idCasa')";
    }

    if ($conexion->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al guardar: " . $conexion->error;
    }
}
?>