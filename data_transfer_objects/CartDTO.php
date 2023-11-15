<?php

namespace data_transfer_objects;

class CartDTO
{
    private $id;
    private $idSession;
    private $idProduct;
    private $quantity;

    public static function createFromResponse($response)
    {
        $modelCart = new CartDTO();
        $modelCart->setId($response['id']);
        $modelCart->setIdSession($response['id_session']);
        $modelCart->setIdProduct($response['id_product']);
        $modelCart->setQuantity($response['quantity']);
        return $modelCart;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIdSession($idSession)
    {
        $this->idSession = $idSession;
    }

    public function setIdProduct($idProduct)
    {
        $this->idProduct = $idProduct;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdSession()
    {
        return $this->idSession;
    }

    public function getIdProduct()
    {
        return $this->idProduct;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

}