<?php

namespace data_transfer_objects;

class PaymentDTO
{

    private int $id;
    private string $name;
    private string $receipt;


    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setReceipt($receipt): void
    {
        $this->receipt = $receipt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getReceipt(): string
    {
        return $this->receipt;
    }

}