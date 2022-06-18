<?php

namespace Admin\Controllers;

use Exception;

class Login extends BaseController
{

    protected function checkAuth() : bool
    {
        return true;
    }

    public function index()
    {
        if (adminAuth()->getId())
        {
            return $this->goHome();
        }

        $validator = \Config\Services::validation();

        $data = $this->request->getPost();

        $errors = [];

        $validator->setRules([
            'username' => [
                'rules' => 'required',
                'label' => lang('Login')
            ],
            'password' => [
                'rules' => 'required|validAdmin[]',
                'label' => lang('Password')
            ],
            'rememberMe' => [
                'rules' => 'required|in_list[0,1]',
                'label' => lang('Remember Me')
            ]
        ]);

        if ($data)
        {
            if ($validator->run($data))
            {
                $rememberMe = array_key_exists('rememberMe', $data) ? $data['rememberMe'] : false;

                adminAuth()->setId($data['username'], $rememberMe);

                return $this->goHome();
            }
            else
            {
                $errors = (array) $validator->getErrors();
            } 
        }
        else
        {
            $data['rememberMe'] = 1;
        }

        return $this->render('login', [
            'errors' => $errors,
            'data' => $data,
            'validation' => $validator
        ]);        
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function logout()
    {
        adminAuth()->unsetId();

        return $this->goHome();
    }

}