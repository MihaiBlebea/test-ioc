<?php

namespace TestIoc\Models;

use Framework\Models\Model;

class User extends Model
{
    protected $table = 'slabeste_clients';
    public $tableKey = "id";
    public $id;
    public $regdate;
    public $first_name;
    public $last_name;
    public $username;
    public $password;
    public $email;
    public $bmi;


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
