<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Estudiantes - Hogwarts</title>
</head>
<body>
    <h2>Registrar Nuevo Estudiante</h2>
    <form action="guardar.php" method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Apellido:</label><br>
        <input type="text" name="apellido" required><br><br>

        <label>Edad:</label><br>
        <input type="number" name="edad" required><br><br>

        <label>Año Cursado:</label><br>
        <input type="number" name="año_cursado" required><br><br>

        <label>Casa de Hogwarts:</label><br>
        <select name="idCasa" required>
            <option value="1">Gryffindor</option>
            <option value="2">Slytherin</option>
            <option value="3">Ravenclaw</option>
            <option value="4">Hufflepuff</option>
        </select><br><br>

        <button type="submit">Guardar Estudiante</button>
    </form>
</body>
</html>