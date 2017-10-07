<?php

namespace App\Generators\Date;

use DateTime;

/**
 * Created by PhpStorm.
 * User: Igorut
 * Date: 29.09.2017
 * Time: 22:04
 */
class Generator
{
    private $operator;
    private $number;
    private $time;

    public function __construct(string $operator = '', string $number = '', string $time = '')
    {
        /**
         * Setting properties for function changeDate
         */
        $this->operator = $operator;
        $this->number = $number;
        $this->time = $time;
    }

    protected function getCurrentDate(string $format = 'Y-m-d'): \DateTime
    {
        /**
         * Get current server date
         * @return object
         */
        return new DateTime(date($format));
    }

    public function changeDate(string $format = 'Y-m-d'): string
    {
        /**
         * Get changed date
         * @return string
         */
        return $this->getCurrentDate($format)
            ->modify(''
                . $this->operator
                . $this->number . ' '
                . $this->time . '')
            ->format($format);
    }
}