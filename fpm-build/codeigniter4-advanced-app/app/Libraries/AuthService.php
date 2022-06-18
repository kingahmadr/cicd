<?php

namespace App\Libraries;

use CodeIgniter\Events\Events;
use App\Entities\User;
use App\Models\User as UserModel;

class AuthService extends \BasicApp\Auth\AuthService
{

    public function getUser() : ?User
    {
        $id = $this->getId();

        if (!$id)
        {
            return null;
        }

        return model('User')->find($id);
    }

    public function login(User $user, $rememberMe = false)
    {
        $model = model(UserModel::class);

        $id = $model->getIdValue($user);

        if (!$id)
        {
            return false;
        }

        $this->setId($id, $rememberMe);
    
        // Compability with https://codeigniter.com/user_guide/extending/authentication.html
        Events::trigger('login');
    }

    public function logout()
    {
        // Compability with https://codeigniter.com/user_guide/extending/authentication.html
        Events::trigger('logout');

        return $this->unsetId();
    }

}