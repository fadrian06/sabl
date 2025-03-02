<?php

declare(strict_types=1);

form()->message([
  'required' => '{Field} es un campo requerido',
  'email' => '{Field} must be a valid email address',
  'alpha' => '{Field} must contain only alphabets and spaces',
  'text' => '{Field} must contain only alphabets and spaces',
  'string' => '{Field} must contain only alphabets and spaces',
  'textonly' => '{Field} must contain only alphabets',
  'alphanum' => '{Field} must contain only alphabets and numbers',
  'alphadash' => '{Field} must contain only alphabets, numbers, dashes and underscores',
  'username' => '{Field} debe contener solo letras, números y guiones',
  'number' => '{Field} must contain only numbers',
  'numeric' => '{Field} must be numeric',
  'float' => '{Field} must contain only floating point numbers',
  'hardfloat' => '{Field} must contain only floating point numbers',
  'date' => '{Field} must be a valid date',
  'min' => '{Field} must be at least %s characters long',
  'max' => '{Field} must not exceed %s characters',
  'between' => '{Field} must be between %s and %s characters long',
  'match' => '{Field} must match the %s field',
  'matchesvalueof' => '{Field} must match the value of %s',
  'contains' => '{Field} must contain %s',
  'boolean' => '{Field} must be a boolean',
  'truefalse' => '{Field} must be a boolean',
  'in' => '{Field} must be one of the following: %s',
  'notin' => '{Field} must not be one of the following: %s',
  'ip' => '{Field} must be a valid IP address',
  'ipv4' => '{Field} must be a valid IPv4 address',
  'ipv6' => '{Field} must be a valid IPv6 address',
  'url' => '{Field} must be a valid URL',
  'domain' => '{Field} must be a valid domain',
  'creditcard' => '{Field} must be a valid credit card number',
  'phone' => '{Field} must be a valid phone number',
  'uuid' => '{Field} must be a valid UUID',
  'slug' => '{Field} must be a valid slug',
  'json' => '{Field} must be a valid JSON string',
  'regex' => '{Field} must match the pattern %s',
  'array' => '{field} must be an array',
]);

form()->addRule(
  'password',
  '/^(?=.*\d)(?=.*[A-ZÑ])(?=.*[a-zñ])(?=.*\W).{8,}$/',
  '{Field} debe contener al menos una letra mayúscula, una minúscula, un número y un carácter especial'
);

form()->rule(
  'names',
  '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]{3,}$/',
  '{Field} debe contener solo letras y espacios'
);

form()->rule(
  'nationality',
  '/^(venezolano|extranjero)$/',
  '{Field} debe ser "venezolano" o "extranjero"'
);

form()->rule(
  'address',
  '/^[a-zA-Z0-9-_ñÑáéíóúÁÉÍÓÚ\s,]+$/',
  '{Field} debe ser una dirección válida, sólo letras, números y símbolos (, - _)'
);

form()->rule(
  'description',
  '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/',
  '{Field} debe contener solo letras y espacios'
);
