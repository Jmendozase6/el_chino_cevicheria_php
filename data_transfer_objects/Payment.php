<?php

namespace data_transfer_objects;

class Payment
{

    private $id;
    private $name;
    private $receipt;

    public function __construct($id, $name, $receipt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->receipt = $receipt;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setReceipt($receipt)
    {
        $this->receipt = $receipt;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getReceipt()
    {
        return $this->receipt;
    }

}