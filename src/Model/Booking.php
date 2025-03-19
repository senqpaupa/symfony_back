<?php

namespace App\Model;

/**
 * Класс Booking - модель бронирования домика
 */
class Booking
{

    private ?int $id;
    private int $cottageId;
    private string $phone;
    private string $comment;
    private string $createdAt;
    private string $status;

    /**
     * Конструктор класса Booking
     *
     * @param int|null $id Идентификатор бронирования (null для новых)
     * @param int $cottageId Идентификатор домика
     * @param string $phone Номер телефона клиента
     * @param string $comment Комментарий к бронированию
     * @param string|null $createdAt Дата и время создания (текущие если null)
     * @param string $status Статус бронирования (по умолчанию 'active')
     */
    public function __construct(
        ?int $id,
        int $cottageId,
        string $phone,
        string $comment,
        ?string $createdAt = null,
        string $status = 'active'
    ) {
        $this->id = $id;
        $this->cottageId = $cottageId;
        $this->phone = $phone;
        $this->comment = $comment;
        $this->createdAt = $createdAt ?? date('Y-m-d H:i:s');
        $this->status = $status;
    }

    /**
     * Преобразует объект Booking в ассоциативный массив

     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'cottage_id' => $this->cottageId,
            'phone' => $this->phone,
            'comment' => $this->comment,
            'created_at' => $this->createdAt,
            'status' => $this->status,
        ];
    }

    /**
     * @param string $comment Новый комментарий
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }
} 