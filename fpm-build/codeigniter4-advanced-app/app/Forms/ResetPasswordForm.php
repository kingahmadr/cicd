<?php

namespace App\Forms;

use App\Models\User as UserModel;

/**
 * Password reset form
 */
class ResetPasswordForm extends \CodeIgniter\Model
{

    protected $returnType = 'array';

    protected $validationRules = [
        'password' => [
            'rules' => 'required|' . UserModel::PASSWORD_RULES,
            'label' => 'Password'
        ]
    ];

    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword($user, $data, &$error)
    {
        $model = new UserModel;

        $user->setPassword($data['password']);

        $user->password_reset_token = null;

        $return = $model->save($user);

        if (!$return)
        {
            $errors = (array) $model->errors();

            $error = array_shift($errors);
        }

        return $return;
    }

}