### Reversed Strings
Необходимо инвертировать строку
```php
$reverse->solution("world"); // returns "dlrow"
```

### Gauß needs help!
Необходимо посчитать сумму чисел до данного
```php
$sum->get(100); // returns 5050
$sum->get(3); // returns 6
```

## Count it!
Необходимо найти число вхождений какой-нибудь выбранной вами цифры в выбранном вами числе.
```php
$counter->count(5, 442158755745); // returns 4
``` 

## Brevity is the soul of wit
Необходимо создать сокращенный вариант ФИО
```php
$name->cut('Сомов Игорь Андреевич'); // returns 'Сомов И. А.'
```

## FizzBuzz
Необходимо заменить число, которое делится на 3 без остатка на fizz, а то, которое делится на 5 без остатка на buzz.
Если делится и на то и на то, то записать fizzbuzz.
```php
$fb->get(1); // returns 1
$fb->get(2); // returns 2
$fb->get(3); // returns 'fizz'
$fb->get(5); // returns 'buzz'
$fb->get(9); // returns 'fizz'
$fb->get(15); // returns 'fizzbuzz'
```

## Avito parser
Необходимо из строки получить телефон и ссылки
```php
$string = "Произвольная строка, которая иногда содержит +7(985)808-86-90 телефоны, а иногда <a href='https://example.com'>ссылки</a>";
$p = new Parser($string);
$p->getLinks(); // returns ['https://example.com/']
$p->getPhones(); // returns ['+7(985)808-86-90']
```

## Tic-Tac-Toe
Необходимо определить кто выйграл в крестики-нолики.
null - незаполненная клетка
необходимо вернуть false, если ничья, или 'o' или 'x' если победили нули или кресты соответственно
```php
$ttt = [
    ['o','x','o'],
    ['x','o','o'],
    ['x','o',null],
];

$tttFull = [
    ['o','x','o'],
    ['x','o','o'],
    ['x','o','x'],
];
$judge->check($ttt); // returns false
$judge->check($tttFull); // returns false
```

```php
$ttt = [
    ['o','x','o'],
    ['x','o','x'],
    ['x','o','o'],
];
$judge->check($ttt); // returns 'o'
```

### Get second max
Найдите второй по величине элемент в массиве, после максимального.

Пример: array(3, 4, 2, 4, 5, 5) - максимальный элемент - 5, после него самый максимальный - 4.
Вот эту четверку нам и надо найти.
```php
$arr = [3, 4, 2, 4, 5, 5];
$yardstick->getSecond($arr); // returns 4
```

## Homestead. You have arrived.
Установить Homestead:
https://laravel.com/docs/master/homestead
