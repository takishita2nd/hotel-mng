<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\User;

class UserRepository
{
    public function __construct()
    {

    }

    public function getUserById($id)
    {
        return User::where("id", $id)->first();
    }

    public function search($word)
    {
        $select = ['id', 'name', 'address', 'phone'];
        return User::select($select)
                    ->where('name', 'like', "%{$word}%")
                    ->get();
    }
}