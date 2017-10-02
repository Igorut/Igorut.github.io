<?php
/**
 * Created by PhpStorm.
 * User: Igorut
 * Date: 01.10.2017
 * Time: 22:53
 */

namespace App\DataBaseQueries;

trait CreateTable
{
    public function createTableStaff(): bool
    {
        /**
         * Create table `staff`
         * @return bool
         */
        if ($this->connection
            ->exec('CREATE TABLE IF NOT EXISTS staff ( id INT(11) NOT NULL AUTO_INCREMENT ,
                      initials VARCHAR(20) NOT NULL , surname VARCHAR(55) NOT NULL , age INT(3) NOT NULL , 
                      date_of_birth DATE NOT NULL , head_of_department INT(1) NULL DEFAULT NULL ,
                       PRIMARY KEY (id)) ENGINE = InnoDB CHARSET=utf8 
                      COLLATE utf8_general_ci')) {
            return true;
        }
        return false;
    }

    public function createTableDepartments(): bool
    {
        /**
         * Create table `departments`
         * @return bool
         */
        if ($this->connection
            ->exec('CREATE TABLE `departments` ( `id` INT(11) NOT NULL AUTO_INCREMENT ,
                            `name` VARCHAR(55) NOT NULL , `manager_name` VARCHAR(55) NULL , PRIMARY KEY (`id`)) 
                            ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci')) {
            return true;
        }
        return false;
    }

    public function createLinkTable(): bool
    {
        /**
         * Create table `linktable`
         * @return bool
         */
        if ($this->connection
            ->exec('CREATE TABLE IF NOT EXISTS linktable ( staff_id INT(11) NOT NULL AUTO_INCREMENT , 
                                        department_id INT(11) NOT NULL , PRIMARY KEY (`staff_id`)) 
                                        ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci')) {
            return true;
        }
        return false;
    }

}