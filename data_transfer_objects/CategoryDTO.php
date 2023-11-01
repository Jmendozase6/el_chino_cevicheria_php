<?php

namespace data_transfer_objects;

class CategoryDTO
{
    private $id;
    private $name;
    private $createdAt;

    public static function createFromResponse($response)
    {
        $modelCategory = new CategoryDTO();
        $modelCategory->setId($response['id']);
        $modelCategory->setName($response['name']);
        $modelCategory->setCreatedAt($response['created_at']);
        return $modelCategory;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function __toString()
    {
        return "id=" . $this->id . ", name=" . $this->name . ", createdAt=" . $this->createdAt;
    }
}