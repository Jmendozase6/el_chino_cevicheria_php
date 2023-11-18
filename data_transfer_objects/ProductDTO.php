<?php

namespace data_transfer_objects;

class ProductDTO
{
    private int $id;
    private int $idCategory;
    private float $discount;
    private string $name;
    private string $description;
    private string $image;
    private float $price;
    private float $stock;
    private bool $active;
    private string $createdAt;

    public static function createFromResponse($response): ProductDTO
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

    public function setId($id): void
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

    public function getId(): int
    {
        return $this->id;
    }

    public function getIdCategory(): int
    {
        return $this->idCategory;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getStock(): float
    {
        return $this->stock;
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
        return
            "id=" . $this->id .
            ", idCategory=" . $this->idCategory .
            ", discount=" . $this->discount .
            ", name='" . $this->name . '\'' .
            ", description='" . $this->description . '\'' .
            ", images='" . $this->image . '\'' .
            ", price=" . $this->price .
            ", stock=" . $this->stock .
            ", active=" . $this->active .
            ", createdAt='" . $this->createdAt;
    }

}