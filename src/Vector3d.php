<?php

namespace Macocci7\PhpMathVector;

class Vector3d
{
    use Traits\Attributes3dTrait;
    use Traits\Relations3dTrait;

    /**
     * constructor
     *
     * @param   array<int, int|float>   $initialPoint
     * @param   array<int, int|float>   $components
     */
    public function __construct(
        protected array $initialPoint,
        protected array $components,
    ) {
    }
}
