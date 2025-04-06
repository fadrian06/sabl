<?php

declare(strict_types=1);

use Illuminate\Database\Capsule\Manager;
use Jenssegers\Date\Date;
use Leaf\Auth;
use Symfony\Component\Dotenv\Dotenv;

(new Dotenv)->load(__DIR__ . '/.env');
$_ENV['DB_DATABASE'] = str_replace('%s', __DIR__, $_ENV['DB_DATABASE']);

auth()->config('session', true);
auth()->config('messages.loginParamsError', 'Usuario o contraseña incorrecta');
auth()->config('messages.loginPasswordError', auth()->config('messages.loginParamsError'));
auth()->config('timestamps', false);
auth()->config('db.table', 'usuarios');
auth()->config('password.key', 'clave');

date_default_timezone_set($_ENV['TIMEZONE']);
Date::setLocale($_ENV['LOCALE']);

$container = Container::getInstance();
$manager = new Manager;

$manager->addConnection([
  'driver' => $_ENV['DB_CONNECTION'],
  'host' => $_ENV['DB_HOST'] ?? '127.0.0.1',
  'database' => $_ENV['DB_DATABASE'],
  'username' => $_ENV['DB_USERNAME'] ?? 'root',
  'password' => $_ENV['DB_PASSWORD'] ?? ''
]);

$manager->setAsGlobal();
$manager->bootEloquent();
$manager->setContainer($container);
db()->connection($manager->connection()->getPdo());
(new ReflectionProperty(Auth::class, 'db'))->setValue(auth(), db());
