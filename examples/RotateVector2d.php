<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Macocci7\PhpMathVector\Vector2d;

$a = new Vector2d([1, 2], [3, 4]);
$b = $a->rotate(90.0);
echo sprintf(
    "Vector a[%d, %d] (%0.2f°)\n",
    $a->components()[0],
    $a->components()[1],
    $a->degrees()
);
echo sprintf(
    "Vector b[%d, %d] (%0.2f°)\n",
    $b->components()[0],
    $b->components()[1],
    $b->degrees()
);
