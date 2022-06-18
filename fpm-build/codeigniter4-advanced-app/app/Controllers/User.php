<?php

namespace App\Controllers;

use Exception;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Forms\LoginForm;
use App\Forms\SignupForm;
use App\Forms\PasswordResetRequestForm;
use App\Forms\ResendVerificationEmailForm;
use App\Forms\ResetPasswordForm;
use App\Models\User as UserModel;
use App\Entities\User as UserEntity;

class User extends BaseController
{

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function signup()
    {
        if ($this->user)
        {
            return $this->goHome();
        }
        
        $model = new SignupForm;

        $data = $this->request->getPost();

        $errors = [];

        $customErrors = [];

        if ($data)
        {
            if ($model->validate($data))
            {
                $user = $model->signup($data, $error);

                if (!$user)
                {
                    throw new Exception($error);
                }

                if ($model->sendEmail($user, $error))
                {
                    $this->session->setFlashdata(
                        'success', 
                        lang('Thank you for registration. Please check your inbox for verification email.')
                    );
                
                    return $this->goHome();                    
                }
                else
                {
                    if (!CI_DEBUG)
                    {
                        $error = lang('Sorry, we are unable to send a message to the provided email address.');
                    }

                    $customErrors[] = $error;
                }
            }
            else
            {
                $errors = (array) $model->errors();
            }
        }

        return $this->render('user/signup', [
            'model' => $model,
            'data' => $data,
            'errors' => $errors,
            'customErrors' => $customErrors
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function login()
    {
        if ($this->user)
        {
            return $this->goHome();
        }

        $model = new LoginForm;

        $data = $this->request->getPost();

        $errors = [];
        
        if ($data)
        {
            if ($model->validate($data))
            {
                $user = model(UserModel::class)->findByEmail($data['email']);

                if (!$user)
                {
                    throw new Exception(lang('User not found.'));
                }

                $rememberMe = array_key_exists('rememberMe', $data) ? $data['rememberMe'] : false;

                auth()->login($user, $rememberMe);

                return $this->goHome();
            }
            else
            {
                $errors = (array) $model->errors();
            } 
        }
        else
        {
            $data['rememberMe'] = 1;
        }

        return $this->render('user/login', [
            'model' => $model,
            'errors' => $errors,
            'data' => $data
        ]);        
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function logout()
    {
        auth()->logout();

        return $this->goHome();
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @return mixed
     */
    public function verifyEmail($id, $token)
    {
        $model = model(UserModel::class);

        $user = $model->find($id);

        if (!$user)
        {
            throw new Exception(lang('User not found.'));
        }

        if ($user->email_verified_at)
        {
            $this->session->setFlashdata('info', lang('User already verified.'));
        
            return $this->redirect(site_url('user/login'));
        }

        if ($user->email_verification_token != $token)
        {
            $this->session->setFlashdata('error', lang('Unable to verify your account with provided token.'));
        
            return $this->redirect(site_url('user/resendVerificationEmail'));
        }

        $model->set('email_verified_at', 'NOW()', false);

        $model->set('email_verification_token', 'NULL', false);

        $model->protect(false);

        if (!$model->update($user->id))
        {
            $errors = $model->errors();

            $error = array_shift($errors);

            $model->protect(true);

            throw new Exception($error);
        }

        $model->protect(true);

        $this->session->setFlashdata('success', lang('Your email has been confirmed!'));

        return $this->redirect(site_url('user/login'));
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function resendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm;
        
        $errors = [];

        $customErrors = [];

        $data = $this->request->getPost();

        if ($data)
        {
            if ($model->validate($data))
            {
                $user = $model->getUser();

                $userModel = model(UserModel::class);

                if (!$userModel->isTokenValid($user->email_verification_token))
                {
                    $user->email_verification_token = $userModel->generateToken();

                    if (!$userModel->save($user))
                    {
                        $errors = $userModel->errors();

                        $error = array_shift($error);

                        throw new Exception($error);
                    }
                }

                if ($model->sendEmail($user, $error))
                {
                    $this->session->setFlashdata('success', lang('Check your email for further instructions.'));
                
                    return $this->goHome();
                }
                else
                {
                    if (!CI_DEBUG)
                    {
                        $error = lang('Sorry, we are unable to send a message to the provided email address.');
                    }

                    $customErrors[] = $error;
                }
            }
            else
            {
                $errors = (array) $model->errors();
            }
        }

        return $this->render('user/resendVerificationEmail', [
            'model' => $model,
            'data' => $data,
            'errors' => $errors,
            'customErrors' => $customErrors
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function requestPasswordReset()
    {
        $model = new PasswordResetRequestForm;

        $data = $this->request->getPost();

        $errors = [];

        $customErrors = [];

        if ($data)
        {
            if ($model->validate($data))
            {
                $userModel = model(UserModel::class);

                $user = $model->getUser();

                if (!$user)
                {
                    throw new Exception(lang('User not found.'));
                }

                if (!$user->password_reset_token || !$userModel->isTokenValid($user->password_reset_token))
                {
                    $user->password_reset_token = $userModel->generateToken();

                    if (!$userModel->save($user))
                    {
                        $errors = $userModel->errors();

                        $error = array_shift($errors);

                        throw new Exception($error);
                    }
                }

                if ($model->sendEmail($user, $error))
                {
                    $this->session->setFlashdata('success', lang('Check your email for further instructions.'));

                    return $this->goHome();
                }
                else
                {
                    if (!CI_DEBUG)
                    {
                        $error = lang('Sorry, we are unable to send a message to the provided email address.');
                    }

                    $customErrors[] = $error; 
                }
            }
            else
            {
                $errors = (array) $model->errors();
            }
        }
        
        return $this->render('user/requestPasswordReset', [
            'model' => $model,
            'data' => $data,
            'errors' => $errors,
            'customErrors' => $customErrors
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     */
    public function resetPassword($id, $token)
    {
        $userModel = model(UserModel::class);

        $user = $userModel->find((int) $id);

        if (!$user)
        {
            throw new PageNotFoundException;
        }

        if ($token != $user->password_reset_token)
        {
            $this->session->setFlashdata('error', lang('Wrong password reset token.'));

            return $this->redirect(site_url('user/requestPasswordReset'));
        }

        $errors = [];

        $model = new ResetPasswordForm;

        $data = $this->request->getPost();

        if ($data)
        {
            if ($model->validate($data))
            {
                if ($model->resetPassword($user, $data, $error))
                {
                    $this->session->setFlashdata('success', lang('New password saved.'));

                    return $this->redirect(site_url('user/login'));
                }
                else
                {
                    $errors[] = $error;
                }
            }
            else
            {
                $errors = (array) $model->errors();
            }
        }

        return $this->render('user/resetPassword', [
            'model' => $model,
            'data' => $data,
            'errors' => $errors,
            'id' => $id,
            'token' => $token
        ]);
    }

}