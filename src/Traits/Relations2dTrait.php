<?php

namespace Macocci7\PhpMathVector\Traits;

use Macocci7\PhpMathVector\Vector2d;

trait Relations2dTrait
{
    /**
     * returns a new vector with vector $v added to this vector
     *
     * @param   Vector2d    $v
     * @return  Vector2d
     */
    public function add(Vector2d $v)
    {
        [$x1, $y1] = $this->components();
        [$x2, $y2] = $v->components();
        return new Vector2d(
            $this->initialPoint,
            [
                $x1 + $x2,
                $y1 + $y2,
            ],
        );
    }

    /**
     * returns a new vector by subtracting vector $v from this vector
     *
     * @param   Vector2d    $v
     * @return  Vector2d
     */
    public function subtract(Vector2d $v)
    {
        [$x1, $y1] = $this->components();
        [$x2, $y2] = $v->components();
        return new Vector2d(
            $this->initialPoint,
            [
                $x1 - $x2,
                $y1 - $y2,
            ],
        );
    }

    /**
     * returns the dot product of this vector and vector $v
     *
     * @param   Vector2d    $v
     * @return  int|float
     */
    public function dotProduct(Vector2d $v)
    {
        [$x1, $y1] = $this->components();
        [$x2, $y2] = $v->components();
        return $x1 * $x2 + $y1 * $y2;
    }

    /**
     * returns the cos value
     *
     * @param   Vector2d|null   $v = null
     * @return  float|null
     */
    public function cos(Vector2d|null $v = null)
    {
        $m1 = $this->magnitude();
        if ($m1 == 0) {
            return null;
        }
        if (is_null($v)) {
            $x1 = $this->components()[0];
            return $x1 / $m1;
        }
        $m2 = $v->magnitude();
        if ($m2 == 0) {
            return null;
        }
        return $this->dotProduct($v) / ($m1 * $m2);
    }

    /**
     * returns the angle between this vector and vector $v as degrees
     *
     * @param   Vector2d|null   $v = null
     * @return  float|null
     */
    public function degrees(Vector2d|null $v = null)
    {
        $cos = $this->cos($v);
        return is_null($cos) ? null : rad2deg(acos($cos));
    }

    /**
     * returns the angle between this vector and vector $v as radian
     *
     * @param   Vector2d|null   $v = null
     * @return  float|null
     */
    public function radian(Vector2d|null $v = null)
    {
        $cos = $this->cos($v);
        return is_null($cos) ? null : acos($cos);
    }
}
