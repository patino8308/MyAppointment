<?php

namespace App\Http\Traits;

use App\User;
use Illuminate\Support\Facades\Validator;

trait ValidateAndCreatePatient
{
    protected function validator(array $data)
    {
        return Validator::make($data, User::$rules);
    }

    protected function create(array $data)
    {
        return User::createPatient($data);
    }
}
