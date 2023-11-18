<?php

namespace data_transfer_objects;

class CategoryDTO
{
    private int $id;
    private string $name;
    private string $img;
    private string $createdAt;

    public static function createFromResponse($response): CategoryDTO
    {
        $modelCategory = new CategoryDTO();
        $modelCategory->setId($response['id']);
        $modelCategory->setName($response['name']);
        $modelCategory->setImg($response['img']);
        $modelCategory->setCreatedAt($response['created_at']);
        return $modelCategory;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setImg($img): void
    {
        $this->img = $img;
    }


    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getImg(): string
    {
        return $this->img;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function __toString()
    {
        return "id=" . $this->id . ", name=" . $this->name . ", images=" . $this->getImg() . ", createdAt=" . $this->createdAt;
    }
}