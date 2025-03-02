<!DOCTYPE html>
<html>
  <x-head titulo="{{ $titulo }}" />
  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
      <x-menu-superior />
      <x-menu-lateral />
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">{{ $titulo }}</h1>
              </div>
            </div>
          </div>
        </div>

        <section class="content">
          {{ $slot }}
        </section>
      </div>
    </div>
    <x-javascripts />
    <x-notificaciones.errores />
  </body>

</html>
