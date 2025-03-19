<?php

namespace App\Controller;

use App\Service\BookingService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class BookingController
{
    /**
     * @var BookingService Сервис для работы с бронированиями
     */
    private BookingService $bookingService;

    /**
     * @param BookingService $bookingService Сервис для работы с бронированиями 
     */
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Обрабатывает POST запрос на создание нового бронирования
     * @param Request $request Объект запроса (содержит JSON)
     */
    #[Route('/api/bookings', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        $booking = $this->bookingService->createBooking(
            $data['cottage_id'],
            $data['phone'],
            $data['comment']
        );
        
        return new JsonResponse($booking->toArray(), 201);
    }

    /**
     * Обрабатывает PUT запрос на обновление существующего бронирования
     * @param int $id Идентификатор бронирования (из URL)
     * @param Request $request Объект запроса (содержит данные обновления)
     * @return JsonResponse JSON-ответ с обновленными данными или ошибкой
     */
    #[Route('/api/bookings/{id}', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        $booking = $this->bookingService->updateBooking($id, $data['comment']);
        
        if (!$booking) {
            return new JsonResponse(['error' => 'Booking not found'], 404);
        }
        
        return new JsonResponse($booking->toArray());
    }
} 