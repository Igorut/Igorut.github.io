<?php
/**
 * Created by PhpStorm.
 * User: Igorut
 * Date: 30.09.2017
 * Time: 17:08
 */

namespace DataBaseQueries;

use RandomGenerator\RandomGenerator;

class FillTables extends RandomGenerator
{
    public function fillTableStaff($numberOfStaff)
    {
        /**
         * Fill table staff with a random data
         * @var $shuffled
         * @var $surname
         * @var $headOfDepartment
         * @var $departmentId
         * @return void
         */
        $shuffled = $this->department->getShuffledIds();
        for ($i = 1; $i <= $numberOfStaff; $i++) {
            $surname = $this->surname->getSurname();
            $headOfDepartment = count($shuffled) < 1
                ? 0
                : random_int(0, 3) === 1
                    ? 1
                    : 0;
            if ($headOfDepartment) {
                $departmentId = array_shift($shuffled);
                $this->createUserStaff($surname, $headOfDepartment);
                $this->fillLinkTable($departmentId);
                $this->addManager($surname, $departmentId);
            } else {
                $this->newStaff($surname);
            }
        }
    }

    private function newStaff($surname)
    {
        $this->createUserStaff($surname);
        $this->fillLinkTable();
    }

    private function createUserStaff($surname, $headOfDepartment = 0)
    {
        /**
         * Add one employee
         * @return void
         */
        $initials = $this->randomInitials();
        $dateOfBirth = $this->randomDate();
        $age = $this->age->getAge($dateOfBirth);
        $this->connection->exec("INSERT INTO `staff` (`initials`, `surname`, `age`, `date_of_birth`, `head_of_department`)
                VALUES ( '$initials' ,  '$surname' ,  '$age' ,
                '$dateOfBirth' ,  '$headOfDepartment' )");
    }

    private function addManager($managerSurname, $departmentId)
    {
        /**
         * Add manager surname into table `departments`
         * @return void
         */
        $this->connection->exec("UPDATE departments SET `manager_name` = '$managerSurname' WHERE `id` = $departmentId ");
    }

    public function fillTableDepartments()
    {
        /**
         * Fill in the `departments` table with departments
         * @return void
         */
        $listOfDepartments = $this->department->getList();
        for ($i = 0; $i < $this->department->getCount(); $i++) {
            $this->connection->exec("INSERT INTO departments (name) 
                  VALUES ( '$listOfDepartments[$i]' )");
        }
    }

    private function fillLinkTable($departmentIdWithManager = false)
    {
        /**
         * Fill the table with links
         * @var $departmentId
         * @return void
         */
        if ($departmentIdWithManager) {
            $this->connection->exec("INSERT INTO `linktable` (`department_id`) 
                  VALUES ( '$departmentIdWithManager' )");
        } else {
            $departmentId = random_int(0, $this->department->getCount() - 1);
            $this->connection->exec("INSERT INTO `linktable` (`department_id`) 
                  VALUES ( '$departmentId' )");
        }
    }
}
