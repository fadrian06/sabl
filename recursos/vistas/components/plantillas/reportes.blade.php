<?php

declare(strict_types=1);

?>
<!DOCTYPE html>
<html>
  <x-head titulo="{{ $titulo }}" />
  <body>
    {{ $slot }}
    <x-javascripts />
    <x-notificaciones.errores />
  </body>

</html>
<?php 
