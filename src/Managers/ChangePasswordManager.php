<?php

namespace TestIoc\Managers;

use Framework\Managers\Manager;
use Framework\Interfaces\ManagerInterface;
use TestIoc\Models\User;

class ChangePasswordManager implements ManagerInterface
{
    public function __construct()
    {

    }

    public function run()
    {
        $users = $this->getAllUsers();
        $passwords = $this->getPasswords($users);
        $hashPasswords = $this->hashPasswords($passwords);
        $result = $this->insertHashPasswords($hashPasswords);
    }

    private function getAllUsers()
    {
        $user = new User;
        $users = $user->where('id', '>', 0)->select();
        return $users;
    }

    private function getPasswords(array $users)
    {
        $passwords = array();
        foreach($users as $user)
        {
            //array_push($passwords, $user->password);
            $passwords[$user->username] = $user->password;
        }
        return $passwords;
    }

    private function hashPasswords(array $passwords)
    {
        $hashPasswords = array();
        foreach($passwords as $index => $password)
        {
            $password = md5($password);
            //array_push($hashPasswords, $password);
            $hashPasswords[$index] = $password;
        }
        return $hashPasswords;
    }

    public function insertHashPasswords(array $hashPasswords)
    {
        $user = new User;
        foreach($hashPasswords as $index => $password)
        {
            $user = new User;
            $change = $user->where('username', '=', $index)->update([
                "password" => $password
            ]);
        }
    }
}
