<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Macocci7\PhpMathVector\Vector3d;

$a = new Vector3d(
    initialPoint: [1, 2, 3],    // (x, y, z) = (1, 2, 3)
    components: [3, 4, 5],      // (x, y, z) = (3, 4, 5)
);

$b = new Vector3d(
    initialPoint: [1, 2, 3],    // (x, y, z) = (1, 2, 3)
    components: [5, 4, 3],      // (x, y, z) = (5, 4, 3)
);

var_dump($a->crossProduct($b));
