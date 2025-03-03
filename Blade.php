<?php

declare(strict_types=1);

use Illuminate\Container\Container as ContainerContainer;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Leaf\Blade as LeafBlade;

require_once __DIR__ . '/vendor/autoload.php';

final class Container extends ContainerContainer
{
  function terminating(): void {}

  function getNamespace(): string
  {
    return '';
  }
}

final readonly class Blade
{
  private static function getInstance(): LeafBlade
  {
    static $blade = null;

    if (!$blade) {
      $container = Container::getInstance();
      $container->bind(ApplicationContract::class, Container::class);
      $container->alias('view', ViewFactory::class);

      $blade = new LeafBlade(
        __DIR__ . '/recursos/vistas',
        __DIR__ . '/almacenamiento/cache',
        $container
      );
    }

    return $blade;
  }

  /** @param array<string, mixed> $datos */
  static function renderizar(string $vista, array $datos = []): void
  {
    echo self::getInstance()->render($vista, $datos);
  }

  static function capitalizar(string $texto): string
  {
    return mb_convert_case($texto, MB_CASE_TITLE);
  }
}
