<?php

declare(strict_types=1);

namespace Macocci7\PhpMathVector;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Macocci7\PhpMathVector\Vector3d;

final class Vector3dTest extends TestCase
{
    private $epsilon = 0.00001;

    private function isAlmostSame(float|null $a, float|null $b): bool
    {
        return (is_null($a) && is_null($b))
            || abs($a - $b) < $this->epsilon;
    }

    private function isAlmostSameVectors(Vector3d $a, Vector3d $b): bool
    {
        [$ix1, $iy1, $iz1] = $a->initialPoint();
        [$ix2, $iy2, $iz2] = $b->initialPoint();
        [$x1, $y1, $z1] = $a->components();
        [$x2, $y2, $z2] = $b->components();
        return $this->isAlmostSame($ix1, $ix2)
            && $this->isAlmostSame($iy1, $iy2)
            && $this->isAlmostSame($iz1, $iz2)
            && $this->isAlmostSame($x1, $x2)
            && $this->isAlmostSame($y1, $y2)
            && $this->isAlmostSame($z1, $z2);
    }

    public static function provide_initialPoint_can_return_initial_point_correctly(): array
    {
        return [
            ['a' => new Vector3d([0, 0, 0], [0, 0, 0]), 'expected' => [0, 0, 0]],
            ['a' => new Vector3d([0, 1, 2], [0, 0, 0]), 'expected' => [0, 1, 2]],
            ['a' => new Vector3d([1, 2, 3], [0, 0, 0]), 'expected' => [1, 2, 3]],
            ['a' => new Vector3d([1, 2, 3], [4, 5, 6]), 'expected' => [1, 2, 3]],
        ];
    }

    #[DataProvider('provide_initialPoint_can_return_initial_point_correctly')]
    public function test_initialPoint_can_return_initial_point_correctly(Vector3d $a, array $expected): void
    {
        $this->assertSame($expected, $a->initialPoint());
    }

    public static function provide_terminalPoint_can_return_terminal_point_correctly(): array
    {
        return [
            ['a' => new Vector3d([0, 0, 0], [0, 0, 0]), 'expected' => [0, 0, 0]],
            ['a' => new Vector3d([0, 0, 0], [1, 2, 3]), 'expected' => [1, 2, 3]],
            ['a' => new Vector3d([1, 2, 3], [0, 0, 0]), 'expected' => [1, 2, 3]],
            ['a' => new Vector3d([1, 2, 3], [1, 2, 3]), 'expected' => [2, 4, 6]],
            ['a' => new Vector3d([1, 2, 3], [-1, -2, -3]), 'expected' => [0, 0, 0]],
            ['a' => new Vector3d([1, 2, 3], [-2, -4, -6]), 'expected' => [-1, -2, -3]],
        ];
    }

    #[DataProvider('provide_terminalPoint_can_return_terminal_point_correctly')]
    public function test_terminalPoint_can_return_terminal_point_correctly(Vector3d $a, array $expected): void
    {
        $this->assertSame($expected, $a->terminalPoint());
    }

    public static function provide_components_can_return_components_correctly(): array
    {
        return [
            ['a' => new Vector3d([0, 0, 0], [0, 0, 0]), 'expected' => [0, 0, 0]],
            ['a' => new Vector3d([0, 0, 0], [1, 2, 3]), 'expected' => [1, 2, 3]],
            ['a' => new Vector3d([1, 2, 3], [4, 5, 6]), 'expected' => [4, 5, 6]],
        ];
    }

    #[DataProvider('provide_components_can_return_components_correctly')]
    public function test_components_can_return_components_correctly(Vector3d $a, array $expected): void
    {
        $this->assertSame($expected, $a->components());
    }

    public static function provide_magnitude_can_return_magnitude_correctly(): array
    {
        return [
            ['a' => new Vector3d([0, 0, 0], [0, 0, 0]), 'expected' => 0.0],
            ['a' => new Vector3d([0, 0, 0], [1, 1, 1]), 'expected' => sqrt(3)],
            ['a' => new Vector3d([0, 0, 0], [1, 2, 3]), 'expected' => sqrt(1 + 4 + 9)],
            ['a' => new Vector3d([0, 0, 0], [-1, -2, -3]), 'expected' => sqrt(1 + 4 + 9)],
            ['a' => new Vector3d([1, 2, 3], [0, 0, 0]), 'expected' => 0.0],
            ['a' => new Vector3d([1, 2, 3], [1, 1, 1]), 'expected' => sqrt(3)],
            ['a' => new Vector3d([1, 2, 3], [1, 2, 3]), 'expected' => sqrt(1 + 4 + 9)],
            ['a' => new Vector3d([1, 2, 3], [-1, -2, -3]), 'expected' => sqrt(1 + 4 + 9)],
        ];
    }

    #[DataProvider('provide_magnitude_can_return_magnitude_correctly')]
    public function test_magnitude_can_return_magnitude_correctly(Vector3d $a, float $expected): void
    {
        $this->assertSame($expected, $a->magnitude());
    }

    public static function provide_unitVector_can_return_unit_vector_correctly(): array
    {
        return [
            ['a' => new Vector3d([0, 0, 0], [0, 0, 0]), 'expected' => null],
            ['a' => new Vector3d([0, 0, 0], [1, 1, 1]), 'expected' => new Vector3d([0, 0, 0], [1 / sqrt(3), 1 / sqrt(3), 1 / sqrt(3)])],
            ['a' => new Vector3d([0, 0, 0], [-1, -1, -1]), 'expected' => new Vector3d([0, 0, 0], [-1 / sqrt(3), -1 / sqrt(3), -1 / sqrt(3)])],
            ['a' => new Vector3d([1, 2, 3], [0, 0, 0]), 'expected' => null],
            ['a' => new Vector3d([1, 2, 3], [1, 1, 1]), 'expected' => new Vector3d([1, 2, 3], [1 / sqrt(3), 1 / sqrt(3), 1 / sqrt(3)])],
            ['a' => new Vector3d([1, 2, 3], [-1, -1, -1]), 'expected' => new Vector3d([1, 2, 3], [-1 / sqrt(3), -1 / sqrt(3), -1 / sqrt(3)])],
        ];
    }

    #[DataProvider('provide_unitVector_can_return_unit_vector_correctly')]
    public function test_unitVector_can_return_unit_vector_correctly(Vector3d $a, Vector3d|null $expected): void
    {
        $this->assertEquals($expected, $a->unitVector());
    }

    public static function provide_multiply_can_return_multiplied_vector_correctly(): array
    {
        return [
            ['a' => new Vector3d([0, 0, 0], [0, 0, 0]), 'k' => 1, 'expected' => new Vector3d([0, 0, 0], [0, 0, 0])],
            ['a' => new Vector3d([0, 0, 0], [1, 2, 3]), 'k' => 0, 'expected' => new Vector3d([0, 0, 0], [0, 0, 0])],
            ['a' => new Vector3d([0, 0, 0], [1, 2, 3]), 'k' => 1.5, 'expected' => new Vector3d([0, 0, 0], [1.5, 3.0, 4.5])],
            ['a' => new Vector3d([0, 0, 0], [1, 2, 3]), 'k' => -1.5, 'expected' => new Vector3d([0, 0, 0], [-1.5, -3.0, -4.5])],
            ['a' => new Vector3d([0, 0, 0], [-1, -2, -3]), 'k' => 1.5, 'expected' => new Vector3d([0, 0, 0], [-1.5, -3.0, -4.5])],
            ['a' => new Vector3d([4, 5, 6], [0, 0, 0]), 'k' => 1, 'expected' => new Vector3d([4, 5, 6], [0, 0, 0])],
            ['a' => new Vector3d([4, 5, 6], [1, 2, 3]), 'k' => 0, 'expected' => new Vector3d([4, 5, 6], [0, 0, 0])],
            ['a' => new Vector3d([4, 5, 6], [1, 2, 3]), 'k' => 1.5, 'expected' => new Vector3d([4, 5, 6], [1.5, 3.0, 4.5])],
            ['a' => new Vector3d([4, 5, 6], [1, 2, 3]), 'k' => -1.5, 'expected' => new Vector3d([4, 5, 6], [-1.5, -3.0, -4.5])],
            ['a' => new Vector3d([4, 5, 6], [-1, -2, -3]), 'k' => 1.5, 'expected' => new Vector3d([4, 5, 6], [-1.5, -3.0, -4.5])],
        ];
    }

    #[DataProvider('provide_multiply_can_return_multiplied_vector_correctly')]
    public function test_multiply_can_return_multiplied_vector_correctly(Vector3d $a, int|float $k, Vector3d $expected): void
    {
        $this->assertEquals($expected, $a->multiply($k));
    }

    public static function provide_add_can_return_added_vector_correctly(): array
    {
        return [
            [
                'a' => new Vector3d([0, 0, 0], [0, 0, 0]),
                'b' => new Vector3d([0, 0, 0], [0, 0, 0]),
                'expected' => new Vector3d([0, 0, 0], [0, 0, 0]),
            ],
            [
                'a' => new Vector3d([0, 0, 0], [0, 0, 0]),
                'b' => new Vector3d([0, 0, 0], [1, 2, 3]),
                'expected' => new Vector3d([0, 0, 0], [1, 2, 3]),
            ],
            [
                'a' => new Vector3d([0, 0, 0], [0, 0, 0]),
                'b' => new Vector3d([0, 0, 0], [-1, -2, -3]),
                'expected' => new Vector3d([0, 0, 0], [-1, -2, -3]),
            ],
            [
                'a' => new Vector3d([0, 0, 0], [1, 2, 3]),
                'b' => new Vector3d([0, 0, 0], [4, 5, 6]),
                'expected' => new Vector3d([0, 0, 0], [5, 7, 9]),
            ],
            [
                'a' => new Vector3d([1, 2, 3], [0, 0, 0]),
                'b' => new Vector3d([4, 5, 6], [7, 8, 9]),
                'expected' => new Vector3d([1, 2, 3], [7, 8, 9]),
            ],
            [
                'a' => new Vector3d([1, 2, 3], [7, 8, 9]),
                'b' => new Vector3d([4, 5, 6], [-3, -2, -1]),
                'expected' => new Vector3d([1, 2, 3], [4, 6, 8]),
            ],
            [
                'a' => new Vector3d([1, 2, 3], [-1, -2, -3]),
                'b' => new Vector3d([4, 5, 6], [-4, -5, -6]),
                'expected' => new Vector3d([1, 2, 3], [-5, -7, -9]),
            ],
        ];
    }

    #[DataProvider('provide_add_can_return_added_vector_correctly')]
    public function test_add_can_return_added_vector_correctly(Vector3d $a, Vector3d $b, Vector3d $expected): void
    {
        $this->assertEquals($expected, $a->add($b));
    }

    public static function provide_subtract_can_return_subtracted_vector_correctly(): array
    {
        return [
            [
                'a' => new Vector3d([0, 0, 0], [0, 0, 0]),
                'b' => new Vector3d([0, 0, 0], [0, 0, 0]),
                'expected' => new Vector3d([0, 0, 0], [0, 0, 0]),
            ],
            [
                'a' => new Vector3d([0, 0, 0], [0, 0, 0]),
                'b' => new Vector3d([0, 0, 0], [1, 2, 3]),
                'expected' => new Vector3d([0, 0, 0], [-1, -2, -3]),
            ],
            [
                'a' => new Vector3d([0, 0, 0], [0, 0, 0]),
                'b' => new Vector3d([0, 0, 0], [-1, -2, -3]),
                'expected' => new Vector3d([0, 0, 0], [1, 2, 3]),
            ],
            [
                'a' => new Vector3d([0, 0, 0], [1, 2, 3]),
                'b' => new Vector3d([0, 0, 0], [6, 5, 4]),
                'expected' => new Vector3d([0, 0, 0], [-5, -3, -1]),
            ],
            [
                'a' => new Vector3d([3, 2, 1], [1, 2, 3]),
                'b' => new Vector3d([4, 5, 6], [6, 5, 4]),
                'expected' => new Vector3d([3, 2, 1], [-5, -3, -1]),
            ],
        ];
    }

    #[DataProvider('provide_subtract_can_return_subtracted_vector_correctly')]
    public function test_subtract_can_return_subtracted_vector_correctly(Vector3d $a, Vector3d $b, Vector3d $expected): void
    {
        $this->assertEquals($expected, $a->subtract($b));
    }

    public static function provide_dotProduct_can_return_dot_product_correctly(): array
    {
        return [
            [
                'a' => new Vector3d([0, 0, 0], [0, 0, 0]),
                'b' => new Vector3d([0, 0, 0], [0, 0, 0]),
                'expected' => 0,
            ],
            [
                'a' => new Vector3d([1, 2, 3], [0, 0, 0]),
                'b' => new Vector3d([4, 5, 6], [1, 2, 3]),
                'expected' => 0,
            ],
            [
                'a' => new Vector3d([1, 2, 3], [1, 2, 3]),
                'b' => new Vector3d([4, 5, 6], [0, 0, 0]),
                'expected' => 0,
            ],
            [
                'a' => new Vector3d([1, 2, 3], [3, 2, 1]),
                'b' => new Vector3d([4, 5, 6], [6, 5, 4]),
                'expected' => 32,
            ],
            [
                'a' => new Vector3d([1, 2, 3], [-3, -2, -1]),
                'b' => new Vector3d([4, 5, 6], [6, 5, 4]),
                'expected' => -32,
            ],
            [
                'a' => new Vector3d([1, 2, 3], [-3, -2, -1]),
                'b' => new Vector3d([4, 5, 6], [-6, -5, -4]),
                'expected' => 32,
            ],
        ];
    }

    #[DataProvider('provide_dotProduct_can_return_dot_product_correctly')]
    public function test_dotProduct_can_return_dot_product_correctly(Vector3d $a, Vector3d $b, int|float $expected): void
    {
        $this->assertSame($expected, $a->dotProduct($b));
    }

    public static function provide_crossProduct_can_return_cross_product_correctly(): array
    {
        return [
            [
                'a' => new Vector3d([0, 0, 0], [1, 0, 0]),
                'b' => new Vector3d([0, 0, 0], [0, 1, 0]),
                'expected' => new Vector3d([0, 0, 0], [0, 0, 1]),
            ],
            [
                'a' => new Vector3d([1, 2, 3], [1, 0, 0]),
                'b' => new Vector3d([4, 5, 6], [0, 1, 0]),
                'expected' => new Vector3d([1, 2, 3], [0, 0, 1]),
            ],
            [
                'a' => new Vector3d([0, 0, 0], [1, 1, 0]),
                'b' => new Vector3d([0, 0, 0], [0, 1, 1]),
                'expected' => new Vector3d([0, 0, 0], [1, -1, 1]),
            ],
            [
                'a' => new Vector3d([1, 2, 3], [1, 1, 0]),
                'b' => new Vector3d([4, 5, 6], [0, 1, 1]),
                'expected' => new Vector3d([1, 2, 3], [1, -1, 1]),
            ],
        ];
    }

    #[DataProvider('provide_crossProduct_can_return_cross_product_correctly')]
    public function test_crossProduct_can_return_cross_product_correctly(Vector3d $a, Vector3d $b, Vector3d $expected): void
    {
        $this->assertEquals($expected, $a->crossProduct($b));
    }

    public static function provide_rotate_can_return_rotated_vector_correctly(): array
    {
        return [
            [
                'a' => new Vector3d([0, 0, 0], [0, 0, 0]),
                'b' => new Vector3d([0, 0, 0], [0, 0, 0]),
                'degrees' => 0.0,
                'expected' => new Vector3d([0, 0, 0], [0, 0, 0])
            ],
            [
                'a' => new Vector3d([0, 0, 0], [0, 0, 0]),
                'b' => new Vector3d([0, 0, 0], [1, 1, 1]),
                'degrees' => 0.0,
                'expected' => new Vector3d([0, 0, 0], [0, 0, 0])
            ],
            [
                'a' => new Vector3d([0, 0, 0], [1, 0, 0.5]),
                'b' => new Vector3d([0, 0, 0], [1, 0, 1]),
                'degrees' => 0.0,
                'expected' => new Vector3d([0, 0, 0], [1.0, 0.0, 0.5])
            ],
            [
                'a' => new Vector3d([0, 0, 0], [1, 0, 0.5]),
                'b' => new Vector3d([0, 0, 0], [1, 0, 1]),
                'degrees' => 180.0,
                'expected' => new Vector3d([0, 0, 0], [0.5, 0.0, 1.0])
            ],
            [
                'a' => new Vector3d([0, 0, 0], [0, 1, 0]),
                'b' => new Vector3d([0, 0, 0], [0, 1, 1]),
                'degrees' => 180.0,
                'expected' => new Vector3d([0, 0, 0], [0.0, 0.0, 1.0])
            ],
            [
                'a' => new Vector3d([1, 2, 3], [1, 0, 0]),
                'b' => new Vector3d([0, 0, 0], [0, 0, 1]),
                'degrees' => 90.0,
                'expected' => new Vector3d([1, 2, 3], [0.0, 1.0, 0.0])
            ],
        ];
    }

    #[DataProvider('provide_rotate_can_return_rotated_vector_correctly')]
    public function test_rotate_can_return_rotated_vector_correctly(Vector3d $a, Vector3d $b, float $degrees, Vector3d $expected): void
    {
        $this->assertTrue(
            $this->isAlmostSameVectors(
                $expected,
                $a->rotate($b, $degrees)
            )
        );
    }
}
