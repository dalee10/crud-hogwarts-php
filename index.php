<?php
include('conexion.php');

// Lógica para cargar datos si se presiona el botón "Editar"
$estudiante_edit = null;
if (isset($_GET['edit'])) {$id_edit = intval($_GET['edit']);$sql_edit = "SELECT * FROM Estudiante WHERE idEstudiante = $id_edit";
    $res_edit = $conexion->query($sql_edit);
    if ($res_edit &&$res_edit->num_rows > 0) {
        $estudiante_edit =$res_edit->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directorio Hogwarts</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #1a1a2e; color: #fff; display: flex; height: 100vh; overflow: hidden; }

        /* Contenedor Izquierdo (Formulario) */
        .form-section { width: 35%; padding: 40px; background-color: #16213e; display: flex; flex-direction: column; justify-content: center; box-shadow: 5px 0 15px rgba(0,0,0,0.5); z-index: 10; }
        .form-section h1 { color: #e94560; margin-bottom: 30px; font-size: 26px; text-transform: uppercase; letter-spacing: 1px; }
        .input-group { margin-bottom: 20px; }
        .input-group label { display: block; margin-bottom: 8px; color: #a5a5b0; font-size: 14px; }
        input, select { width: 100%; padding: 12px; border: 1px solid #0f3460; border-radius: 8px; background: #1a1a2e; color: #fff; font-size: 15px; outline: none; transition: 0.3s;}
        input:focus, select:focus { border-color: #e94560; box-shadow: 0 0 8px rgba(233, 69, 96, 0.4); }
        .btn-submit { background-color: #e94560; color: white; border: none; padding: 15px; border-radius: 8px; font-weight: bold; width: 100%; cursor: pointer; transition: 0.3s; margin-top: 10px; font-size: 15px;}
        .btn-submit:hover { background-color: #d13d56; }
        .btn-cancel { display: block; text-align: center; color: #a5a5b0; text-decoration: none; margin-top: 15px; font-size: 14px; transition: 0.3s;}
        .btn-cancel:hover { color: #fff; }

        /* Contenedor Derecho (Lista Vertical) */
        .list-section { width: 65%; padding: 40px 60px; overflow-y: auto; background-color: #0f3460; }
        .list-section h2 { margin-bottom: 25px; color: #fff; font-size: 24px; border-bottom: 2px solid #e94560; padding-bottom: 10px; display: inline-block; }
        
        /* Tarjetas de Estudiantes */
        .student-card { background: #16213e; padding: 20px; border-radius: 10px; margin-bottom: 15px; display: flex; justify-content: space-between; align-items: center; border-left: 5px solid #e94560; transition: transform 0.2s; }
        .student-card:hover { transform: translateX(5px); }
        .student-info h3 { margin-bottom: 5px; color: #fff; font-size: 18px;}
        .student-info p { color: #a5a5b0; font-size: 14px; margin-bottom: 8px; }
        .badge { background: #e94560; color: #fff; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: bold; }
        .actions { display: flex; gap: 8px; }
        .actions a { text-decoration: none; padding: 8px 15px; border-radius: 6px; font-size: 13px; font-weight: bold; text-align: center; }
        .btn-edit { background-color: #f39c12; color: white; transition: 0.3s; }
        .btn-edit:hover { background-color: #d68910; }
        .btn-delete { background-color: #c0392b; color: white; transition: 0.3s; }
        .btn-delete:hover { background-color: #a93226; }
    </style>
</head>
<body>

<!-- SECCIÓN IZQUIERDA: FORMULARIO -->
<div class="form-section">
    <h1><?= $estudiante_edit ? 'Editar' : 'Registrar' ?> Estudiante</h1>
    <form action="guardar.php" method="POST">
        <!-- ID Oculto para enviarlo a guardar.php si estamos editando -->
        <input type="hidden" name="idEstudiante" value="<?= $estudiante_edit ? $estudiante_edit['idEstudiante'] : '' ?>">

        <div class="input-group">
            <label>Nombres</label>
            <input type="text" name="nombre" value="<?= $estudiante_edit ? htmlspecialchars($estudiante_edit['nombre']) : '' ?>" required>
        </div>
        <div class="input-group">
            <label>Apellidos</label>
            <input type="text" name="apellido" value="<?= $estudiante_edit ? htmlspecialchars($estudiante_edit['apellido']) : '' ?>" required>
        </div>
        <div style="display: flex; gap: 15px;">
            <div class="input-group" style="flex: 1;">
                <label>Edad</label>
                <input type="number" name="edad" value="<?= $estudiante_edit ? $estudiante_edit['edad'] : '' ?>" required>
            </div>
            <div class="input-group" style="flex: 1;">
                <label>Año (1-7)</label>
                <input type="number" name="anio_cursado" min="1" max="7" value="<?= $estudiante_edit ? $estudiante_edit['anio_cursado'] : '' ?>" required>
            </div>
        </div>
        <div class="input-group">
            <label>Casa Mágica</label>
            <select name="idCasa" required>
                <option value="">Selecciona...</option>
                <?php
                $sql_casas = "SELECT * FROM Casa";
                $res_casas = $conexion->query($sql_casas);
                if ($res_casas &&$res_casas->num_rows > 0) {
                    while ($casa =$res_casas->fetch_assoc()) {
                        $selected = ($estudiante_edit && $estudiante_edit['idCasa'] ==$casa['idCasa']) ? 'selected' : '';
                        echo "<option value='" . $casa['idCasa'] . "' $selected>" . htmlspecialchars($casa['nombre_casa']) . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn-submit"><?= $estudiante_edit ? 'Actualizar Datos' : 'Guardar Nuevo' ?></button>
        <?php if ($estudiante_edit): ?>
            <a href="index.php" class="btn-cancel">Cancelar edición</a>
        <?php endif; ?>
    </form>
</div>

<!-- SECCIÓN DERECHA: LISTADO VERTICAL -->
<div class="list-section">
    <h2>Directorio de Alumnos</h2>
    
    <?php
    $sql = "SELECT E.idEstudiante, E.nombre, E.apellido, E.edad, E.anio_cursado, C.nombre_casa 
            FROM Estudiante E 
            INNER JOIN Casa C ON E.idCasa = C.idCasa 
            ORDER BY E.idEstudiante DESC";
    $resultado = $conexion->query($sql);

    if ($resultado &&$resultado->num_rows > 0) {
        while ($row =$resultado->fetch_assoc()) {
            ?>
            <div class="student-card">
                <div class="student-info">
                    <h3><?= htmlspecialchars($row['nombre'] . ' ' .$row['apellido']) ?></h3>
                    <p>Edad: <?= $row['edad'] ?> años &nbsp;|&nbsp; Año Cursado: <?= $row['anio_cursado'] ?>°</p>
                    <span class="badge"><?= htmlspecialchars($row['nombre_casa']) ?></span>
                </div>
                <div class="actions">
                    <a href="index.php?edit=<?= $row['idEstudiante'] ?>" class="btn-edit">Editar</a>
                    <a href="eliminar.php?id=<?= $row['idEstudiante'] ?>" class="btn-delete" onclick="return confirm('¿Seguro que deseas eliminar a <?= htmlspecialchars($row['nombre']) ?>?');">Borrar</a>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p style='color: #a5a5b0;'>No hay estudiantes registrados aún.</p>";
    }
    ?>
</div>

</body>
</html>