<?php

namespace Macocci7\PhpMathVector\Traits;

use Macocci7\PhpMathVector\Vector2d;

trait Attributes2dTrait
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
        [$x1, $y1] = $this->initialPoint;
        [$x2, $y2] = $this->components();
        return [
            $x1 + $x2,
            $y1 + $y2,
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
        return sqrt($this->components[0] ** 2 + $this->components[1] ** 2);
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
     * @return  Vector2d
     */
    public function unitVector()
    {
        $magnitude = $this->magnitude();
        [$x, $y] = $this->components();
        return new Vector2d(
            $this->initialPoint,
            [$x / $magnitude, $y / $magnitude],
        );
    }

    /**
     * returns a new vector that is this vector multiplied by k.
     *
     * @param   int|float   $k
     * @return  Vector2d
     */
    public function multiply(int|float $k)
    {
        [$x, $y] = $this->components();
        return new Vector2d(
            $this->initialPoint,
            [
                $x * $k,
                $y * $k,
            ],
        );
    }

    /**
     * rotates the vector counterclockwise around the initital point
     *
     * @param   float   $degrees
     * @return  Vector2d
     */
    public function rotate(float $degrees)
    {
        $length = $this->magnitude();
        $angle = $this->degrees();
        return new Vector2d(
            $this->initialPoint(),
            [
                $length * cos(deg2rad($angle + $degrees)),
                $length * sin(deg2rad($angle + $degrees)),
            ],
        );
    }
}
