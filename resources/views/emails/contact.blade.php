<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Mensaje de Contacto</title>
</head>
<body>
    <h2>{{ $name }} ha enviado un mensaje</h2>
    <p><strong>Nombre:</strong> {{ $name }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Mensaje:</strong></p>
    <p>{{ $messageContent }}</p>
</body>
</html>
