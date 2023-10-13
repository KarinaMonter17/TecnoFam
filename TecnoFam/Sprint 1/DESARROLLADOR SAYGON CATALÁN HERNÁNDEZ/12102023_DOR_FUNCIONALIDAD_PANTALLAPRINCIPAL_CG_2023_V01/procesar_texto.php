<?php
// Verificar si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el texto ingresado por el usuario
    $nuevoTexto = $_POST["nuevoTexto"];
    $section = $_POST["section"]; // Obtén la sección desde el campo oculto

    // Realizar la validación del texto (puedes personalizar esto)
    if (preg_match('/^[A-Za-z0-9\s', $nuevoTexto)) {
        // El texto es válido, ahora puedes agregarlo a la página
        // Suponiendo que "mission" y "vision" son las únicas secciones posibles
        if ($section === "mission") {
            // Actualiza la sección de Misión
            echo '<h2>Misión</h2><p>' . htmlspecialchars($nuevoTexto) . '</p>';
        } elseif ($section === "vision") {
            // Actualiza la sección de Visión
            echo '<h2>Visión</h2><p>' . htmlspecialchars($nuevoTexto) . '</p>';
        }
    } else {
        echo "El texto contiene caracteres no permitidos.";
    }
}
?>
