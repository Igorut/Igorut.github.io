<?php

namespace DB;

use DB\Params\Params;
use PDO;

/**
 * Created by PhpStorm.
 * User: Igorut
 * Date: 28.09.2017
 * Time: 17:13
 */
class Database
{
    use Params;

    public function connect(): \PDO
    {
        /**
         * Get connection to DB
         * @return object
         */
        $con = new PDO(
            'mysql:host='
            . $this->host
            . ';dbname=' . $this->dbname
            . ';charset=UTF8'
            , $this->user, $this->password
        );
        return $con;
    }
}
