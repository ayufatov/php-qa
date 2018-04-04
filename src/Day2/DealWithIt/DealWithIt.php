<?php

namespace Day2\DealWithIt;

class DealWithIt
{

    /**
     * @param string $string
     * @return array
     */
    public function hideEmail(string $string): array
    {
        preg_match_all( "#[^\s]+@\S+\.[a-zа-я]{2,3}#ui", $string, $matches);
        $solution = [];

        foreach ($matches[0] as $match) {
            $match = preg_replace('#.#ui', '*', $match);
            array_push($solution, $match);
        }

        return $solution;
    }

    /**
     * @param string $string
     * @return array
     */
    public function hideEmailNoPreg(string $string): array
    {

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

        foreach ($matches as $match) {
            $match = str_repeat('*', mb_strlen($match));
            array_push($solution, $match);
        }

        return $solution;
    }
}
