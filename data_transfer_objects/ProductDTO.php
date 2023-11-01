<?php

namespace data_transfer_objects;

class ProductDTO
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

    public static function createFromResponse($response)
    {
        $productDTO = new ProductDTO();
        $productDTO->setId($response['id']);
        $productDTO->setIdCategory($response['id_category']);
        $productDTO->setDiscount($response['discount']);
        $productDTO->setName($response['name']);
        $productDTO->setDescription($response['description']);
        $productDTO->setImage($response['image']);
        $productDTO->setPrice($response['price']);
        $productDTO->setStock($response['stock']);
        $productDTO->setActive($response['active']);
        $productDTO->setCreatedAt($response['created_at']);
        return $productDTO;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIdCategory($idCategory)
    {
        $this->idCategory = $idCategory;
    }

    public function setDiscount($discount)
    {
        $this->discount = $discount;
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

    public function setStock($stock)
    {
        $this->stock = $stock;
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

    public function __toString()
    {
        return
            "id=" . $this->id .
            ", idCategory=" . $this->idCategory .
            ", discount=" . $this->discount .
            ", name='" . $this->name . '\'' .
            ", description='" . $this->description . '\'' .
            ", image='" . $this->image . '\'' .
            ", price=" . $this->price .
            ", stock=" . $this->stock .
            ", active=" . $this->active .
            ", createdAt='" . $this->createdAt;
    }


}