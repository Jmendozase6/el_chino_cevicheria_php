<?php

namespace data_transfer_objects;

class OrderStatusDTO
{
    private int $id;
    private string $status;

    public static function createFromResponse($response): OrderStatusDTO
    {
        $orderStatusDTO = new OrderStatusDTO();
        $orderStatusDTO->setId($response['id']);
        $orderStatusDTO->setStatus($response['status']);
        return $orderStatusDTO;
    }

    public static function getStatusByCode($code): string
    {
        return match ($code) {
            "1" => 'En Revisión',
            "2" => 'Pagado',
            "3" => 'Rechazado',
            "4" => 'Enviado',
            "5" => 'Finalizado',
            default => $code . ' Desconocido',
        };
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }

}