<?php

namespace App\Forms;

use Exception;
use App\Models\User as UserModel;
use App\Entities\User;

class ResendVerificationEmailForm extends \CodeIgniter\Model
{

    protected $returnType = 'array';

    protected static $_user;

    protected $validationRules = [
        'email' => [
            'label' => 'Email',
            'rules' => 'required|' . UserModel::EMAIL_RULES . '|' . __CLASS__ . '::validateEmail|' . __CLASS__ . '::validateVerification'
        ]
    ];

    protected $validationMessages = [
        'email' => [
            __CLASS__ . '::validateEmail' => 'There is no user with this email address.',
            __CLASS__ . '::validateVerification' => 'User already verified.'
        ]
    ];

    public static function validateEmail($email)
    {
        $model = new UserModel;

        static::$_user = $model->findByEmail($email);

        return static::$_user ? true : false;
    }

    public static function validateVerification($email)
    {
        if (static::$_user && static::$_user->email_verified_at)
        {
            return false;
        }

        return true;
    }

    public function getUser()
    {
        return static::$_user;
    }

    public function sendEmail(User $user, &$error)
    {
        return send_email(
            $user->composeEmail('mail/emailVerification', [
                'verifyLink' => $user->getEmailVerificationUrl()
            ]), 
            $error
        );
    }

}