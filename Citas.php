<?php
session_start();
include 'conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: iniciodesesion.php");
    exit();
}

// Guardar la cita en la base de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $direccion = $_POST['direccion'];
    $numero_casa = $_POST['num_casa'];
    $municipio = $_POST['municipio'];
    $id_servicio = $_POST['tipo_servicio'];
    $id_usuario = $_SESSION['id_usuario']; // ID del usuario logueado

    // Agregar un empleado por defecto (cambiar según tus datos)
    $id_empleado = 1;

    // Insertar la cita en la base de datos
    $sql = "INSERT INTO cita (fecha, hora, direccion, numero_casa, municipio, id_usuario, id_servicio, id_empleado) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssiiii", $fecha, $hora, $direccion, $numero_casa, $municipio, $id_usuario, $id_servicio, $id_empleado);

    if ($stmt->execute()) {
        $mensaje = "Cita guardada correctamente.";
    } else {
        $error = "Error al guardar la cita: " . $conexion->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Citas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-3">
  <h3 class="text-center">Agendar Cita</h3>
  <?php if (isset($mensaje)): ?>
    <div class="alert alert-success"><?php echo $mensaje; ?></div>
  <?php elseif (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
  <?php endif; ?>
  <form method="POST" action="">
    <div class="mb-3">
      <label for="fecha" class="form-label">Fecha</label>
      <input type="date" id="fecha" name="fecha" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="hora" class="form-label">Hora</label>
      <input type="time" id="hora" name="hora" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="direccion" class="form-label">Dirección</label>
      <input type="text" id="direccion" name="direccion" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="num_casa" class="form-label">Número de Casa</label>
      <input type="text" id="num_casa" name="num_casa" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="municipio" class="form-label">Municipio</label>
      <input type="text" id="municipio" name="municipio" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="tipo_servicio" class="form-label">Tipo de Servicio</label>
      <select id="tipo_servicio" name="tipo_servicio" class="form-select" required>
        <?php
        $result = $conexion->query("SELECT id_servicio, titulo FROM servicio");
        while ($servicio = $result->fetch_assoc()) {
            echo "<option value='{$servicio['id_servicio']}'>{$servicio['titulo']}</option>";
        }
        ?>
      </select>
    </div>
    <button type="submit" class="btn btn-success">Guardar Cita</button>
  </form>
</div>
</body>
</html>
