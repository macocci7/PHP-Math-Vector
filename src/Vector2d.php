<?php

namespace Macocci7\PhpMathVector;

class Vector2d
{
    use Traits\Attributes2dTrait;
    use Traits\Relations2dTrait;

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
