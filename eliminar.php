<?php
include('conexion.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // 1. Primero borramos los registros dependientes en estudiante_materia
    $sql_materia = "DELETE FROM estudiante_materia WHERE idEstudiante = $id";
    $conexion->query($sql_materia);
    
    // 2. Ahora sí podemos eliminar al estudiante sin que MySQL nos bloquee
    $sql_estudiante = "DELETE FROM Estudiante WHERE idEstudiante = $id";
    $conexion->query($sql_estudiante);
}

// Redirigir de vuelta a la pantalla principal
header("Location: index.php");
exit();
?>