<?php

namespace Day2\DealWithIt;

use Prophecy\Exception\InvalidArgumentException;

class DealWithIt
{

    /** @var float  */
    private $workTimeWithPreg = 0.00;

    /** @var float  */
    private $workTimeWithoutPreg = 0.00;

    /**
     * @param string $string
     * @return array
     */
    public function hideEmailPreg(string $string): array
    {
        $start = microtime(true);
        $this->emailIsEmpty($string);

        preg_match_all( "#[^\s]+@\S+\.[a-zа-я]{2,3}#ui", $string, $matches);
        $solution = [];

        $this->noEmailInString($matches[0]);

        foreach ($matches[0] as $match) {
            $match = preg_replace('#.#ui', '*', $match);
            array_push($solution, $match);
        }

        $this->workTimeWithPreg = microtime(true) - $start;
        return $solution;
    }

    /**
     * @param string $string
     * @return array
     */
    public function hideEmailNoPreg(string $string): array
    {
        $start1 = microtime(true);
        $this->emailIsEmpty($string);

        $solution = [];
        $massivSlov = explode(' ', $string);

        $matches = [];
        foreach ($massivSlov as $slovo) {
            $meta1 = strpbrk($slovo, '@');
            $meta2 = strpbrk($meta1, '.');
            $meta3 = strpbrk(
                $meta2,
                'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' . PHP_EOL .
                'абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ'
            );
            if ($meta3 != '') {
                array_push($matches, $slovo);
            }
        }

        $this->noEmailInString($matches);

        foreach ($matches as $match) {
            $match = str_repeat('*', mb_strlen($match));
            array_push($solution, $match);
        }

        $this->workTimeWithoutPreg = microtime(true) - $start1;
        return $solution;
    }

    /**
     * @param string $string
     */
    public function emailIsEmpty(string $string)
    {
        if ($string == '') {
            throw new InvalidArgumentException('Строка пуста');
        }
    }

    /**
     * @param array $matches
     */
    public function noEmailInString(array $matches)
    {
        if ($matches == null) {
            throw new InvalidArgumentException('В строке нет емайлов');
        }
    }

    /**
     * @return string
     */
    public function whoFastSpeedwork(): string
    {

        $workTimeWithPreg = $this->workTimeWithPreg;
        $workTimeWithoutPreg = $this->workTimeWithoutPreg;

        if ($workTimeWithPreg > $workTimeWithoutPreg) {
            $whoFastSpeedwork = 'Функция без регулярки быстрее!!!';
        } else {
            $whoFastSpeedwork = 'Функция c регуляркой быстрее!!!';
        }

        return $whoFastSpeedwork;
    }
}
