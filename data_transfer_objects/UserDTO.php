<?php

namespace data_transfer_objects;

class UserDTO
{
    private int $id;
    private int $idRole;
    private ?int $idAddress;
    private string $name;
    private string $lastName;
    private string $img;
    private string $email;
    private string $password;
    private bool $active;
    private string $createdAt;

    public static function createFromResponse($response): UserDTO
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

    public function setId($id = 0): void
    {
        $this->id = $id;
    }

    public function setIdRole($idRole = 0): void
    {
        $this->idRole = $idRole;
    }

    public function setIdAddress($idAddress = 0): void
    {
        $this->idAddress = $idAddress;
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

    public function getIDAddress(): int
    {
        return $this->idAddress;
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

    public function getActive(): bool
    {
        return $this->active;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function __toString()
    {
        return "id=" . $this->id . ", idRole=" . $this->idRole . ", idAddress=" . $this->idAddress . ", name=" . $this->name . ", lastName=" . $this->lastName . ", img=" . $this->img . ", email=" . $this->email . ", password=" . $this->password . ", active=" . $this->active . ", createdAt=" . $this->createdAt;
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