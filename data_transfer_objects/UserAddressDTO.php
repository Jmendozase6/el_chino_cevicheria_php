<?php

namespace data_transfer_objects;

class UserAddressDTO
{

    private int $id;
    private int $userId;
    private string $address;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId($userId): void
    {
        $this->$userId = $userId;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress($address): void
    {
        $this->address = $address;
    }

}