<?php

namespace StaffInformation\Surname;

/**
 * Created by PhpStorm.
 * User: Igorut
 * Date: 30.09.2017
 * Time: 9:55
 */
class SurnameGenerator
{
    private $surnames;

    public function __construct()
    {
        /**
         * Load surnames
         */
        $this->surnames = file(__DIR__ . '/surnames.txt', FILE_IGNORE_NEW_LINES);
    }

    private function getWomanSurname($surname)
    {
        /**
         * Correct the name for the female species
         * @return mixed
         */
        $surname = preg_replace('/^(.+)(ов|ев|ёв|ин|ын)$/u', '$1$2а', $surname);
        $surname = preg_replace('/^(.+)(ый|ий)$/u', '$1ая', $surname);
        return $surname;
    }

    public function shuffleSurnames()
    {
        /**
         * Shuffle array of surnames
         * @return mixed
         */
        shuffle($this->surnames);
        return array_shift($this->surnames);
    }

    public function getSurname(array $man = [true, false]): string
    {
        /**
         * Get random male or female surname
         * @return string
         */
        $surname = $this->shuffleSurnames();
        return $man[random_int(0, 1)] ? $surname : $this->getWomanSurname($surname);
    }
}