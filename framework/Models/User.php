<?php

namespace InstaRouter\Model;

use InstaRouter\Model\Model;

class User extends Model
{
    public $table = 'slabeste_clients';
    public $editables = [
        'first_name',
        'last_name',
        'username',
        'password',
        'email',
        'bmi'
    ];

    public function generatePassword($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++)
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function generateUsername($firstName, $lastName)
    {
        return strtolower($firstName . '.' . $lastName);
    }
}
