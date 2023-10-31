<?php

namespace data_access_objects;

require_once '../datasource/connection.php';

class userDAO
{
    public $con;

    public function __construct()
    {
        $this->con = Connection::getInstance();
        echo $this->con;
    }

}

$userDAO = new userDAO();
