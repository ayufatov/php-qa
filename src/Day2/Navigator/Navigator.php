<?php

namespace Day2\Navigator;

class Navigator
{
    /** @var array  */
    private $routes = [];

    /** @var array  */
    private $location = [];

    /** @var array  */
    private $visitedLocation = [];

    /** @var array  */
    private $bestPriceForLocation = [];

    /** @var array  */
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
                // Задаем начальный путь до каждого пункта равный '', а для начального 'a'
        $this->setBestPathForLocation();
                // Находим вершину с наидешевым путем от текущей не посещенной вершины из соседних
                // Помечаем текущий элемент как посещенный
        $this->visitedLocation[$currentLocation] = true;

                // Проверяем ближайшие вершины к текущей и обновляем их стоимость и пути
        foreach ($this->location as $location) {
            $this->mainAlgoritm($this->getAllRoutesFromLocation($currentLocation));
            $currentLocation = $this->availibleLocationWithPathHaveMinPriceForThisLocation($currentLocation);
            // Помечаем текущий элемент как посещенный
            $this->visitedLocation[$currentLocation] = true;
        }

                // Записываем путь в нужном формате
        $bestPath = '';
        for($i = 0; $i < strlen($this->bestPathForLocation[$to]); $i++) {
            $bestPath .= substr($this->bestPathForLocation[$to], $i, 1);
            if ($i < strlen($this->bestPathForLocation[$to]) - 1) {
                $bestPath .= ' -> ';
            }
        }

                // Вывод решения
        $bestPrice = $this->bestPriceForLocation[$to];

                // Если решения нет, то вывести 'No path' с ценой 0
        if ($bestPath == '') {
            $bestPath = 'No path';
            $bestPrice = 0;
        }

        $solution = [
            "Из: $from",
            "В: $to",
            "Путь: $bestPath",
            "Цена: $bestPrice",
        ];

        return $solution;
    }

    // Вычисляем все возможные локации $location
    private function setLocations()
    {
        $routes = $this->routes;
        $location = $this->location;
        count($routes);
        foreach ($routes as $routFrom) {
            array_push($location, $routFrom['from']);
        }

        foreach ($routes as $routTo) {
            array_push($location, $routTo['to']);
        }

        // Массив со всеми локациями
        $this->location = array_unique($location);
    }

    // Задаем признак обработки вершины
    private function setVisitedLocation()
    {
        $location = $this->location;
        $visitedLocation =[];
        foreach ($location as $currentLocation) {
            $visitedLocation += [
                $currentLocation => false,
            ];
        }

        $this->visitedLocation = $visitedLocation;
    }

    // Задаем начальную стоимость до каждого пункта равную 999999 а для начального 0
    private function setBestPriceForLocation()
    {
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
    }

    // Задаем начальный путь до каждого пункта равный '', а для начального 'a'
    private function setBestPathForLocation()
    {

        $bestPathForLocation = $this->bestPathForLocation;

        foreach ($this->location as $currentLocation) {
            if ($currentLocation == $this->from) {
                $bestPathForLocation += [
                    $currentLocation => $currentLocation,
                ];
            } else {
                $bestPathForLocation += [
                    $currentLocation => '',
                ];
            }
        }
        $this->bestPathForLocation = $bestPathForLocation;
    }

    // Находим вершину с наидешевым путем от текущей не посещенной вершины из соседних
    private function availibleLocationWithPathHaveMinPriceForThisLocation(string $thisLocation): string
    {
        $availibleLocation = $thisLocation;

        // Вызовем функцию которая вернет массив путей для текущей вершины
        $routesFromLocation = $this->getAllRoutesFromLocation($availibleLocation);

        // Достаем все вершины куда можно пройти от текущей вершины
        $nearLocation = [];

        foreach ($routesFromLocation as $route) {
            $nearLocation += [$route['to'] => $this->bestPriceForLocation[$route['to']]];
        }

        // Проверяем, если есть доступная вершина с лучшей ценой меньше чем текущая вершина, то она становится текущей
        foreach ($nearLocation as $location => $price) {
            if (!$this->visitedLocation[$location]) {
                if (
                    $price <= $this->bestPriceForLocation[$availibleLocation]
                        || ($this->bestPriceForLocation[$availibleLocation] == 0)
                ) {
                    $availibleLocation = $location;
                }
            }
        }

        return $availibleLocation;
    }

    private function mainAlgoritm(array $allRouteFromLocation)
    {
        /* Если лучшая стоимость соседней вершины > лучшая стоимость текущей + стоимость пути от текущей к соседней, то
        изменим лучшая стоимость соседней вершины = лучшая стоимость текущей + стоимость пути от текущей к соседней и
        лучшая длина пути до соседней вершины = длина пути до текущей + соседняя вершина

        На вход получаем соседнюю вершину, текущую вершину
        В результате присваиваем лучшую цену соседней вершины и лучший путь до соседней вершины
        */
        foreach ($allRouteFromLocation as $route) {
            if (
                $this->bestPriceForLocation[$route['to']] >
                ($this->bestPriceForLocation[$route['from']] + $route['price'])
            ) {
                $this->bestPriceForLocation[$route['to']] =
                    $this->bestPriceForLocation[$route['from']] + $route['price'];
                $this->bestPathForLocation[$route['to']] =
                    $this->bestPathForLocation[$route['from']] . $route['to'];
            }
        }
    }

    // Находим все пути из текущей локации
    private function getAllRoutesFromLocation(string $thisLocation): array
    {
        $allRouteFromLocation = [];
        foreach ($this->routes as $route){
            if ($route['from'] == $thisLocation){
                array_push($allRouteFromLocation, $route);
            }
        }

        return $allRouteFromLocation;
    }
}
