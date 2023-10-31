<?php

namespace data_transfer_objects;

class userAddressDTO
{

    private $id;
    private $userId;
    private $address;

    public function __construct($id, $userId, $address)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->address = $address;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->$userId = $userId;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

}