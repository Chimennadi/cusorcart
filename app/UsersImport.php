<?php

namespace App;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
           'user_type'     => $row['user_type'],
           'name'    => $row['name'],
           'email'    => $row['email'],
           'email_verified_at'    => date('Y-m-d H:i:s'),
           'password'    => Hash::make($row['password']),
           'address'    => $row['address'],
           'country'    => $row['country'],
           'city'    => $row['city'],
           'postal_code'    => $row['postal_code'],
           'phone'    => $row['phone'],
        ]);
    }
}
