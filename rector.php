<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\StmtsAwareInterface\DeclareStrictTypesRector;

return RectorConfig::configure()
  ->withPaths([
    __DIR__ . '/Controladores',
    __DIR__ . '/modelos',
    __DIR__ . '/recursos/vistas',
    __DIR__ . '/*.php',
  ])
  ->withPhpSets(php82: true)
  ->withPreparedSets(typeDeclarations: true)
  ->withRules([
    DeclareStrictTypesRector::class
  ]);
