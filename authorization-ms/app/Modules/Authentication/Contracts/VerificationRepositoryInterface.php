<?php

namespace App\Modules\Authentication\Contracts;

interface VerificationRepositoryInterface
{
    public function verifyEmail($id, $hashedEmail);

    public function sendEmailVerificationLink($user);


}
