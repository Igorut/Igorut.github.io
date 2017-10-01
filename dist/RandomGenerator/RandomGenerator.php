<?php

namespace RandomGenerator;

use Departments\DepartmentGenerator;
use RandomResource\Date\DateFormatter;
use StaffInformation\Surname\SurnameGenerator;
use StaffInformation\Age\AgeGetter;
use DB\Database;

/**
 * Created by PhpStorm.
 * User: Igorut
 * Date: 29.09.2017
 * Time: 21:49
 */
class RandomGenerator
{
    protected $surname, $age, $department, $connection;
    private $beginDate, $endDate;

    public function __construct()
    {
        /**
         * Setting all properties for connect to database and data of tables 'staff' and 'departments'
         */
        $this->surname = new SurnameGenerator();
        $this->age = new AgeGetter();
        $this->department = new DepartmentGenerator();
        $this->beginDate = new DateFormatter('-', '60', 'years');
        $this->endDate = new DateFormatter('-', '20', 'years');
        $this->connection = new Database();
        $this->connection = $this->connection->connect();
    }

    public function randomDate($format = 'Y-m-d')
    {
        /**
         * Get a random date between borders
         * @return string
         */
        return date($format,
            random_int(
                strtotime($this->beginDate->changeDate($format)),
                strtotime($this->endDate->changeDate($format))
            ));
    }

    public function randomInitials(): string
    {
        /**
         * Get a random initials
         * @return string
         */
        $characters = ['А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'К', 'Л', 'М', 'Л', 'П', 'Р', 'С', 'Т', 'У', 'Э', 'Ю', 'Я'];
        return $characters[random_int(0, count($characters) - 1)] . '.' . $characters[random_int(0, count($characters) - 1)] . '.';
    }
}