<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserService
{
    static public function getUser(int $userId = null) : array
    {
        if (null === $userId) {
            $user = Auth::user();
            return [
                'id' => $user->id,
                'name' => $user->name,
            ];
        }
        $user = DB::table('users')->where('id', $userId)->first();
        return [
            'id' => $user->id,
            'name' => $user->name,
        ];
    }

    static public function getUsers() : array
    {
        $users = [];
        foreach (DB::table('users')->get() as $user) {
            $users[] =
                [
                    'id' => $user->id,
                    'name' => $user->name,
                ];
        }
        return $users;
    }

    static public function getUserId()
    {
        return Auth::id();
    }


}
