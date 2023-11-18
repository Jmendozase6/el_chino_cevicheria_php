<?php

namespace data_transfer_objects;

class RoleDTO
{

    private int $id;
    private string $role;


    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setRole($role): void
    {
        $this->role = $role;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRole(): string
    {
        return $this->role;
    }

}