<?php

namespace data_transfer_objects;

class UserDTO
{
    private int $id;
    private int $idRole;
    private string $address;
    private string $name;
    private string $lastName;
    private string $img;
    private string $email;
    private string $password;
    private string $phone;
    private bool $active;
    private string $createdAt;

    public static function createFromResponse($response): UserDTO
    {
        $modelUser = new UserDTO();
        $modelUser->setId($response['id']);
        $modelUser->setIdRole($response['id_role']);
        $modelUser->setAddress($response['address']);
        $modelUser->setName($response['name']);
        $modelUser->setLastName($response['last_name']);
        $modelUser->setImg($response['img']);
        $modelUser->setEmail($response['email']);
        $modelUser->setPhone($response['phone']);
        $modelUser->setActive($response['active']);
        $modelUser->setCreatedAt($response['created_at']);
        return $modelUser;
    }

    public function setId($id = 0): void
    {
        $this->id = $id;
    }

    public function setIdRole($idRole = 0): void
    {
        $this->idRole = $idRole;
    }

    public function setAddress($address): void
    {
        $this->address = $address;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    public function setImg($img): void
    {
        $this->img = $img;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    public function setActive($active): void
    {
        $this->active = $active;
    }

    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getID(): int
    {
        return $this->id;
    }

    public function getIDRole(): int
    {
        return $this->idRole;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getImg(): string
    {
        return $this->img;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }


    public function getRoleById(): string
    {
        return match ($this->idRole) {
            1 => "Administrador",
            2 => "Cliente",
            default => "Sin rol",
        };
    }

}