<?php

declare(strict_types=1);

namespace Macocci7\PhpMathVector;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Macocci7\PhpMathVector\Vector2d;

final class Vector2dTest extends TestCase
{
    private $epsilon = 0.00001;

    private function isAlmostSame(float|null $a, float|null $b): bool
    {
        return (is_null($a) && is_null($b))
            || abs($a - $b) < $this->epsilon;
    }

    public static function provide_components_can_return_components_correctly(): array
    {
        return [
            ['vector' => new Vector2d([0, 0], [1, 2]), 'expected' => [1, 2], ],
            ['vector' => new Vector2d([1, 2], [3, 4]), 'expected' => [3, 4], ],
            ['vector' => new Vector2d([1, 2], [0, 0]), 'expected' => [0, 0], ],
        ];
    }

    #[DataProvider('provide_components_can_return_components_correctly')]
    public function test_components_can_return_components_correctly(Vector2d $vector, array $expected): void
    {
        $this->assertSame(
            $expected,
            $vector->components(),
        );
    }

    public static function provide_magnitude_can_return_magnitude_correctly(): array
    {
        return [
            ['vector' => new Vector2d([1, 2], [3, 4]), 'expected' => 5.0, ],
            ['vector' => new Vector2d([-1, -2], [-3, -4]), 'expected' => 5.0, ],
            ['vector' => new Vector2d([-1, -2], [-3, 4]), 'expected' => 5.0, ],
            ['vector' => new Vector2d([-1, -2], [3, -4]), 'expected' => 5.0, ],
            ['vector' => new Vector2d([1, 2], [1, sqrt(3)]), 'expected' => 1.9999999999999998, ],
            ['vector' => new Vector2d([1, 2], [2, 2]), 'expected' => 2 * sqrt(2), ],
        ];
    }

    #[DataProvider('provide_magnitude_can_return_magnitude_correctly')]
    public function test_magnitude_can_return_magnitude_correctly(Vector2d $vector, int|float $expected): void
    {
        $this->assertSame(
            $expected,
            $vector->magnitude(),
        );
    }

    public static function provide_unitVector_can_return_unit_vector_correctly(): array
    {
        return [
            ['vector' => new Vector2d([1, 2], [3, 4]), 'expected' => new Vector2d([1, 2], [0.6, 0.8])],
            ['vector' => new Vector2d([1, 2], [sqrt(2) / 2, sqrt(2) / 2]), 'expected' => new Vector2d([1, 2], [sqrt(2) / 2, sqrt(2) / 2])],
            ['vector' => new Vector2d([1, 2], [3, 0]), 'expected' => new Vector2d([1, 2], [1, 0])],
            ['vector' => new Vector2d([1, 2], [0, 2.5]), 'expected' => new Vector2d([1, 2], [0, 1])],
        ];
    }

    #[DataProvider('provide_unitVector_can_return_unit_vector_correctly')]
    public function test_unitVector_can_return_unit_vector_correctly(Vector2d $vector, Vector2d $expected): void
    {
        $this->assertEquals($expected, $vector->unitVector());
    }

    public static function provide_add_can_return_added_vector_correctly(): array
    {
        return [
            [
                'a' => new Vector2d([1, 2], [3, 4]),
                'b' => new Vector2d([5, 6], [7, 8]),
                'expected' => new Vector2d([1, 2], [10, 12]),
            ],
            [
                'a' => new Vector2d([-1, -2], [-3, -4]),
                'b' => new Vector2d([-5, -6], [-7, -8]),
                'expected' => new Vector2d([-1, -2], [-10, -12]),
            ],
            [
                'a' => new Vector2d([1, 2], [3, 4]),
                'b' => new Vector2d([-5, -6], [-7, -8]),
                'expected' => new Vector2d([1, 2], [-4, -4]),
            ],
            [
                'a' => new Vector2d([-1, -2], [-3, -4]),
                'b' => new Vector2d([5, 6], [7, 8]),
                'expected' => new Vector2d([-1, -2], [4, 4]),
            ],
            [
                'a' => new Vector2d([1, 2], [3, 4]),
                'b' => new Vector2d([5, 6], [0, 0]),
                'expected' => new Vector2d([1, 2], [3, 4]),
            ],
            [
                'a' => new Vector2d([1, 2], [0, 0]),
                'b' => new Vector2d([5, 6], [3, 4]),
                'expected' => new Vector2d([1, 2], [3, 4]),
            ],
            [
                'a' => new Vector2d([1, 2], [0, 0]),
                'b' => new Vector2d([5, 6], [0, 0]),
                'expected' => new Vector2d([1, 2], [0, 0]),
            ],
            [
                'a' => new Vector2d([1, 2], [3, 4]),
                'b' => new Vector2d([5, 6], [-3, -4]),
                'expected' => new Vector2d([1, 2], [0, 0]),
            ],
        ];
    }

    #[DataProvider('provide_add_can_return_added_vector_correctly')]
    public function test_add_can_return_added_vector_correctly(Vector2d $a, Vector2d $b, Vector2d $expected): void
    {
        $this->assertEquals(
            $expected,
            $a->add($b),
        );
    }

    public static function provide_subtract_can_return_subtracted_vector(): array
    {
        return [
            [
                'a' => new Vector2d([1, 2], [3, 4]),
                'b' => new Vector2d([5, 6], [7, 8]),
                'expected' => new Vector2d([1, 2], [-4, -4]),
            ],
            [
                'a' => new Vector2d([-1, -2], [-3, -4]),
                'b' => new Vector2d([-5, -6], [-7, -8]),
                'expected' => new Vector2d([-1, -2], [4, 4]),
            ],
            [
                'a' => new Vector2d([1, 2], [3, 4]),
                'b' => new Vector2d([-5, -6], [-7, -8]),
                'expected' => new Vector2d([1, 2], [10, 12]),
            ],
            [
                'a' => new Vector2d([-1, -2], [-3, -4]),
                'b' => new Vector2d([5, 6], [7, 8]),
                'expected' => new Vector2d([-1, -2], [-10, -12]),
            ],
            [
                'a' => new Vector2d([1, 2], [3, 4]),
                'b' => new Vector2d([5, 6], [0, 0]),
                'expected' => new Vector2d([1, 2], [3, 4]),
            ],
            [
                'a' => new Vector2d([1, 2], [0, 0]),
                'b' => new Vector2d([5, 6], [7, 8]),
                'expected' => new Vector2d([1, 2], [-7, -8]),
            ],
            [
                'a' => new Vector2d([1, 2], [0, 0]),
                'b' => new Vector2d([5, 6], [0, 0]),
                'expected' => new Vector2d([1, 2], [0, 0]),
            ],
            [
                'a' => new Vector2d([1, 2], [3, 4]),
                'b' => new Vector2d([5, 6], [3, 4]),
                'expected' => new Vector2d([1, 2], [0, 0]),
            ],
        ];
    }

    #[DataProvider('provide_subtract_can_return_subtracted_vector')]
    public function test_subtract_can_return_subtracted_vector(Vector2d $a, Vector2d $b, Vector2d $expected): void
    {
        $this->assertEquals(
            $expected,
            $a->subtract($b),
        );
    }

    public static function provide_multiply_can_return_multiplied_vector_correctly(): array
    {
        return [
            [
                'vector' => new Vector2d([1, 2], [3, 4]),
                'k' => 2,
                'expected' => new Vector2d([1, 2], [6, 8]),
            ],
            [
                'vector' => new Vector2d([1, 2], [3, 4]),
                'k' => -2,
                'expected' => new Vector2d([1, 2], [-6, -8]),
            ],
            [
                'vector' => new Vector2d([1, 2], [3, 4]),
                'k' => 0,
                'expected' => new Vector2d([1, 2], [0, 0]),
            ],
            [
                'vector' => new Vector2d([1, 2], [-3, -4]),
                'k' => 2.5,
                'expected' => new Vector2d([1, 2], [-7.5, -10]),
            ],
            [
                'vector' => new Vector2d([1, 2], [-3, -4]),
                'k' => -2.5,
                'expected' => new Vector2d([1, 2], [7.5, 10]),
            ],
            [
                'vector' => new Vector2d([1, 2], [0, 0]),
                'k' => 2.5,
                'expected' => new Vector2d([1, 2], [0, 0]),
            ],
        ];
    }

    #[DataProvider('provide_multiply_can_return_multiplied_vector_correctly')]
    public function test_multiply_can_return_multiplied_vector_correctly(Vector2d $vector, int|float $k, Vector2d $expected): void
    {
        $this->assertEquals(
            $expected,
            $vector->multiply($k),
        );
    }

    public static function provide_dotProduct_can_return_dot_product_correctly(): array
    {
        return [
            [
                'a' => new Vector2d([1, 2], [3, 4]),
                'b' => new Vector2d([5, 6], [7, 8]),
                'expected' => 3 * 7 + 4 * 8,
            ],
            [
                'a' => new Vector2d([1, 2], [3, 4]),
                'b' => new Vector2d([5, 6], [-7, -8]),
                'expected' => 3 * (-7) + 4 * (-8),
            ],
            [
                'a' => new Vector2d([1, 2], [3, 4]),
                'b' => new Vector2d([5, 6], [4, -3]),
                'expected' => 0,
            ],
            [
                'a' => new Vector2d([1, 2], [3, 0]),
                'b' => new Vector2d([5, 6], [0, 3]),
                'expected' => 0,
            ],
            [
                'a' => new Vector2d([1, 2], [0, 0]),
                'b' => new Vector2d([5, 6], [0, 0]),
                'expected' => 0,
            ],
        ];
    }

    #[DataProvider('provide_dotProduct_can_return_dot_product_correctly')]
    public function test_dotProduct_can_return_dot_product_correctly(Vector2d $a, Vector2d $b, int|float $expected): void
    {
        $this->assertEquals(
            $expected,
            $a->dotProduct($b),
        );
    }

    public static function provide_cos_can_return_cos_correctly(): array
    {
        return [
            [
                'a' => new Vector2d([1, 2], [0, 0]),
                'b' => null,
                'expected' => null,
            ],
            [
                'a' => new Vector2d([1, 2], [1, 0]),
                'b' => null,
                'expected' => 1.0,
            ],
            [
                'a' => new Vector2d([1, 2], [0, 1]),
                'b' => null,
                'expected' => 0.0,
            ],
            [
                'a' => new Vector2d([1, 2], [1, 1]),
                'b' => null,
                'expected' => 1 / sqrt(2),
            ],
            [
                'a' => new Vector2d([1, 2], [-1, 1]),
                'b' => null,
                'expected' => -1 / sqrt(2),
            ],
            [
                'a' => new Vector2d([1, 2], [-1, 0]),
                'b' => null,
                'expected' => -1.0,
            ],
            [
                'a' => new Vector2d([1, 2], [2, 2 * sqrt(3)]),
                'b' => new Vector2d([5, 6], [2 * sqrt(3), 2]),
                'expected' => cos(deg2rad(30)),
            ],
            [
                'a' => new Vector2d([1, 2], [-1, 3]),
                'b' => new Vector2d([5, 6], [3, 1]),
                'expected' => 0.0,
            ],
            [
                'a' => new Vector2d([1, 2], [1, 3]),
                'b' => new Vector2d([5, 6], [2, 6]),
                'expected' => 1.0,
            ],
            [
                'a' => new Vector2d([1, 2], [1, 3]),
                'b' => new Vector2d([5, 6], [-2, -6]),
                'expected' => -1.0,
            ],
        ];
    }

    #[DataProvider('provide_cos_can_return_cos_correctly')]
    public function test_cos_can_return_cos_correctly(Vector2d $a, Vector2d|null $b, float|null $expected): void
    {
        $this->assertTrue(
            $this->isAlmostSame($expected, $a->cos($b))
        );
    }

    public static function provide_degrees_can_return_degrees_correctly(): array
    {
        return [
            [
                'a' => new Vector2d([1, 2], [0, 0]),
                'b' => null,
                'expected' => null,
            ],
            [
                'a' => new Vector2d([1, 2], [1, 0]),
                'b' => null,
                'expected' => 0.0,
            ],
            [
                'a' => new Vector2d([1, 2], [1, 1]),
                'b' => null,
                'expected' => 45.0,
            ],
            [
                'a' => new Vector2d([1, 2], [0, 1]),
                'b' => null,
                'expected' => 90.0,
            ],
            [
                'a' => new Vector2d([1, 2], [-1, 1]),
                'b' => null,
                'expected' => 135.0,
            ],
            [
                'a' => new Vector2d([1, 2], [-1, 0]),
                'b' => null,
                'expected' => 180.0,
            ],
            [
                'a' => new Vector2d([1, 2], [2, 1]),
                'b' => new Vector2d([5, 6], [2, 1]),
                'expected' => 0.0,
            ],
            [
                'a' => new Vector2d([1, 2], [3, 5]),
                'b' => new Vector2d([5, 6], [4, 1]),
                'expected' => 45.0,
            ],
            [
                'a' => new Vector2d([1, 2], [-1, 2]),
                'b' => new Vector2d([5, 6], [4, 2]),
                'expected' => 90.0,
            ],
            [
                'a' => new Vector2d([1, 2], [-1, 2]),
                'b' => new Vector2d([5, 6], [3, -1]),
                'expected' => 135.0,
            ],
            [
                'a' => new Vector2d([1, 2], [-1, 2]),
                'b' => new Vector2d([5, 6], [2, -4]),
                'expected' => 180.0,
            ],
        ];
    }

    #[DataProvider('provide_degrees_can_return_degrees_correctly')]
    public function test_degrees_can_return_degrees_correctly(Vector2d $a, Vector2d|null $b, float|null $expected): void
    {
        $this->assertTrue(
            $this->isAlmostSame($expected, $a->degrees($b))
        );
    }

    public static function provide_radian_can_return_radian_correctly(): array
    {
        return [
            [
                'a' => new Vector2d([1, 2], [0, 0]),
                'b' => null,
                'expected' => null,
            ],
            [
                'a' => new Vector2d([1, 2], [1, 0]),
                'b' => null,
                'expected' => 0.0,
            ],
            [
                'a' => new Vector2d([1, 2], [1, 1]),
                'b' => null,
                'expected' => M_PI / 4,
            ],
            [
                'a' => new Vector2d([1, 2], [0, 1]),
                'b' => null,
                'expected' => M_PI / 2,
            ],
            [
                'a' => new Vector2d([1, 2], [-1, 1]),
                'b' => null,
                'expected' => 3 * M_PI / 4,
            ],
            [
                'a' => new Vector2d([1, 2], [-1, 0]),
                'b' => null,
                'expected' => M_PI,
            ],
            [
                'a' => new Vector2d([1, 2], [2, 1]),
                'b' => new Vector2d([5, 6], [2, 1]),
                'expected' => 0.0,
            ],
            [
                'a' => new Vector2d([1, 2], [3, 5]),
                'b' => new Vector2d([5, 6], [4, 1]),
                'expected' => M_PI / 4,
            ],
            [
                'a' => new Vector2d([1, 2], [-1, 2]),
                'b' => new Vector2d([5, 6], [4, 2]),
                'expected' => M_PI / 2,
            ],
            [
                'a' => new Vector2d([1, 2], [-1, 2]),
                'b' => new Vector2d([5, 6], [3, -1]),
                'expected' => 3 * M_PI / 4,
            ],
            [
                'a' => new Vector2d([1, 2], [-1, 2]),
                'b' => new Vector2d([5, 6], [2, -4]),
                'expected' => M_PI,
            ],
        ];
    }

    #[DataProvider('provide_radian_can_return_radian_correctly')]
    public function test_radian_can_return_radian_correctly(Vector2d $a, Vector2d|null $b, float|null $expected): void
    {
        $this->assertTrue(
            $this->isAlmostSame($expected, $a->radian($b))
        );
    }

    public static function provide_initialPoint_can_return_initial_point_correctly(): array
    {
        return [
            ['vector' => new Vector2d([0, 0], [3, 4]), 'expected' => [0, 0], ],
            ['vector' => new Vector2d([1, 2], [3, 4]), 'expected' => [1, 2], ],
            ['vector' => new Vector2d([-1, -2], [3, 4]), 'expected' => [-1, -2], ],
        ];
    }

    #[DataProvider('provide_initialPoint_can_return_initial_point_correctly')]
    public function test_initialPoint_can_return_initial_point_correctly(Vector2d $vector, array $expected): void
    {
        $this->assertSame($expected, $vector->initialPoint());
    }

    public static function provide_terminalPoint_can_return_terminal_point_correctly(): array
    {
        return [
            ['vector' => new Vector2d([1, 2], [3, 4]), 'expected' => [4, 6], ],
            ['vector' => new Vector2d([1, 2], [0, 0]), 'expected' => [1, 2], ],
            ['vector' => new Vector2d([1, 2], [-3, -4]), 'expected' => [-2, -2], ],
        ];
    }

    #[DataProvider('provide_terminalPoint_can_return_terminal_point_correctly')]
    public function test_terminalPoint_can_return_terminal_point_correctly(Vector2d $vector, array $expected): void
    {
        $this->assertSame($expected, $vector->terminalPoint());
    }

    public static function provide_rotate_can_return_rotated_vector_correctly(): array
    {
        return [
            [
                'vector' => new Vector2d([0, 0], [1, 0]),
                'degrees' => 0.0,
                'expected' => new Vector2d([0, 0], [1, 0]),
            ],
            [
                'vector' => new Vector2d([0, 0], [1, 0]),
                'degrees' => 45.0,
                'expected' => new Vector2d([0, 0], [cos(deg2rad(45.0)), sin(deg2rad(45.0))]),
            ],
            [
                'vector' => new Vector2d([0, 0], [1, 0]),
                'degrees' => 90.0,
                'expected' => new Vector2d([0, 0], [cos(deg2rad(90.0)), sin(deg2rad(90.0))]),
            ],
            [
                'vector' => new Vector2d([0, 0], [1, 0]),
                'degrees' => 135.0,
                'expected' => new Vector2d([0, 0], [cos(deg2rad(135.0)), sin(deg2rad(135.0))]),
            ],
            [
                'vector' => new Vector2d([0, 0], [1, 0]),
                'degrees' => 180.0,
                'expected' => new Vector2d([0, 0], [cos(deg2rad(180.0)), sin(deg2rad(180.0))]),
            ],
            [
                'vector' => new Vector2d([0, 0], [1, 0]),
                'degrees' => 225.0,
                'expected' => new Vector2d([0, 0], [cos(deg2rad(225.0)), sin(deg2rad(225.0))]),
            ],
            [
                'vector' => new Vector2d([0, 0], [1, 0]),
                'degrees' => 270.0,
                'expected' => new Vector2d([0, 0], [cos(deg2rad(270.0)), sin(deg2rad(270.0))]),
            ],
            [
                'vector' => new Vector2d([0, 0], [1, 0]),
                'degrees' => 315.0,
                'expected' => new Vector2d([0, 0], [cos(deg2rad(315.0)), sin(deg2rad(315.0))]),
            ],
            [
                'vector' => new Vector2d([0, 0], [1, 0]),
                'degrees' => 360.0,
                'expected' => new Vector2d([0, 0], [cos(deg2rad(360.0)), sin(deg2rad(360.0))]),
            ],
            [
                'vector' => new Vector2d([1, 2], [3, 4]),
                'degrees' => 0.0,
                'expected' => new Vector2d([1, 2], [3, 4]),
            ],
            [
                'vector' => new Vector2d([1, 2], [4, 3]),
                'degrees' => 90.0,
                'expected' => new Vector2d([1, 2], [5 * cos(acos(4 / 5) + M_PI / 2), 5 * sin(acos(4 / 5) + M_PI / 2)]),
            ],
        ];
    }

    #[DataProvider('provide_rotate_can_return_rotated_vector_correctly')]
    public function test_rotate_can_return_rotated_vector_correctly(Vector2d $vector, float $degrees, Vector2d $expected): void
    {
        $this->assertEquals($expected, $vector->rotate($degrees));
    }
}
