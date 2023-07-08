<?php

namespace App;

use App\City;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class CityImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new City([
            // 'city_id'     => $row['city_id'],
        ]);
    }
}
