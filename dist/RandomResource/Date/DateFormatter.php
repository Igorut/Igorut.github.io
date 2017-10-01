<?php

namespace RandomResource\Date;

use DateTime;

/**
 * Created by PhpStorm.
 * User: Igorut
 * Date: 29.09.2017
 * Time: 22:04
 */
class DateFormatter
{
    private $operator;
    private $number;
    private $time;

    public function __construct($operator = '', $number = '', $time = '')
    {
        /**
         * Setting properties for function changeDate
         */
        $this->operator = $operator;
        $this->number = $number;
        $this->time = $time;
    }

    protected function getCurrentDate($format = 'Y-m-d'): \DateTime
    {
        /**
         * Get current server date
         * @return object
         */
        return new DateTime(date($format));
    }

    public function changeDate($format = 'Y-m-d'): string
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