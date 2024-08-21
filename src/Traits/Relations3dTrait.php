<?php

namespace Macocci7\PhpMathVector\Traits;

use Macocci7\PhpMathVector\Vector3d;

trait Relations3dTrait
{
    /**
     * returns a new vector with vector $v added to this vector
     *
     * @param   Vector3d    $v
     * @return  Vector3d
     */
    public function add(Vector3d $v)
    {
        [$x1, $y1, $z1] = $this->components();
        [$x2, $y2, $z2] = $v->components();
        return new Vector3d(
            $this->initialPoint,
            [
                $x1 + $x2,
                $y1 + $y2,
                $z1 + $z2,
            ],
        );
    }

    /**
     * returns a new vector by subtracting vector $v from this vector
     *
     * @param   Vector3d    $v
     * @return  Vector3d
     */
    public function subtract(Vector3d $v)
    {
        [$x1, $y1, $z1] = $this->components();
        [$x2, $y2, $z2] = $v->components();
        return new Vector3d(
            $this->initialPoint,
            [
                $x1 - $x2,
                $y1 - $y2,
                $z1 - $z2,
            ],
        );
    }

    /**
     * returns the dot product of this vector and vector $v
     *
     * @param   Vector3d    $v
     * @return  int|float
     */
    public function dotProduct(Vector3d $v)
    {
        [$x1, $y1, $z1] = $this->components();
        [$x2, $y2, $z2] = $v->components();
        return $x1 * $x2 + $y1 * $y2 + $z1 * $z2;
    }

    /**
     * returns the cos value
     *
     * @param   Vector3d|null   $v = null
     * @return  float|null
     */
    public function cos(Vector3d|null $v = null)
    {
        $m1 = $this->magnitude();
        if ($m1 == 0) {
            return null;
        }
        if (is_null($v)) {
            $x1 = $this->components()[0];
            $y1 = $this->components()[1];
            $xy = sqrt($x1 ** 2 + $y1 ** 2);
            return $xy / $m1;
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
     * @param   Vector3d|null   $v = null
     * @return  float|null
     */
    public function degrees(Vector3d|null $v = null)
    {
        $cos = $this->cos($v);
        return is_null($cos) ? null : rad2deg(acos($cos));
    }

    /**
     * returns the angle between this vector and vector $v as radian
     *
     * @param   Vector3d|null   $v = null
     * @return  float|null
     */
    public function radian(Vector3d|null $v = null)
    {
        $cos = $this->cos($v);
        return is_null($cos) ? null : acos($cos);
    }

    /**
     * returns the cross product of this vector and vector $v
     *
     * @param   Vector3d    $v
     * @return  Vector3d
     */
    public function crossProduct(Vector3d $v)
    {
        [$x1, $y1, $z1] = $this->components();
        [$x2, $y2, $z2] = $v->components();
        return new Vector3d(
            $this->initialPoint(),
            [
                $y1 * $z2 - $z1 * $y2,
                $z1 * $x2 - $x1 * $z2,
                $x1 * $y2 - $y1 * $x2,
            ]
        );
    }

    /**
     * rotates this vector counterclockwise around the vector $v
     *
     * @param   Vector3d    $v
     * @param   float       $degrees
     * @return  Vector3d
     */
    public function rotate(Vector3d $v, float $degrees)
    {
        $length = $this->magnitude();
        if ($length == 0) {
            return $this;
        }
        $radian = deg2rad($degrees);
        $u = $v->unitVector();
        $r1 = $this->multiply(cos($radian));
        $r2 = $u->multiply((1 - cos($radian)) * $this->dotProduct($u));
        $r3 = $u->crossProduct($this)->multiply(sin($radian));
        return $r1->add($r2)->add($r3);
    }
}
