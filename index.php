<?php

declare(strict_types=1);

@require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/configuraciones.php';
require_once __DIR__ . '/middlewares.php';
require_once __DIR__ . '/validaciones.php';
require_once __DIR__ . '/rutas.php';

app()->run();
