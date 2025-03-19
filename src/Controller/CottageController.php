<?php

namespace App\Controller;

use App\Service\CottageService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Контроллер для обработки API запросов, связанных с домиками
 */
class CottageController extends AbstractController
{
    /**
     * @var CottageService Сервис для работы с домиками
     */
    private CottageService $cottageService;

    /**
     * @param CottageService $cottageService Сервис для работы с домиками
     */
    public function __construct(CottageService $cottageService)
    {
        $this->cottageService = $cottageService;
    }

    /**
     * @return JsonResponse JSON-ответ со списком свободных домиков
     */
    #[Route('/api/cottages/available', methods: ['GET'])]
    public function getAvailable(): JsonResponse
    {
        $cottages = $this->cottageService->getAvailableCottages();
        return new JsonResponse(
            array_map(fn($cottage) => $cottage->toArray(), $cottages)
        );
    }
} 