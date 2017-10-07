<?php

namespace App\Generators\Random;

use App\Generators\Department\Generator as DepartmentGenerator;
use App\Generators\Date\Generator as DateGenerator;
use App\Generators\Surname\Generator as SurnameGenerator;
use App\Generators\Age\Generator as AgeGenerator;
use App\DB\Database;

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
         * Setting all properties for connect to database and data generator of tables 'staff' and 'departments'
         */
        $this->surname = new SurnameGenerator();
        $this->age = new AgeGenerator();
        $this->department = new DepartmentGenerator();
        $this->beginDate = new DateGenerator('-', '60', 'years');
        $this->endDate = new DateGenerator('-', '20', 'years');
        $this->connection = new Database();
        $this->connection = $this->connection->connect();
    }

    public function randomDate(string $format = 'Y-m-d'): string
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