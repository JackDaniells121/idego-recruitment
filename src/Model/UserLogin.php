<?php

namespace App\Model;

class UserLogin
{
    public function __construct(
        public string $email,
        public string $hash,
        public string $otp = ''
    )
    {
    }

    public function checkPassword(string $password)
    {
        return md5($password) == $this->hash;
    }

    public function setHash(string $password): void
    {
        $this->hash = md5($password);
    }

    public function otpEnabled()
    {
        return $this->otp != '';
    }
}