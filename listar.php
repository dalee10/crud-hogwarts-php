<?php
include 'conexion.php';

// Consulta INNER JOIN entre las tablas Estudiante y Casa
$sql = "SELECT Estudiante.idEstudiante, Estudiante.nombre, Estudiante.apellido, 
               Estudiante.edad, Estudiante.año_cursado, Casa.nombre AS nombre_casa 
        FROM Estudiante 
        INNER JOIN Casa ON Estudiante.idCasa = Casa.idCasa";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Estudiantes - Hogwarts</title>
</head>
<body>
    <h2>Estudiantes Registrados</h2>
    <a href="formulario.php">Registrar otro estudiante</a><br><br>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Edad</th>
                <th>Año Cursado</th>
                <th>Casa</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($resultado && $resultado->num_rows > 0): ?>
                <?php while ($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['idEstudiante']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['apellido']; ?></td>
                    <td><?php echo $row['edad']; ?></td>
                    <td><?php echo $row['año_cursado']; ?></td>
                    <td><?php echo $row['nombre_casa']; ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No hay estudiantes registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>