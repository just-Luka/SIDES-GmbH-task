<?php

namespace App\data\models;

use App\core\DBConnection;

abstract class BaseModel
{
    /**
     * @return \mysqli
     */
    protected function db()
    {
        return DBConnection::getInstance()->getConnection();
    }

    /**
     * @param $sql
     * @return bool
     */
    public function isQuerySuccess($sql)
    {
        if ($this->db()->query($sql) === TRUE){
            return true;
        }
        return false;
    }
}