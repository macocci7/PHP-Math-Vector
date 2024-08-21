# PHP-Math-Vector

A math library for handling vectors.

## 1. Features

`PHP-Math-Vector` handles 2-dimensional vectors and 3-dimensional vectors.

`PHP-Math-Vector` can:

- return the length (magnitude) of the vector
- return the unit vector
- return a vector multiplied by a real number
- add two vectors
- subtract one vector from another
- return the `dot product` of the two vectors
- return the `cross product` of the two vectors
- return the `cosine` of the angle between two vectors
- return the angle between two vectors in `degrees` or `radian`
- return the `initial point` or `terminal point`
- return a set of each component of x and y
- rotate the vector by a specified angle

## 2. Contents

- [1. Features](#1-features)
- 2\.Contents
- [3. Requirements](#3-requirements)
- [4. Installation](#4-installation)
- [5. Usage](#5-usage)
- [6. Examples](#6-examples)
- [7. LICENSE](#7-license)

## 3. Requiremnets

- PHP 8.1 or later
- Composer

## 4. Installation

```bash
composer require macocci7/php-math-vector
```

## 5. Usage

### 5.1. Two-dimensional Vectors

To handle two-dimensional vectors, create instances of `Vector2d` class at first.

#### 5.1.1. Instantiation

`Vector2d` class needs `initialPoint` and `components` as arguments.

```php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Macocci7\PhpMathVector\Vector2d;

$a = new Vector2d(
    initialPoint: [1, 2],   // (x, y) = (1, 2)
    components: [3, 4],     // (x, y) = (3, 4)
);

$b = new Vector2d(
    initialPoint: [5, 6],   // (x, y) = (5, 6)
    components: [7, 8],     // (x, y) = (7, 8)
);
```

Now, you can handle the two-dimensional vectors `$a` and `$b`.


#### 5.1.2. Length (Magnitude)

To get the length (magnitude) of the vector, use `length()` or `magnitude()` methods.

```php
// Equivalent to:
// $a->magnitude()
// $b->magnitude()
echo "length of the vector a:" . $a->length() . PHP_EOL;
echo "length of the vector b:" . $b->length() . PHP_EOL;
```

> Note: Actually, the `length()` method is an alias of the `magnitude()` method.

#### 5.1.3. Components

To get components of the vector, use the `components()` method.

```php
[$x1, $y1] = $a->components();
[$x2, $y2] = $b->components();
```

#### 5.1.4. Initial and Terminal points

To get initial point or terminal poinnt, use the `initialPoint()` or `terminalPoint()` method.

```php
[$x1, $y1] = $a->initialPoint();
[$x2, $y2] = $a->terminalPoint();
```

#### 5.1.5. Unit vector

To get unit vectors, use the `unitVector()` method.

This method returns a new vector, and the original vector remains in its original state.

```php
$ua = $a->unitVector();
$ub = $b->unitVector();
```

#### 5.1.6. Multiplying by a real number

To multiply the vector by a real number, use the `multiply()` method.

This method returns a new vector, and the original vector remains in its original state.

```php
$c = $a->multiply(2);
$d = $b->multiply(0.8);
```

#### 5.1.7. Adding two vectors

To perform `(vector a) + (vector b)`, use the `add()` method of the former vector (`$a` in this case), and set the latter vector as a parameter of this method (`$b` in this case).
This returns a new vector that has the `initial point` of the former vector and whose components are the sum of the components of both vectors.

```php
// Equivalent to:
// $c = new Vector2d([1, 2], [3 + 7, 4 + 8]);
$c = $a->add($b);
```

The former vector (`$a` in this case) and the latter vector (`$b` in this case) remain in their original state.

#### 5.1.8. Subtracting one vector from another

To perform `(vector a) - (vector b)`, use the `subtract()` method of the former vector (`$a` in this case), and set the latter vector as a parameter of this method (`$b` in this case).
This returns a new vector that has the `initial point` of the former vector and whose compoents are the components obtained by subtracting the latter vector from the former vector.

```php
// Equivalent to:
// $c = new Vector2d([1, 2], [3 - 7, 4 - 8]);
$c = $a->subtract($b);
```

The former vector (`$a` in this case) and the latter vector (`$b` in this case) remain in their original state.

#### 5.1.9. Dot product

To get the dot product of two vectors, use `dotProduct()` method.

The result is the same for the methods in either vector.

```php
// Equivalent to:
// $b->dotProduct($a)
echo "dot product:" . $a->dotProduct($b);
```

#### 5.1.10. Cosine

To get the cosine of the angle between two vectors, use `cos()` method.

The result is the same for the methods in either vector.

```php
// Equivalent to:
// $b->cos($a)
echo "cos:" . $a->cos($b) . PHP_EOL;
```

If the argument is omitted, the cosine of the angle with the x-axis is returned.

```php
echo "cos:" . $a->cos() . PHP_EOL;
echo "cos:" . $b->cos() . PHP_EOL;
```

#### 5.1.11. Angle

To get the angle between two vectors, use `degrees()` or `radian()` method.

The result is the same for the methods in either vector.

```php
// Equivalent to:
// $b->degrees($a)
// $b->radian($a)
echo "degrees:" . $a->degrees($b) . PHP_EOL;
echo "radian:" . $a->radian($b) . PHP_EOL;
```

If the argument is omitted, the angle made with the x-axis is returned.

```php
echo "degrees:" . $a->degrees() . PHP_EOL;
echo "radian:" . $a->radian() . PHP_EOL;
```

#### 5.1.12. Rotation

To get a rotated vector, use `rotate()` method.

Pass degrees to rotate as an argument.

```php
$a = new Vector2d([1, 2], [3, 4]);
$b = $a->rotate(90.0);
```

### 5.2. Three-dimensional Vectors

To handle three-dimensional vectors, create instances of `Vector3d` class at first.

#### 5.2.1 Instantiation

`Vector3d` class needs `initialPoint` and `components` as arguments.

```php
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
```

Now, you can handle the three-dimensional vectors `$a` and `$b`.

#### 5.2.2. Length (Magnitude)

To get the length (magnitude) of the vector, use `length()` or `magnitude()` methods.

```php
// Equivalent to:
// $a->magnitude()
// $b->magnitude()
echo "length of the vector a:" . $a->length() . PHP_EOL;
echo "length of the vector b:" . $b->length() . PHP_EOL;
```

> Note: Actually, the `length()` method is an alias of the `magnitude()` method.

#### 5.2.3. Components

To get components of the vector, use the `components()` method.

```php
[$x1, $y1, $z1] = $a->components();
[$x2, $y2, $z2] = $b->components();
```

#### 5.2.4. Initial and Terminal Points

To get initial point or terminal poinnt, use the `initialPoint()` or `terminalPoint()` methods.

```php
[$x1, $y1, $z1] = $a->initialPoint();
[$x2, $y2, $z2] = $a->terminalPoint();
```

#### 5.2.5. Unit Vector

To get unit vectors, use the `unitVector()` method.

This method returns a new vector, and the original vector remains in its original state.

```php
$ua = $a->unitVector();
$ub = $b->unitVector();
```

#### 5.2.6. Multiplying by a real number

To multiply the vector by a real number, use the `multiply()` method.

This method returns a new vector, and the original vector remains in its original state.

```php
$c = $a->multiply(2);
$d = $b->multiply(0.8);
```

#### 5.2.7. Adding two vectors

To perform `(vector a) + (vector b)`, use the `add()` method of the former vector (`$a` in this case), and set the latter vector as a parameter of this method (`$b` in this case). 

This returns a new vector that has the initial point of the former vector and whose components are the sum of the components of both vectors.

```php
// Equivalent to:
// $c = new Vector2d([1, 2, 3], [3 + 5, 4 + 4, 5 + 3]);
$c = $a->add($b);
```

The former vector (`$a` in this case) and the latter vector (`$b` in this case) remain in their original state.

#### 5.2.8. Subtracting one vector from another

To perform `(vector a) - (vector b)`, use the `subtract()` method of the former vector (`$a` in this case), and set the latter vector as a parameter of this method (`$b` in this case). 
This returns a new vector that has the initial point of the former vector and whose compoents are the components obtained by subtracting the latter vector from the former vector.

```php
// Equivalent to:
// $c = new Vector2d([1, 2, 3], [3 - 5, 4 - 4, 5 - 3]);
$c = $a->subtract($b);
```

The former vector (`$a` in this case) and the latter vector (`$b` in this case) remain in their original state.

#### 5.2.9. Dot product

To get the dot product of two vectors, use `dotProduct()` method.

The result is the same for the methods in either vector.

```php
// Equivalent to:
// $b->dotProduct($a)
echo "dot product:" . $a->dotProduct($b);
```

#### 5.2.10. Cross product

To get the cross product of two vectors, use `crossProduct()` method.

The result is the same for the methods in either vector.

```php
// Equivalent to:
// $b->crossProduct($a)
$c = $a->crossProduct($b);
```

This method returns a new vector, and the both original vectors remain in their original state.

#### 5.2.11. Cosine

To get the cosine of the angle between two vectors, use `cos()` method.

The result is the same for the methods in either vector.

```php
// Equivalent to:
// $b->cos($a)
echo "cos:" . $a->cos($b) . PHP_EOL;
```

If the argument is omitted, the cosine of the angle with the xy-plane is returned.

```php
echo "cos:" . $a->cos() . PHP_EOL;
echo "cos:" . $b->cos() . PHP_EOL;
```

#### 5.2.12. Angle

To get the angle between two vectors, use `degrees()` or `radian()` method.

The result is the same for the methods in either vector.

```php
// Equivalent to:
// $b->degrees($a)
// $b->radian($a)
echo "degrees:" . $a->degrees($b) . PHP_EOL;
echo "radian:" . $a->radian($b) . PHP_EOL;
```

If the argument is omitted, the angle made with the xy-plane is returned.

```php
echo "degrees:" . $a->degrees() . PHP_EOL;
echo "radian:" . $a->radian() . PHP_EOL;
```

#### 5.2.13. Rotation

To get a rotated vector around a vector, use `rotate()` method.

Pass a vector of rotation axis, and degrees to rotate as an argument.

```php
$a = new Vector3d([1, 2, 3], [4, 5, 6]);
$b = new Vector3d([4, 5, 6], [7, 8, 9]);
$c = $a->rotate($b, 90.0);
```

This method returns a new vector, and the both original vectors remain in their original state.

## 6. Examples

- [UsingVector2d.php](examples/UsingVector2d.php)
- [ApplicationVector2d.php](examples/ApplicationVector2d.php)
- [RotateVector2d.php](examples/RotateVector2d.php)
- [UsingVector3d.php](examples/UsingVector3d.php)

## 7. LICENSE

[MIT](LICENSE)

***

Copyright 2024 macocci7.
