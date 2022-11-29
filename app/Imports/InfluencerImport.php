<?php

namespace App\Imports;

use App\Models\Influencer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class InfluencerImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Influencer([
            'f_name' => $row['f_name'],
            'l_name' => $row['l_name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'login_id' => $row['login_id'],
            'password' => Hash::make($row['password']),
        ]);
    }
}
