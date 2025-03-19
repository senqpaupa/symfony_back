<?php

namespace App\Service;

use App\Model\Booking;

/**
 * Сервис для работы с бронированиями
 */
class BookingService
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
     * Новое бронирование домика
     * @param int $cottageId Идентификатор домика
     * @param string $phone Номер телефона клиента
     * @param string $comment Комментарий к бронированию
     * @return Booking Созданный объект бронирования
     */
    public function createBooking(int $cottageId, string $phone, string $comment): Booking
    {
        $bookings = $this->csvService->readCsv('bookings.csv');
        $id = count($bookings) + 1;
        $booking = new Booking($id, $cottageId, $phone, $comment);
        $bookings[] = $booking->toArray();
        
        $this->csvService->writeCsv('bookings.csv', $bookings);
        
        return $booking;
    }

    /**
     * Обновляет комментарий к существующему бронированию
     * @param int $id Идентификатор бронирования
     * @param string $comment Новый комментарий
     * @return Booking|null Обновленный объект бронирования или null, если не найдено
     */
    public function updateBooking(int $id, string $comment): ?Booking
    {
        $bookings = $this->csvService->readCsv('bookings.csv');
        
        foreach ($bookings as &$booking) {
            if ((int)$booking['id'] === $id) {
                $booking['comment'] = $comment;
                $this->csvService->writeCsv('bookings.csv', $bookings);
                
                return new Booking(
                    (int)$booking['id'],
                    (int)$booking['cottage_id'],
                    $booking['phone'],
                    $booking['comment'],
                    $booking['created_at'],
                    $booking['status']
                );
            }
        }
        
        return null;
    }
} 