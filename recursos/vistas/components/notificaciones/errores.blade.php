<?php

declare(strict_types=1);

?>
@if (session()->get('leaf.flash'))
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      let errores = `{{!! json_encode(flash()->display('errores')) !!}}`
      errores = errores.substring(1, errores.length - 1)
      errores = JSON.parse(errores)

      for (const error of Object.values(errores)) {
        new Noty({
          type: 'error',
          text: `<i class="bx bx-message-error"></i> ${error}`
        }).show()
      }
    })
  </script>
@endif
<?php 
