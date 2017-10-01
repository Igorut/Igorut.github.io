<?php
namespace StaffInformation\Age;

use RandomResource\Date\DateFormatter;
use DateTime;
/**
 * Created by PhpStorm.
 * User: Igorut
 * Date: 30.09.2017
 * Time: 10:53
 */
class AgeGetter extends DateFormatter
{
    public function getAge($dateOfBirth)
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
