<?php

namespace InstaRouter\Model;

use InstaRouter\Model\Model;

class RecoverPassword extends Model
{
    public $table = 'slabeste_recover_password';
    public $editables = [
        'email',
        'code'
    ];

    public function generateCode($length = 10)
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
}
