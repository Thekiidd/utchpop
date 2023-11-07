<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gracias por tu Feedback</title>
    <style>
        /* Establecer el estilo del cuerpo con un fondo negro y centrar el contenido */
        body {
            margin: 0;
            padding: 0;
            background-color: #000;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            color: white;
        }

        /* Animación para el texto */
        @keyframes pop-up {
            0% {
                transform: translateY(200vh) scale(0.1);
                opacity: 0;
            }
            50% {
                opacity: 2;
            }
            100% {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
        }

        /* Estilo del texto con la animación */
        .thank-you-message {
            font-size: 2em;
            animation: pop-up 3s ease forwards;
        }
    </style>
</head>
<body>
    <div class="thank-you-message">
        Gracias por la retroalimentación!
    </div>
</body>
</html>
