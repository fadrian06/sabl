@if (session()->get('leaf.flash'))
<script>
  document.addEventListener('DOMContentLoaded', () => {
    let errores = `{{!! json_encode(flash()->display(SABL\Enums\TipoNotificacion::ERROR->name)) !!}}`
    let mensajes = `{{!! json_encode(flash()->display(SABL\Enums\TipoNotificacion::EXITO->name)) !!}}`

    errores = errores.substring(1, errores.length - 1)
    errores = JSON.parse(errores) || {}

    mensajes = mensajes.substring(1, mensajes.length - 1)
    mensajes = JSON.parse(mensajes) || {}

    for (const error of Object.values(errores)) {
      new Noty({
        type: 'error',
        text: `<i class="bx bx-message-error"></i> ${error}`
      }).show()
    }

    for (const mensaje of mensajes) {
      new Noty({
        type: 'success',
        text: `<i class="bx bx-message-success"></i> ${mensaje}`
      }).show()
    }
  })
</script>
@endif
