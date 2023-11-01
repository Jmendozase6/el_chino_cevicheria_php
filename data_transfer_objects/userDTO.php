<?php

namespace data_transfer_objects;

class userDTO
{
    private $id;
    private $idRole;
    private $idAddress;
    private $name;
    private $lastName;
    private $img;
    private $email;
    private $password;
    private $active;
    private $createdAt;

    public function __construct($id, $idRole, $idAddress, $name, $lastName, $img, $email, $password, $active, $createdAt)
    {
        $this->id = $id;
        $this->idRole = $idRole;
        $this->idAddress = $idAddress;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->img = $img;
        $this->email = $email;
        $this->password = $password;
        $this->active = $active;
        $this->createdAt = $createdAt;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIdRole($idRole)
    {
        $this->idRole = $idRole;
    }

    public function setIdAddress($idAddress)
    {
        $this->idAddress = $idAddress;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function setImg($img)
    {
        $this->img = $img;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getIDRole()
    {
        return $this->idRole;
    }

    public function getIDAddress()
    {
        return $this->idAddress;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }


}