<?php

namespace App\Service;

/**
 * Методы для чтения и записи данных в CSV формате
 */
class CsvDataService
{
    /**
     * @var string Путь к директории с данными
     */
    private string $dataDir;

    /**
     * @param string $dataDir Путь к директории с данными
     */
    public function __construct(string $dataDir)
    {
        $this->dataDir = $dataDir;
    }

    /**
     * @param string $filename Имя файла
     * @return array Массив ассоциативных массивов, где ключи - заголовки из первой строки
     */
    public function readCsv(string $filename): array
    {
        $file = fopen($this->dataDir . '/' . $filename, 'r');
        $headers = fgetcsv($file, 0, ',', '"', "\\");
        $data = [];
        
        while ($row = fgetcsv($file, 0, ',', '"', "\\")) {
            $data[] = array_combine($headers, $row);
        }
        
        fclose($file);
        return $data;
    }

    /**
     * Записывает данные в CSV файл
     * @param string $filename Имя файла
     * @param array $data Массив ассоциативных массивов для записи
     */
    public function writeCsv(string $filename, array $data): void
    {
        $file = fopen($this->dataDir . '/' . $filename, 'w');
        
        if (!empty($data)) {
            fputcsv($file, array_keys($data[0]), ',', '"', "\\");
            foreach ($data as $row) {
                fputcsv($file, $row, ',', '"', "\\");
            }
        }
        
        fclose($file);
    }
} 