<?php

namespace App\Imports;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InvoicesImport implements ToModel, ShouldQueue, WithHeadingRow, WithBatchInserts, WithChunkReading, WithCustomCsvSettings
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $InvoiceDate = Carbon::parse($row['InvoiceDate'])->toDateTimeString();
        return new Invoice([
            'InvoiceNo' => $row['InvoiceNo'],
            'StockCode' => $row['StockCode'],
            'Description' => $row['Description'],
            'Quantity' => $row['Quantity'],
            'InvoiceDate' => $InvoiceDate,
            'UnitPrice' => $row['UnitPrice'],
            'CustomerID' => $row['CustomerID'],
            'Country' => $row['Country']
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ","
        ];
    }
}
