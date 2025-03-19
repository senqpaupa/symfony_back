<?php

namespace App\Tests\Unit\Service;

use App\Service\CsvDataService;
use PHPUnit\Framework\TestCase;

/**
 * Модульные тесты для CsvDataService
 */
class CsvDataServiceTest extends TestCase
{
    /**
     * @var string Путь к тестовой директории с данными
     */
    private string $testDataDir;
    
    /**
     * @var CsvDataService Тестируемый сервис
     */
    private CsvDataService $service;

    protected function setUp(): void
    {
        $this->testDataDir = dirname(__DIR__) . '/data';
        $this->service = new CsvDataService($this->testDataDir);
    }

    /**
     * Тест метода readCsv()
     * Проверяет, что метод корректно читает данные из CSV файла
     */
    public function testReadCsv(): void
    {
        $data = $this->service->readCsv('test_cottages.csv');
        $this->assertIsArray($data);
        $this->assertCount(2, $data);
        $this->assertEquals('Test Cottage 1', $data[0]['name']);
    }

    /**
     * Тест метода writeCsv()
     * Проверяет, что метод корректно записывает данные в CSV файл
     */
    public function testWriteCsv(): void
    {
        $testData = [
            ['id' => 1, 'name' => 'Test'],
            ['id' => 2, 'name' => 'Test 2'],
        ];
        
        $this->service->writeCsv('test_output.csv', $testData);
        
        $this->assertFileExists($this->testDataDir . '/test_output.csv');
        $data = $this->service->readCsv('test_output.csv');
        $this->assertEquals($testData, $data);
    }
} 