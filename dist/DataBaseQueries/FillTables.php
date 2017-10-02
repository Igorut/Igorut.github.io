<?php
/**
 * Created by PhpStorm.
 * User: Igorut
 * Date: 30.09.2017
 * Time: 17:08
 */

namespace App\DataBaseQueries;

use App\Generators\Random\RandomGenerator;
use PDO;

class FillTables extends RandomGenerator
{
    public function fillTableStaff(int $numberOfStaff): void
    {
        /**
         * Fill table staff with a random data
         * @var $shuffledDepartmentIds
         * @var $surname
         * @var $headOfDepartment
         * @var $shuffledSurnames
         * @var $departmentId
         * @return void
         */
        $shuffledDepartmentIds = $this->department->getShuffledIds();
        $shuffledSurnames = $this->surname->shuffle();
        for ($i = 1; $i <= $numberOfStaff; $i++) {
            $surname = $this->surname->get($shuffledSurnames[random_int(0, count($shuffledSurnames) - 1)]);
            $headOfDepartment = count($shuffledDepartmentIds) < 1
                ? 0
                : random_int(0, 5) === 1
                    ? 1
                    : 0;
            if ($headOfDepartment) {
                $departmentId = array_shift($shuffledDepartmentIds);
                $this->createUserStaff($surname, $headOfDepartment);
                $this->fillLinkTable($departmentId);
                $this->addManager($surname, $departmentId);
            } else {
                $this->newStaff($surname);
            }
        }
    }

    private function newStaff(string $surname): void
    {
        $this->createUserStaff($surname);
        $this->fillLinkTable();
    }

    private function createUserStaff(string $surname, $headOfDepartment = 0): void
    {
        /**
         * Add one employee
         * @return void
         */
        $dateOfBirth = $this->randomDate();
        $query = $this->connection->prepare('
                INSERT INTO staff (initials, surname, age, date_of_birth, head_of_department)
                VALUES ( :initials ,  :surname ,  :age ,
                :dateOfBirth ,  :headOfDepartment )');
        $query->bindValue(':initials', $this->randomInitials());
        $query->bindParam(':surname', $surname, PDO::PARAM_STR, 55);
        $query->bindValue(':age', $this->age->getAge($dateOfBirth), PDO::PARAM_INT);
        $query->bindParam(':dateOfBirth', $dateOfBirth);
        $query->bindParam(':headOfDepartment', $headOfDepartment, PDO::PARAM_INT);
        $query->execute();
    }

    private function addManager(string $managerSurname, int $departmentId): void
    {
        /**
         * Add manager surname into table departments
         * @return void
         */
        $query = $this->connection->prepare('UPDATE departments SET manager_name = :managerSurname 
                                                      WHERE id = :departmentId ');
        $query->bindParam(':managerSurname', $managerSurname, PDO::PARAM_STR, 55);
        $query->bindParam(':departmentId', $departmentId, PDO::PARAM_INT);
        $query->execute();
    }

    public function fillTableDepartments(): void
    {
        /**
         * Fill in the departments table with departments
         * @return void
         */
        $listOfDepartments = $this->department->getList();
        for ($i = 0; $i < $this->department->getCount(); $i++) {
            $query = $this->connection->prepare('INSERT INTO departments (name) VALUES ( :listOfDepartments )');
            $query->bindParam(':listOfDepartments', $listOfDepartments[$i], PDO::PARAM_STR, 55);
            $query->execute();
        }
    }

    private function fillLinkTable(int $departmentIdWithManager = null): void
    {
        /**
         * Fill the table with links
         * @var $departmentId
         * @return void
         */
        if ($departmentIdWithManager) {
            $query = $this->connection->prepare('INSERT INTO linktable (department_id) 
                  VALUES ( :departmentIdWithManager )');
            $query->bindParam(':departmentIdWithManager', $departmentIdWithManager, PDO::PARAM_INT);
            $query->execute();
        } else {
            $query = $this->connection->prepare('INSERT INTO linktable (department_id) 
                  VALUES ( :departmentId )');
            $query->bindValue(':departmentId', random_int(0, $this->department->getCount() - 1), PDO::PARAM_INT);
            $query->execute();
        }
    }
}
