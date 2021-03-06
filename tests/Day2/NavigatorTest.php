<?php

namespace Tests\Day2;

use Day2\Navigator\Navigator;
use PHPUnit\Framework\TestCase;

class NavigatorTest extends TestCase
{
    /** @var  Navigator */
    private $navigator;

    public function setUp()
    {
        $this->navigator = new Navigator();
    }

    /**
     * @dataProvider successfulProvider
     * @param string $from
     * @param string $to
     * @param string $path
     * @param int $price
     */
    public function test_navigator_successful(string $from, string $to,string $path, int $price, array $routes)
    {

        $this->assertEquals(
            ["Из: $from", "В: $to", "Путь: $path", "Цена: $price"],
            $this->navigator->cheaperShortestPath($from, $to, $routes)
        );
    }

    public function successfulProvider()
    {
        // Навигатор 1
        yield
        [
            'a',
            'd',
            'a -> b -> d',
            400,
            [
                ['from'=>'a', 'to'=>'b', 'price'=>100],
                ['from'=>'c', 'to'=>'d', 'price'=>300],
                ['from'=>'b', 'to'=>'c', 'price'=>200],
                ['from'=>'a', 'to'=>'d', 'price'=>900],
                ['from'=>'b', 'to'=>'d', 'price'=>300],
            ]
        ];

        // Навигатор 2
        yield
        [
            'a',
            'c',
            'a -> b -> c',
            300,
            [
                ['from'=>'a', 'to'=>'b', 'price'=>100],
                ['from'=>'c', 'to'=>'d', 'price'=>300],
                ['from'=>'b', 'to'=>'c', 'price'=>200],
                ['from'=>'a', 'to'=>'d', 'price'=>900],
                ['from'=>'b', 'to'=>'d', 'price'=>300],
            ]
        ];

        // Навигатор 3
        yield
        [
            'b',
            'd',
            'b -> d',
            300,
            [
                ['from'=>'a', 'to'=>'b', 'price'=>100],
                ['from'=>'c', 'to'=>'d', 'price'=>300],
                ['from'=>'b', 'to'=>'c', 'price'=>200],
                ['from'=>'a', 'to'=>'d', 'price'=>900],
                ['from'=>'b', 'to'=>'d', 'price'=>300],
            ]
        ];

        // Кейс когда нет пути
        yield
        [
            'd',
            'b',
            'No path',
            0,
            [
                ['from'=>'a', 'to'=>'b', 'price'=>100],
                ['from'=>'c', 'to'=>'d', 'price'=>300],
                ['from'=>'b', 'to'=>'c', 'price'=>200],
                ['from'=>'a', 'to'=>'d', 'price'=>900],
                ['from'=>'b', 'to'=>'d', 'price'=>300],
            ]
        ];

        yield
        [
            'a',
            'd',
            'a -> b -> d',
            300,
            [
                ['from'=>'a', 'to'=>'b', 'price'=>100],
                ['from'=>'c', 'to'=>'d', 'price'=>300],
                ['from'=>'b', 'to'=>'c', 'price'=>200],
                ['from'=>'a', 'to'=>'d', 'price'=>900],
                ['from'=>'b', 'to'=>'d', 'price'=>300],
                ['from'=>'b', 'to'=>'d', 'price'=>200],
            ]
        ];

        // Расширенный навигатор 1
        yield
        [
            'a',
            'v',
            'a -> b -> d -> v',
            600,
            [
                ['from'=>'a', 'to'=>'b', 'price'=>100],
                ['from'=>'c', 'to'=>'d', 'price'=>300],
                ['from'=>'b', 'to'=>'c', 'price'=>200],
                ['from'=>'a', 'to'=>'d', 'price'=>900],
                ['from'=>'b', 'to'=>'d', 'price'=>300],
                ['from'=>'d', 'to'=>'v', 'price'=>200],
            ]
        ];

        // Расширенный навигатор 2
        yield
        [
            'a',
            'v',
            'a -> b -> c -> v',
            350,
            [
                ['from'=>'a', 'to'=>'b', 'price'=>100],
                ['from'=>'c', 'to'=>'d', 'price'=>300],
                ['from'=>'b', 'to'=>'c', 'price'=>200],
                ['from'=>'a', 'to'=>'d', 'price'=>900],
                ['from'=>'b', 'to'=>'d', 'price'=>300],
                ['from'=>'d', 'to'=>'v', 'price'=>200],
                ['from'=>'c', 'to'=>'v', 'price'=>50],
            ]
        ];
    }
}
