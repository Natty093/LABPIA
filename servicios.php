<?php
// Incluir conexión a la base de datos
include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantalla de Servicios</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="Inicio.html">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="servicios.php">Servicios</a></li>
                <li class="nav-item"><a class="nav-link" href="Citas.php">Citas</a></li>
                <li class="nav-item"><a class="nav-link" href="comentarios.php">Comentarios</a></li>
                <li class="nav-item"><a class="nav-link" href="nosotros.html">Nosotros</a></li>
                <li class="nav-item"><a class="nav-link" href="contacto.html">Contáctanos</a></li>
            </ul>
            <form class="d-flex" role="button">
                <a class="btn btn-secondary" href="iniciodesesion.php" role="button">Sign up</a>
            </form>
        </div>
    </div>
</nav>
<hr>
    <!-- Contenido -->
    <div class="container py-5">
        <div class="row">
            <?php
            // Consultar servicios desde la base de datos
            $sql = "SELECT * FROM servicio"; // Aquí se usa "servicio" en singular
            $result = $conexion->query($sql); // Usamos $conexion en lugar de $conn

            // Mostrar los servicios
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '<div class="card h-100 shadow-sm">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . htmlspecialchars($row['titulo']) . '</h5>';
                    echo '<h6 class="card-subtitle mb-2 text-muted">$' . htmlspecialchars($row['precio']) . '</h6>';
                    echo '<p class="card-text">' . htmlspecialchars($row['descripcion']) . '</p>';
                    echo '<a href="#" class="btn btn-primary">Reservar cita</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-center">No hay servicios disponibles en este momento.</p>';
            }

            // Cerrar conexión
            $conexion->close();
            ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
