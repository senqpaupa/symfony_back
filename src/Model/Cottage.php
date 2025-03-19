<?php

namespace App\Model;

/**
 * Класс Cottage - модель домика для бронирования
 */
class Cottage
{
    /**
     * @var int Уникальный идентификатор домика
     */
    private int $id;
    
    /**
     * @var string Название домика (например, "Банный домик")
     */
    private string $name;
    
    /**
     * @var string Тип домика (bath, pool, bbq и т.д.)
     */
    private string $type;
    
    /**
     * @var int Количество спальных мест
     */
    private int $beds;
    
    /**
     * @var float Цена за сутки
     */
    private float $price;
    
    /**
     * @var array Список удобств (wifi, fridge, sauna и т.д.)
     */
    private array $amenities;

    /**
     * Конструктор класса Cottage
     *
     * @param int $id Уникальный идентификатор домика
     * @param string $name Название домика
     * @param string $type Тип домика
     * @param int $beds Количество спальных мест
     * @param float $price Цена за сутки
     * @param array $amenities Список удобств
     */
    public function __construct(
        int $id,
        string $name,
        string $type,
        int $beds,
        float $price,
        array $amenities
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->beds = $beds;
        $this->price = $price;
        $this->amenities = $amenities;
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'beds' => $this->beds,
            'price' => $this->price,
            'amenities' => $this->amenities,
        ];
    }
} 