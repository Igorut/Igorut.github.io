<?php
/**
 * Created by PhpStorm.
 * User: Igorut
 * Date: 01.10.2017
 * Time: 23:36
 */

namespace DataBaseQueries;

use DB\Params\Params;
use PDO;

trait CreateDB
{
    use Params;

    public function createDB(): void
    {
        /**
         * Dropping database and creating it again
         * @return void
         */
        $db = new PDO('mysql:host=' . $this->host . '', $this->user,
            $this->password);
        $db->exec('DROP DATABASE IF EXISTS ' . $this->dbname);
        $db->exec('CREATE DATABASE ' . $this->dbname . ' CHARACTER SET utf8 COLLATE utf8_general_ci');
        $db = null;
    }
}