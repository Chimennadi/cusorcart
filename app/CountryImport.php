<?php

namespace App;

use App\Country;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class CountryImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Country([
            'name'     => $row['name']
        ]);
    }
}
