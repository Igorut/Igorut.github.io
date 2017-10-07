<?php

namespace App\Generators\Age;

use App\Generators\Date\Generator as DateGenerator;
use DateTime;

/**
 * Created by PhpStorm.
 * User: Igorut
 * Date: 30.09.2017
 * Time: 10:53
 */
class Generator extends DateGenerator
{
    public function getAge($dateOfBirth): int
    {
        /**
         * Calculating the exact age
         * @return int|string
         */
        $dateOfBirth = new DateTime($dateOfBirth);

        if ($this->getCurrentDate()->format('m-d') > $dateOfBirth->format('m-d')) {
            return $this->getCurrentDate()->format('Y') - $dateOfBirth->format('Y');
        }
        return $this->getCurrentDate()->format('Y') - $dateOfBirth->format('Y') - 1;
    }
}
