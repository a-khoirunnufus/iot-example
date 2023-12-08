<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TanksImport implements ToCollection, WithChunkReading, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            // \Log::debug($row);
            DB::table('tank_history')->insert([
                'date' => $row['date'],
                'time' => $row['time'],
                'tank' => $row['tank'],
                'level' => $row['levelm'],
                'temprature' => $row['temperaturedeg_c'],
                'volume' => $row['volumel'],
                'mass' => $row['masskg'],
            ]);
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
