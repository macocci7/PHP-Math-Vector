<?php

namespace Macocci7\PhpMathVector\Traits;

use Macocci7\PhpMathVector\Vector2d;
use Macocci7\PhpMathVector\Vector3d;

trait Attributes3dTrait
{
    /**
     * returns the initial point
     *
     * @return  array<int, int|float>
     */
    public function initialPoint()
    {
        return $this->initialPoint;
    }

    /**
     * returns the terminal point of this vector
     *
     * @return  array<int, int|float>
     */
    public function terminalPoint()
    {
        [$x1, $y1, $z1] = $this->initialPoint;
        [$x2, $y2, $z2] = $this->components();
        return [
            $x1 + $x2,
            $y1 + $y2,
            $z1 + $z2,
        ];
    }

    /**
     * returns the components
     *
     * @return  array<int, int|float>
     */
    public function components()
    {
        return $this->components;
    }

    /**
     * returns the magnitude
     *
     * @return  int|float
     */
    public function magnitude()
    {
        return sqrt(
            $this->components[0] ** 2
            + $this->components[1] ** 2
            + $this->components[2] ** 2
        );
    }

    /**
     * returns the length
     * alias of magnitude()
     *
     * @return  int|float
     */
    public function length()
    {
        return $this->magnitude();
    }

    /**
     * returns the unit vector
     *
     * @return  Vector3d|null
     */
    public function unitVector()
    {
        $magnitude = $this->magnitude();
        if ($magnitude == 0) {
            return null;
        }
        [$x, $y, $z] = $this->components();
        return new Vector3d(
            $this->initialPoint,
            [$x / $magnitude, $y / $magnitude, $z / $magnitude],
        );
    }

    /**
     * returns a new vector that is this vector multiplied by k.
     *
     * @param   int|float   $k
     * @return  Vector3d
     */
    public function multiply(int|float $k)
    {
        [$x, $y, $z] = $this->components();
        return new Vector3d(
            $this->initialPoint,
            [
                $x * $k,
                $y * $k,
                $z * $k,
            ],
        );
    }
}
