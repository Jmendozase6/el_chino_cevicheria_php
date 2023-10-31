<?php

namespace data_transfer_objects;

class productDTO
{
    private $id;
    private $idCategory;
    private $idProductDiscount;
    private $idProductStock;
    private $name;
    private $description;
    private $image;
    private $price;
    private $active;
    private $createdAt;

    public function __construct($id, $idCategory, $idProductDiscount, $idProductStock, $name, $description, $image, $price, $active, $createdAt)
    {
        $this->id = $id;
        $this->idCategory = $idCategory;
        $this->idProductDiscount = $idProductDiscount;
        $this->idProductStock = $idProductStock;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
        $this->active = $active;
        $this->createdAt = $createdAt;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIdCategory($idCategory)
    {
        $this->idCategory = $idCategory;
    }

    public function setIdProductDiscount($idProductDiscount)
    {
        $this->idProductDiscount = $idProductDiscount;
    }

    public function setIdProductStock($idProductStock)
    {
        $this->idProductStock = $idProductStock;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdCategory()
    {
        return $this->idCategory;
    }

    public function getIdProductDiscount()
    {
        return $this->idProductDiscount;
    }

    public function getIdProductStock()
    {
        return $this->idProductStock;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getPrice()
    {
        return $this->price;
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