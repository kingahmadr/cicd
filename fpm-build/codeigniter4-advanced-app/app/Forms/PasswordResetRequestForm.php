<?php

namespace App\Forms;

use Exception;
use App\Models\User as UserModel;
use App\Entities\User;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends \CodeIgniter\Model
{

    protected $returnType = 'array';

    protected static $_user;

    protected $validationRules = [
        'email' => [
            'rules' => 'required|' . UserModel::EMAIL_RULES . '|' . __CLASS__ . '::validateEmail|' .  __CLASS__ .'::validateEmailVerification',
            'label' => 'Email'
        ]
    ];

    protected $validationMessages = [
        'email' => [
            __CLASS__ . '::validateEmail' => 'There is no user with this email address.',
            __CLASS__ . '::validateEmailVerification' => 'Unable to reset password for not verified email address.'
        ]
    ];

    public static function validateEmail($email)
    {
        $model = new UserModel;

        static::$_user = $model->findByEmail($email);

        return static::$_user ? true : false;
    }

    public static function validateEmailVerification($email)
    {
        if (static::$_user && !static::$_user->email_verified_at)
        {
            static::$_user = null;

            return false;
        }

        return true;
    } 

    public function getUser()
    {
        return static::$_user;
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail(User $user, &$error = null)
    {
        return send_email(
            $user->composeEmail('mail/resetPassword', [
                'resetLink' => $user->getResetPasswordUrl()
            ]), 
            $error
        );
    }

}