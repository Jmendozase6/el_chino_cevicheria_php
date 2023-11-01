<?php

namespace data_transfer_objects;

class RoleDTO
{

    private $id;
    private $role;

    public function __construct($id, $role)
    {
        $this->id = $id;
        $this->role = $role;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRole()
    {
        return $this->role;
    }

}