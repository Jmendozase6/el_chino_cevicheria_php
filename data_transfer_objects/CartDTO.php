<?php

namespace data_transfer_objects;

class CartDTO
{
    private int $id;
    private string $idSession;
    private int $idProduct;
    private string $quantity;

    public static function createFromResponse($response): CartDTO
    {
        $modelCart = new CartDTO();
        $modelCart->setId($response['id']);
        $modelCart->setIdSession($response['id_session']);
        $modelCart->setIdProduct($response['id_product']);
        $modelCart->setQuantity($response['quantity']);
        return $modelCart;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setIdSession($idSession): void
    {
        $this->idSession = $idSession;
    }

    public function setIdProduct($idProduct): void
    {
        $this->idProduct = $idProduct;
    }

    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIdSession(): string
    {
        return $this->idSession;
    }

    public function getIdProduct(): int
    {
        return $this->idProduct;
    }

    public function getQuantity(): string
    {
        return $this->quantity;
    }

}