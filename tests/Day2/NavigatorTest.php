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
    /*
    $routes = [];
$routes[] = new Route(['from'=>'a', 'to'=>'b', 'price'=>100]);
$routes[] = new Route(['from'=>'c', 'to'=>'d', 'price'=>300]);
$routes[] = new Route(['from'=>'b', 'to'=>'c', 'price'=>200]);
$routes[] = new Route(['from'=>'a', 'to'=>'d', 'price'=>900]);
$routes[] = new Route(['from'=>'b', 'to'=>'d', 'price'=>300]);

$find->shortestPath('a', 'd', $routes);
return информации типа:

Из: a
В: d
Путь: a -> b -> d
Цена: 400
    */

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
    }
}
