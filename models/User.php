<?php

namespace app\models;

use app\core\Model;

class User extends Model
{
    public string $username = '';
    public string $email = '';
    public string $password = '';


    public function save()
    {
        echo 'saving new user';
    }


}