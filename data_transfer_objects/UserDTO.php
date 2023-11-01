<?php

namespace data_transfer_objects;

class UserDTO
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

    public static function createFromResponse($response)
    {
        $modelUser = new UserDTO();
        $modelUser->setId($response['id']);
        $modelUser->setIdRole($response['id_role']);
        $modelUser->setIdAddress($response['id_address']);
        $modelUser->setName($response['name']);
        $modelUser->setLastName($response['last_name']);
        $modelUser->setImg($response['img']);
        $modelUser->setEmail($response['email']);
        $modelUser->setPassword($response['password']);
        $modelUser->setActive($response['active']);
        $modelUser->setCreatedAt($response['created_at']);
        return $modelUser;
    }

    public function setId($id = 0)
    {
        $this->id = $id;
    }

    public function setIdRole($idRole = 0)
    {
        $this->idRole = $idRole;
    }

    public function setIdAddress($idAddress = 0)
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

    public function __toString()
    {
        return "id=" . $this->id . ", idRole=" . $this->idRole . ", idAddress=" . $this->idAddress . ", name=" . $this->name . ", lastName=" . $this->lastName . ", img=" . $this->img . ", email=" . $this->email . ", password=" . $this->password . ", active=" . $this->active . ", createdAt=" . $this->createdAt;
    }

}