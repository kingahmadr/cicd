<?php

namespace App\Entities;

use Config\Services;
use CodeIgniter\Email\Email;

class User extends \CodeIgniter\Entity
{

    public function composeEmail(string $view, array $params = [], array $options = []) : Email
    {
        $params['user'] = $this;

        $email = compose_email($view, $params, $options);

        $email->setTo($this->email, $this->name);

        return $email;
    }

    public function getResetPasswordUrl()
    {
        return site_url('user/resetPassword/' . $this->id . '/' .  $this->password_reset_token);
    }

    public function getEmailVerificationUrl()
    {
        return site_url('user/verifyEmail/' . $this->id  . '/'. $this->email_verification_token);
    }

    public function encodePassword(string $password) : string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function setPassword(string $password)
    {
        $this->password_hash = $this->encodePassword($password);
    }

}