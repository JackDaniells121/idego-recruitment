<?php

namespace App\Model;

class UserCollection
{
    public array $elements = [];

    public function __construct()
    {
        // 1 == 'c4ca4238a0b923820dcc509a6f75849b'
        $user1 = new UserLogin('test@test.pl', 'c4ca4238a0b923820dcc509a6f75849b', '96e79218965eb72c92a549dd5a330112');
        $user2 = new UserLogin('test2@test.pl', 'c4ca4238a0b923820dcc509a6f75849b');
        $this->elements = [ $user1, $user2 ];
    }

    public function findUser($email, $password): bool | UserLogin
    {
        foreach ($this->elements as $user) {
            if ($user->email == $email && $user->checkPassword($password)) {
                return $user;
            }
        }
        return false;
    }
}