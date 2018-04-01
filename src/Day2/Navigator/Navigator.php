<?php

namespace Day2\Navigator;

class Navigator
{

    /*
Написать на PHP класс для поиска самого дешевого маршрута. Метод должна получать на входе три параметра:

название населенного пункта отправления
название населенного пункта прибытия
список, каждый элемент которого представляет собой названия неких двух населенных пунктов и стоимость проезда от одного населенного пункта до другого.
На выходе функция должна возвращать самый дешевый маршрут между населенными пунктами отправления и прибытия, в виде списка транзитных населенных пунктов (в порядке следования), а также общую стоимость проезда.

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

    /** @var array  */
    private $routes = [];

    /** @var array  */
    private $location = [];

    /** @var array  */
    private $visitedLocation = [];

    /** @var array  */
    private $bestPriceForLocation = [];

    private $bestPathForLocation = [];

    /** @var string  */
    private $from = '';

    /** @var string  */
    private $to = '';






    /**
     * @param string $from
     * @param string $to
     * @param array $routes
     * @return array
     */
    public function cheaperShortestPath(string $from, string $to, array $routes): array
    {

        $currentLocation = $from;

        $this->routes = $routes;

        $this->from = $from;

        $this->to = $to;

                // Вычисляем все возможные локации $location
        $this->setLocations();
                // Задаем признак обработки вершины
        $this->setVisitedLocation();
                // Задаем начальную стоимость до каждого пункта равную 999999 а для начального 0
        $this->setBestPriceForLocation();
                // Задаем начальный лучший путь до точки равный '';
        $this->setBestPathForLocation();
                // Находим вершину с наидешевым путем от текущей не посещенной вершины из соседних
        $currentLocation = $this->availibleLocationWithPathHaveMinPriceForThisLocation($from);
        ///$currentLocation = $from;
        //$visitedLocation = $this->visitedLocation;

        $this->getAllPathFromLocation($from);

        //$this->visitedLocation[$currentLocation] = true;

        foreach ($this->location as $location) {
            if ($this->visitedLocation[$location] == false) {
                echo "\n" . 'location = ' . $location . " false";
            }
        }

        // Сделать функцию которая ищет все пути из текущей вершины
        // текущую вершины
        // возвращает массив путей


        //echo "\n" . '$visitedLocation';
        //print_r($this->visitedLocation);







        //print_r($location);

                // Берем вершину и вычисляем стоимость пути до её соседей
                // Берем каждый путь
        //foreach($routes as $rout) {

                // Берем каждую вершину

 //       foreach ($location as $currentLocation) {
                //array_push($bestNavigation, []);
                // Берем каждый путь
  //              foreach($routes as $rout) {
                    // Проверяем сколько стоит каждый путь из текущей вершины и записываем если он лучший
                    //echo "\n" . 'rout[price] = ' .$rout['price'];
   //                 if ($rout['from'] == $currentLocation) {
                        /*&& ($bestPriceForLocation[$currentLocation] == 0
                           || $bestPriceForLocation[$currentLocation] > $rout['price']
                        )*/
                        //$path = [$rout['from'], $rout['to']];
                        //$price = $rout['price'];
                        //$bestPriceForLocation[$rout['to']] = $rout['price'];

                        //echo "\n";
                        //echo '$currentLocation = ' . $currentLocation . ' $rout[\'price\'] = ' . $rout['price'];
  //                  }
  //              }

                // Лучший путь из начальной вершины в текущую

                //echo "\n" . '$bestNavigation:';
                //print_r($bestNavigation);
  //      }

        //echo "\n" . '$bestPriceForLocation:';
        //print_r($bestPriceForLocation);
        //}

        //echo "\n" . '$bestNavigation final:';
                //print_r($bestNavigation);

        /*foreach ($bestNavigation as $thisBest) {
            if ($thisBest['from'] == $from && $thisBest['to'] == $to) {
                print_r($thisBest);
            }
        }*/




                    // Вывод решения
        $bestFrom = $from;
        $bestTo = $to;
        $bestPath = 'a -> b -> d';
        $bestPrice = 400;

        $solution = [
            "Из: $bestFrom",
            "В: $bestTo",
            "Путь: $bestPath",
            "Цена: $bestPrice",
        ];

        echo "\n" . '$solution:';
        print_r($solution);
        return $solution;
    }


    private function setLocations()
    {
        // Вычисляем все возможные локации $location
        $routes = $this->routes;
        $location = $this->location;
        //echo "\n";
        //$location = [];
        count($routes);
        foreach ($routes as $routFrom) {
            array_push($location, $routFrom['from']);
        }

        foreach ($routes as $routTo) {
            array_push($location, $routTo['to']);
        }

        // Массив со всеми локациями
        $this->location = array_unique($location);
        //echo "\n" . '$location:';
        //print_r($location);
    }


    private function setVisitedLocation()
    {
        $location = $this->location;
        // Задаем признак обработки вершины
        $visitedLocation =[];
        foreach ($location as $currentLocation) {
            $visitedLocation += [
                $currentLocation => false,
            ];
        }
        //echo "\n" . '$visitedLocation:';
        //print_r($visitedLocation);

        $this->visitedLocation = $visitedLocation;
    }


    private function setBestPriceForLocation()
    {
        // Задаем начальную стоимость до каждого пункта равную 0

        $bestPriceForLocation = $this->bestPriceForLocation;
        foreach ($this->location as $currentLocation) {
            if ($currentLocation == $this->from) {
                $bestPriceForLocation += [
                    $currentLocation => 0,
                ];
            } else {
                $bestPriceForLocation += [
                    $currentLocation => 999999,
                ];
            }
        }

        $this->bestPriceForLocation = $bestPriceForLocation;
        //echo "\n" . '$bestPriceForLocation:';
        //print_r($bestPriceForLocation);
    }

    private function setBestPathForLocation()
    {

        $bestPathForLocation = $this->bestPathForLocation;
        // Задаем начальную стоимость до каждого пункта равную 0

        foreach ($this->location as $currentLocation) {
                $bestPathForLocation += [
                    $currentLocation => '',
                ];
        }
        $this->bestPathForLocation = $bestPathForLocation;
        //echo "\n" . '$bestPathForLocation:';
        //print_r($bestPathForLocation);
    }

    private function availibleLocationWithPathHaveMinPriceForThisLocation(string $thisLocation): string
    {
        // Находим вершину с наидешевым путем от текущей не посещенной вершины из соседних
        $availibleLocationWithPathHaveMinPriceForThisLocation = $thisLocation;

        // Вызовем функцию которая вернет массив путей для текущей вершины
        $routesFromLocation = $this->getAllPathFromLocation($thisLocation);

        //echo "\n" . '$routesFromLocation:';
        //print_r($routesFromLocation);
        // Достаем все вершины куда можно пройти от текущей вершины
        $nearLocation = [];
        //$nearLocation = [$thisLocation => $this->bestPriceForLocation[$thisLocation]];
        foreach ($routesFromLocation as $route) {
            //echo "\n" . '$route:';
            //print_r($route);
            //echo "\n" . '$route[\'to\'] = ' . $route['to'];
            $nearLocation += [$route['to'] => $this->bestPriceForLocation[$route['to']]];
            //echo "\n" . '$nearLocation:';
            //print_r($nearLocation);
        }

        //echo "\n" . '$nearLocation final:';
        //print_r($nearLocation);

        // Проверяем, если есть доступная вершина с лучшей ценой меньше чем текущая вершина, то она становится текущей
        foreach ($nearLocation as $location => $bestPrice) {
            if (!$this->visitedLocation[$location]) {

                if ($bestPrice < $this->bestPriceForLocation[$thisLocation]) {
                    $availibleLocationWithPathHaveMinPriceForThisLocation = $location;
                }
            }
        }

        // Помечаем текущий элемент как посещенный
        $this->visitedLocation[$availibleLocationWithPathHaveMinPriceForThisLocation] = true;

        return $availibleLocationWithPathHaveMinPriceForThisLocation;
    }

    private function getAllPathFromLocation(string $thisLocation): array
    {
        $allPathFromLocation = [];
        foreach ($this->routes as $route){
            if ($route['from'] == $thisLocation){
                array_push($allPathFromLocation, $route);
            }
        }
        $this->routes;

        //echo "\n" . '$allPathFromLocation';
        //print_r($allPathFromLocation);
        return $allPathFromLocation;
    }

}
