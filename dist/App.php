<?php

namespace App;

use App\Buttons\BuildButton;
use App\Buttons\ResponseButton;
use App\DataBaseQueries\CreateDB;
use App\DataBaseQueries\CreateTable;
use App\DataBaseQueries\FillTables;

require_once '../vendor/autoload.php';

class App extends FillTables
{
    use CreateDB, CreateTable, BuildButton, ResponseButton;

    public function getPersonal(int $numberOfGet): array
    {
        $results = $this->connection->query('SELECT staff.initials, staff.surname,
                        staff.age, staff.date_of_birth, departments.name AS department,
                        departments.manager_name
                        FROM departments 
                        INNER JOIN linktable 
                        ON departments.id = linktable.department_id
                        LEFT JOIN staff 
                        ON staff.id = linktable.staff_id
                        LIMIT ' . $numberOfGet);
        $i = 0;
        $information = [];
        while ($row = $results->fetch()) {
            $information[$i]['initials'] = $row['initials'];
            $information[$i]['surname'] = $row['surname'];
            $information[$i]['age'] = $row['age'];
            $information[$i]['date_of_birth'] = $row['date_of_birth'];
            $information[$i]['department_name'] = $row['department'];
            $information[$i]['manager_name'] = $row['manager_name'];
            $i++;
        }
        return $information;
    }

    public function buildDB(int $numberOfStaff): void
    {
        $this->createDB();
        $this->createTableDepartments();
        $this->createTableStaff();
        $this->createLinkTable();
        $this->fillTableDepartments();
        $this->fillTableStaff($numberOfStaff);

        echo 'Завершено!';
    }
}
