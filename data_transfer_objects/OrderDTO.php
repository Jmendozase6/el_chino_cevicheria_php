<?php

namespace data_transfer_objects;

class OrderDTO
{
    private int $id;
    private int $userId;
    private string $paymentId;
    private float $total;
    private string $orderStatus;
    private string $createdAt;
    private string $nameOrder;
    private string $lastNameOrder;
    private string $addressOrder;
    private string $districtOrder;
    private string $phoneOrder;
    private string $commentsOrder;

    public static function createFromResponse($response): OrderDTO
    {
        $orderDTO = new OrderDTO();
        $orderDTO->setId($response['id']);
        $orderDTO->setUserId($response['user_id']);
        $orderDTO->setPaymentId($response['payment_id']);
        $orderDTO->setTotal($response['total']);
        $orderDTO->setOrderStatus($response['order_status']);
        $orderDTO->setCreatedAt($response['created_at']);
        $orderDTO->setNameOrder($response['name_order']);
        $orderDTO->setLastNameOrder($response['last_name_order']);
        $orderDTO->setAddressOrder($response['address_order']);
        $orderDTO->setDistrictOrder($response['district_order']);
        $orderDTO->setPhoneOrder($response['phone_order']);
        $orderDTO->setCommentsOrder($response['comments_order']);
        return $orderDTO;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    public function setPaymentId($paymentId = ''): void
    {
        $this->paymentId = $paymentId;
    }

    public function setTotal($total): void
    {
        $this->total = $total;
    }

    public function setOrderStatus($orderStatus): void
    {
        $this->orderStatus = $orderStatus;
    }

    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setNameOrder($nameOrder): void
    {
        $this->nameOrder = $nameOrder;
    }

    public function setLastNameOrder($lastNameOrder): void
    {
        $this->lastNameOrder = $lastNameOrder;
    }

    public function setAddressOrder($addressOrder): void
    {
        $this->addressOrder = $addressOrder;
    }

    public function setDistrictOrder($districtOrder): void
    {
        $this->districtOrder = $districtOrder;
    }

    public function setPhoneOrder($phoneOrder): void
    {
        $this->phoneOrder = $phoneOrder;
    }

    public function setCommentsOrder($commentsOrder): void
    {
        $this->commentsOrder = $commentsOrder;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getPaymentId(): string
    {
        return $this->paymentId;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getOrderStatus(): string
    {
        return $this->orderStatus;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getNameOrder(): string
    {
        return $this->nameOrder;
    }

    public function getLastNameOrder(): string
    {
        return $this->lastNameOrder;
    }

    public function getAddressOrder(): string
    {
        return $this->addressOrder;
    }

    public function getDistrictOrder(): string
    {
        return $this->districtOrder;
    }

    public function getPhoneOrder(): string
    {
        return $this->phoneOrder;
    }

    public function getCommentsOrder(): string
    {
        return $this->commentsOrder;
    }

}