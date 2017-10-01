<?php
/**
 * Created by PhpStorm.
 * User: Igorut
 * Date: 01.10.2017
 * Time: 22:59
 */

namespace DB\Params;


trait Params
{
    /**
     * Set DataBase params here
     */
    public $host = 'localhost';
    public $dbname = 'test';
    public $user = 'root';
    public $password = '';
}