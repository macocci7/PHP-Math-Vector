<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Macocci7\PhpMathVector\Vector2d;

$a = new Vector2d([1, 2], [4, 0]);
$b = new Vector2d([1, 2], [2, 2]);

$la = $a->length();
$lb = $b->length();
$cos = $a->cos($b);
$rad = $a->radian($b);

// Area of ​​the triangle made by vectors a and b
// area = |a||b|sinθ / 2 = |a||b|cosθ * tanθ / 2
//$area = $la * $lb * sin($rad) / 2;
$areaT = $la * $lb * $cos * tan($rad) / 2;

// Area of ​​the parallelogram made by vectors a and b
// area = |a||b|sinθ
$areaP = $la * $lb * sin($rad);

// output
echo "length of a:{$la}" . PHP_EOL;
echo "length of b:{$lb}" . PHP_EOL;
echo "cos:{$cos}" . PHP_EOL;
echo "degrees:" . $a->degrees($b) . PHP_EOL;
echo "area of the triangle:{$areaT}" . PHP_EOL;
echo "area of the parallelogram:{$areaP}" . PHP_EOL;
