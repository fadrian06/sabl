<?php

declare(strict_types=1);

use SABL\Controladores\ControladorDeCrearCuenta;
use SABL\Controladores\ControladorDeEstudiantes;
use SABL\Controladores\ControladorDeIngreso;
use SABL\Controladores\ControladorDeMaterias;
use SABL\Controladores\ControladorDeNiveles;
use SABL\Controladores\ControladorDePerfil;
use SABL\Controladores\ControladorDePeriodos;
use SABL\Controladores\ControladorDeProfesores;
use SABL\Controladores\ControladorDeReportes;
use SABL\Controladores\ControladorDeRepresentantes;
use SABL\Controladores\ControladorDeUsuarios;
use SABL\Modelos\Plantel;

app()->group('/api', static function (): void {
  app()->get('/planteles', static function (): void {
    response()->json(Plantel::all());
  });
});

app()->group('/ingreso', ['middleware' => 'auth.guest', static function (): void {
  app()->get('/', ControladorDeIngreso::mostrarIngreso(...));
  app()->post('/', ControladorDeIngreso::comprobarCredenciales(...));
}]);

app()->group('/crear-cuenta', ['middleware' => 'admin.only-one', static function (): void {
  app()->get('/', ControladorDeCrearCuenta::mostrarFormulario(...));
  app()->post('/', ControladorDeCrearCuenta::guardarCuentaDeAdministrador(...));
}]);

app()->group('/', ['middleware' => 'auth.required', static function (): void {
  app()->get('/', static fn() => Blade::renderizar('paginas.inicio'));

  app()->get('/salir', static function (): void {
    auth()->logout();
    response()->redirect('/ingreso');
  });

  app()->get('/respaldar', static function (): void {
    if (mb_strtolower((string) $_ENV['DB_CONNECTION']) === 'mysql') {
      $nombreRespaldo = 'respaldo-' . date('Y-m-d-H-i-s') . '.sql';
      $ruta = __DIR__ . "/almacenamiento/respaldos/$nombreRespaldo";

      $sql = `{$_ENV['MYSQLDUMP_PATH']} --user={$_ENV['DB_USERNAME']} --password={$_ENV['DB_PASSWORD']} --host={$_ENV['DB_HOST']} {$_ENV['DB_DATABASE']}`;
      file_put_contents($ruta, $sql);
      response()->download($ruta, $nombreRespaldo);
    }
  });

  app()->group('/restaurar', static function (): void {
    app()->get('/', static function (): void {
      if (mb_strtolower((string) $_ENV['DB_CONNECTION']) === 'mysql') {
        Blade::renderizar('paginas.respaldar.mysql', [
          'rutasArchivos' => glob(__DIR__ . '/almacenamiento/respaldos/*.sql')
        ]);
      }
    });

    app()->post('/', static function (): void {
      $respaldo = request()->files('respaldo');

      if ($respaldo !== null) {
        $nombreArchivo = $respaldo['name'];
        $ruta = __DIR__ . "/almacenamiento/respaldos/$nombreArchivo";

        move_uploaded_file($respaldo['tmp_name'], $ruta);
        response()->redirect("/restaurar/$nombreArchivo");
      }
    });

    app()->get('/{nombreArchivo}', static function (string $nombreArchivo): void {
      $ruta = __DIR__ . "/almacenamiento/respaldos/$nombreArchivo";

      if (file_exists($ruta)) {
        $sql = file_get_contents($ruta);
        $comandos = explode(';', $sql);

        foreach ($comandos as $comando) {
          if (trim($comando) !== '') {
            db()->query($comando);
          }
        }
      }

      response()->redirect('/restaurar');
    });
  });

  app()->get('/respaldos/{nombreArchivo}/eliminar', static function (string $nombreArchivo): void {
    $ruta = __DIR__ . "/almacenamiento/respaldos/$nombreArchivo";

    if (file_exists($ruta)) {
      unlink($ruta);
    }

    response()->redirect('/restaurar');
  });

  app()->group('/reportes', static function (): void {
    app()->group('/constancia-estudio', static function (): void {
      app()->get('/', ControladorDeReportes::mostrarFormularioDeConstanciaDeEstudio(...));
      app()->post('/', ControladorDeReportes::generarConstanciaDeEstudio(...));
    });

    app()->group('/notas-certificadas', static function (): void {
      app()->get('/', ControladorDeReportes::mostrarFormularioDeNotasCertificadas(...));
      app()->post('/', ControladorDeReportes::generarNotasCertificadas(...));
    });
  });

  app()->group('/', ['middleware' => 'only-admins', static function (): void {
    app()->group('/usuarios', static function (): void {
      app()->get('/', ControladorDeUsuarios::mostrarSecretarios(...));
      app()->post('/', ControladorDeUsuarios::registrarSecretario(...));
      app()->get('/registrar', ControladorDeUsuarios::mostrarFormularioDeRegistro(...));
      app()->group('/{id}', static function (): void {
        app()->get('/eliminar', ControladorDeUsuarios::eliminarSecretario(...));
        app()->get('/editar', ControladorDeUsuarios::mostrarFormularioDeEdicion(...));
        app()->post('/', ControladorDeUsuarios::actualizarSecretario(...));
      });
    });
  }]);

  app()->group('/estudiantes', static function (): void {
    app()->get('/', ControladorDeEstudiantes::mostrarListado(...));
    app()->post('/', ControladorDeEstudiantes::registrar(...));
    app()->get('/registrar', ControladorDeEstudiantes::mostrarFormularioDeRegistro(...));
    app()->group('/{id}', static function (): void {
      app()->get('/eliminar', ControladorDeEstudiantes::eliminar(...));
      app()->get('/editar', ControladorDeEstudiantes::mostrarFormularioDeEdicion(...));
      app()->post('/', ControladorDeEstudiantes::actualizar(...));
    });
  });

  app()->group('/representantes', static function (): void {
    app()->get('/', ControladorDeRepresentantes::mostrarListado(...));
    app()->post('/', ControladorDeRepresentantes::registrar(...));
    app()->get('/registrar', ControladorDeRepresentantes::mostrarFormularioDeRegistro(...));
    app()->group('/{id}', static function (): void {
      app()->get('/eliminar', ControladorDeRepresentantes::eliminar(...));
      app()->get('/editar', ControladorDeRepresentantes::mostrarFormularioDeEdicion(...));
      app()->post('/', ControladorDeRepresentantes::actualizar(...));
    });
  });

  app()->group('/niveles', static function (): void {
    app()->get('/', ControladorDeNiveles::mostrarListado(...));
    app()->post('/', ControladorDeNiveles::registrar(...));
    app()->get('/aperturar', ControladorDeNiveles::mostrarFormularioDeRegistro(...));
    app()->group('/{id}', static function (): void {
      app()->get('/eliminar', ControladorDeNiveles::eliminar(...));
      app()->get('/editar', ControladorDeNiveles::mostrarFormularioDeEdicion(...));
      app()->post('/', ControladorDeNiveles::actualizar(...));
      app()->group('/secciones', static function (): void {
        app()->get('/aperturar', ControladorDeNiveles::mostrarFormularioDeRegistroDeSeccion(...));
        app()->post('/', ControladorDeNiveles::registrarSeccion(...));
      });
    });
  });

  app()->group('/secciones/{id}', static function (): void {
    app()->get('/editar', ControladorDeNiveles::mostrarFormularioDeEdicionDeSeccion(...));
    app()->post('/', ControladorDeNiveles::actualizarSeccion(...));
    app()->get('/eliminar', ControladorDeNiveles::eliminarSeccion(...));
  });

  app()->group('/profesores', static function (): void {
    app()->get('/', ControladorDeProfesores::mostrarListado(...));
    app()->post('/', ControladorDeProfesores::registrar(...));
    app()->get('/registrar', ControladorDeProfesores::mostrarFormularioDeRegistro(...));
    app()->group('/{id}', static function (): void {
      app()->get('/eliminar', ControladorDeProfesores::eliminar(...));
      app()->get('/editar', ControladorDeProfesores::mostrarFormularioDeEdicion(...));
      app()->post('/', ControladorDeProfesores::actualizar(...));
    });
  });

  app()->group('/periodos', static function (): void {
    app()->get('/', ControladorDePeriodos::mostrarListado(...));
    app()->post('/', ControladorDePeriodos::registrar(...));
    app()->get('/aperturar', ControladorDePeriodos::mostrarFormularioDeRegistro(...));
    app()->group('/{id}', static function (): void {
      app()->get('/eliminar', ControladorDePeriodos::eliminar(...));
      app()->get('/editar', ControladorDePeriodos::mostrarFormularioDeEdicion(...));
      app()->post('/', ControladorDePeriodos::actualizar(...));
    });
  });

  app()->group('/materias', static function (): void {
    app()->get('/', ControladorDeMaterias::mostrarListado(...));
    app()->post('/', ControladorDeMaterias::registrar(...));
    app()->get('/aperturar', ControladorDeMaterias::mostrarFormularioDeRegistro(...));
    app()->group('/{id}', static function (): void {
      app()->get('/eliminar', ControladorDeMaterias::eliminar(...));
      app()->get('/editar', ControladorDeMaterias::mostrarFormularioDeEdicion(...));
      app()->post('/', ControladorDeMaterias::actualizar(...));
    });
  });

  app()->group('/perfil', static function (): void {
    app()->get('/editar', ControladorDePerfil::mostrarFormularioDeEdicion(...));
    app()->post('/', ControladorDePerfil::actualizarPerfil(...));
  });
}]);
