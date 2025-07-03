<?php

namespace App\Bo;

use Illuminate\Support\Facades\Hash;

class UserBo
{
    public function processData(array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $data;
    }
}
