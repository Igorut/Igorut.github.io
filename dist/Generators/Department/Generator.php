<?php

namespace App\Generators\Department;

/**
 * Created by PhpStorm.
 * User: Igorut
 * Date: 30.09.2017
 * Time: 14:46
 */
class Generator
{
    private $departments;

    public function __construct()
    {
        /**
         * Load departments
         */
        $this->departments = file(__DIR__ . '/departments.txt', FILE_IGNORE_NEW_LINES);
    }

    public function getCount(): int
    {
        /**
         * Get count of departments
         * @return int
         */
        return count($this->departments);
    }

    public function getList(): array
    {
        return $this->departments;
    }

    public function getShuffledIds(): array
    {
        /**
         * Here we get Ids of departments in shuffle.
         * @return array
         */
        $department_ids = $this->normalizeArray();
        shuffle($department_ids);
        return $department_ids;
    }

    private function normalizeArray(): array
    {
        /**
         * Removing id 0 from array of departments and add last id for normalize ids
         */
        $department_ids = array_keys($this->departments);
        $department_ids[] = $this->getCount();
        array_shift($department_ids);
        return $department_ids;
    }
}