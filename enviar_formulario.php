<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener y sanitizar los datos del formulario
    $nombre = sanitizeInput($_POST['nombre']);
    $email = sanitizeInput($_POST['email']);
    $mensaje = sanitizeInput($_POST['mensaje']);

    // Validar los datos
    if (empty($nombre) || empty($email) || empty($mensaje)) {
        echo "Por favor, complete todos los campos del formulario.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, ingrese una dirección de correo electrónico válida.";
        exit;
    }

    // Componer el mensaje de correo
    $to = 'ramirezsteven2016@gmail.com'; // Reemplaza con tu dirección de correo
    $subject = 'Mensaje de contacto';
    $message = "Nombre: $nombre\n\nEmail: $email\n\nMensaje: $mensaje";
    $headers = "From: $email";

    // Enviar el correo
    if (mail($to, $subject, $message, $headers)) {
        echo "Mensaje enviado correctamente";
    } else {
        echo "Error al enviar el mensaje";
    }
}

// Función para sanitizar los datos del formulario
function sanitizeInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>