<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Macocci7\PhpMathVector\Vector2d;

// Vector a
$a = new Vector2d(
    initialPoint: [1, 2],
    components: [3, 3 * sqrt(3)],
);

// Vector b
$b = new Vector2d(
    initialPoint: [2, 1],
    components: [2 * sqrt(3), 2],
);

// About the vector a
echo "[about the vector a]-------------------" . PHP_EOL;
echo "magnitude of a: " . $a->magnitude() . PHP_EOL;
$u = $a->unitVector()->components();
echo "unit vector of a: components (x, y) = ({$u[0]}, {$u[1]})" . PHP_EOL;
echo "cos of a: " . $a->cos() . PHP_EOL;
echo "angle between a and x-axis: " . $a->degrees() . " degrees" . PHP_EOL;
echo "angle between a and x-axis: " . $a->radian() . " radian" . PHP_EOL;
$t = $a->terminalPoint();
echo "terminal point of a: ({$t[0]}, {$t[1]})" . PHP_EOL;

// About the vector b
echo "[about the vector b]-------------------" . PHP_EOL;
echo "magnitude of b: " . $b->magnitude() . PHP_EOL;
$u = $b->unitVector()->components();
echo "unit vector of b: components (x, y) = ({$u[0]}, {$u[1]})" . PHP_EOL;
echo "cos of b: " . $b->cos() . PHP_EOL;
echo "angle between b and x-axis: " . $b->degrees() . " degrees" . PHP_EOL;
echo "angle between b and x-axis: " . $b->radian() . " radian" . PHP_EOL;
$t = $b->terminalPoint();
echo "terminal point of b: ({$t[0]}, {$t[1]})" . PHP_EOL;

// About the vector a and b
echo "[about the vector a and b]-------------------" . PHP_EOL;
$c = $a->add($b)->components(); // $a + $b
$d = $a->subtract($b)->components(); // $a - $b
$dp = $a->dotProduct($b); // dot product of $a and $b
$cos = $a->cos($b);
$deg = $a->degrees($b);
$rad = $a->radian($b);
echo "a + b: components ({$c[0]}, {$c[1]})" . PHP_EOL;
echo "a - b: components ({$d[0]}, {$d[1]})" . PHP_EOL;
echo "dot product of a and b: {$dp}" . PHP_EOL;
echo "cos of the angle between a and b: {$cos}" . PHP_EOL;
echo "angle between a and b: {$deg} degrees" . PHP_EOL;
echo "angle between a and b: {$rad} radian" . PHP_EOL;
