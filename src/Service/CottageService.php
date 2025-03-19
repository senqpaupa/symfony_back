<?php

namespace App\Service;

use App\Model\Cottage;

/**
 * Сервис для работы с домиками
 */
class CottageService
{
    /**
     * @var CsvDataService Сервис для работы с CSV
     */
    private CsvDataService $csvService;

    /**
     * @param CsvDataService $csvService Сервис для работы с CSV
     */
    public function __construct(CsvDataService $csvService)
    {
        $this->csvService = $csvService;
    }

    /**
     * @return array Массив объектов Cottage
     */
    public function getAvailableCottages(): array
    {
        $data = $this->csvService->readCsv('cottages.csv');
        $bookings = $this->csvService->readCsv('bookings.csv');
        
        $bookedCottageIds = array_column(
            array_filter($bookings, fn($b) => $b['status'] === 'active'),
            'cottage_id'
        );

        return array_map(
            fn($row) => new Cottage(
                (int)$row['id'],
                $row['name'],
                $row['type'],
                (int)$row['beds'],
                (float)$row['price'],
                explode(',', $row['amenities'])
            ),
            array_filter($data, fn($row) => !in_array($row['id'], $bookedCottageIds))
        );
    }
} 