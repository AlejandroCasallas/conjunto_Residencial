<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ERROR 404 - Sistema Corrupto</title>
    <style>
        body {
            background-color: black;
            color: #00ff00;
            font-family: 'Courier New', monospace;
            text-align: center;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        .matrix-404 {
            margin-top: 15vh;
        }
        h1 {
            font-size: 3em;
            animation: glitch 1s infinite;
        }
        p {
            font-size: 1.5em;
        }
        a {
            color: #00ff00;
            text-decoration: none;
            border: 1px solid #00ff00;
            padding: 10px 20px;
            display: inline-block;
            margin-top: 20px;
        }
        a:hover {
            background-color: #00ff00;
            color: black;
        }
        @keyframes glitch {
            0% { text-shadow: 2px 0 0 #ff0000, -2px 0 0 #00ffff; }
            25% { text-shadow: -2px 0 0 #ff0000, 2px 0 0 #00ffff; }
            50% { text-shadow: 2px 0 0 #ff0000, -2px 0 0 #00ffff; }
            75% { text-shadow: -2px 0 0 #ff0000, 2px 0 0 #00ffff; }
            100% { text-shadow: 2px 0 0 #ff0000, -2px 0 0 #00ffff; }
        }
        .code {
            opacity: 0.5;
            font-size: 0.8em;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="matrix-404">
        <h1>ERROR 404</h1>
        <p>¡Has encontrado un fallo en la Matrix!</p>
        <p>La página solicitada no existe o fue eliminada por los agentes.</p>
        <a href="/">Volver al inicio</a>
        <div class="code">
            <p>> System.SecurityException: Access denied.<br>
            > Traceback (most recent call last):<br>
            > File "reality.py", line 404, in get_page<br>
            > raise PageNotFoundError("Red Pill required.")</p>
        </div>
    </div>
</body>
</html>