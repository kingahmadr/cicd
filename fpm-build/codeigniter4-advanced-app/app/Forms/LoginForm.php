<?php

namespace App\Forms;

use App\Models\User as UserModel;

/**
 * Login form
 */
class LoginForm extends \CodeIgniter\Model
{

    protected $returnType = 'array';

    protected $validationRules = [
        'email' => [
            'rules' => 'required|' . UserModel::EMAIL_RULES,
            'label' => 'Email'
        ],
        'password' => [
            'rules' => 'required|' . UserModel::PASSWORD_RULES . '|verifiedUser[]',
            'label' => 'Password'
        ],
        'rememberMe' => [
            'rules' => 'required|in_list[0,1]',
            'label' => 'Remember Me'
        ]
    ];

}