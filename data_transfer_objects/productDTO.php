<?php

namespace data_transfer_objects;

class productDTO
{
    private $id;
    private $idCategory;
    private $discount;
    private $name;
    private $description;
    private $image;
    private $price;
    private $stock;
    private $active;
    private $createdAt;

    public function __construct($id, $idCategory, $discount, $name, $description, $image, $price, $stock, $active, $createdAt)
    {
        $this->id = $id;
        $this->idCategory = $idCategory;
        $this->discount = $discount;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
        $this->stock = $stock;
        $this->active = $active;
        $this->createdAt = $createdAt;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIdCategory($idCategory): void
    {
        $this->idCategory = $idCategory;
    }

    public function setDiscount($discount): void
    {
        $this->discount = $discount;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function setImage($image): void
    {
        $this->image = $image;
    }

    public function setPrice($price): void
    {
        $this->price = $price;
    }

    public function setStock($stock): void
    {
        $this->stock = $stock;
    }

    public function setActive($active): void
    {
        $this->active = $active;
    }

    public function setCreatedAt($createdAt): void
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

    public function getDiscount()
    {
        return $this->discount;
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

    public function getStock()
    {
        return $this->stock;
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