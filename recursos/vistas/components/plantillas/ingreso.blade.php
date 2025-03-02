<!doctype html>
<html>

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width">
    <title>{{ $titulo }} - SABL</title>
    <base href="{{ str_replace('index.php', '', $_SERVER['SCRIPT_NAME']) }}" />
    <link rel="icon" href="./imagenes/Admin.jpg" />
    <link rel="stylesheet" href="./dist/ingreso.css" />
    <script src="./dist/ingreso.js"></script>
  </head>

  <body>
    {{ $slot }}

    <x-notificaciones.errores />
  </body>

</html>
