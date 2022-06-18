<?php

/* @var $this \CodeIgniter\View\View */
/* @var $model \App\Forms\LoginForm */

$this->data['title'] = 'Login';

$this->data['breadcrumbs'][] = $this->data['title'];

helper(['form']);

$this->extend('layout');

?>

<?php $this->section('content');?>

<p>Please fill out the following fields to login:</p>

<ul>
    <li><a href="<?= site_url('user/requestPasswordReset');?>">Request password reset</a></li>
    <li><a href="<?= site_url('user/resendVerificationEmail');?>">Resend verification email</a></li>
</ul>

<?= form_open('user/login', ['id' => 'login-form']);?>

<div class="form-group">

    <label><?= $model->validationRules['email']['label'];?></label>

    <?= form_input(
        'email', 
        $data['email'] ?? '', 
        [
            'autofocus' => true,
            'class' => 'form-control'
        ]
    );?>

    <div class="invalid-feedback"><?= $errors['email'] ?? '';?></div>

</div>

<div class="form-group">

    <label><?= $model->validationRules['password']['label'];?></label>

    <?= form_password(
        'password', 
        '', 
        [
            'class' => 'form-control'
        ]
    );?>

    <div class="invalid-feedback"><?= $errors['password'] ?? '';?></div>

</div>

<div class="form-group">
    
    <label for="remember-me-checkbox"><?= $model->validationRules['rememberMe']['label'];?></label>

    <?= form_hidden('rememberMe', 0);?>

    <?= form_checkbox(
        'rememberMe',
        '1',
        (array_key_exists('rememberMe', $data) && $data['rememberMe']) ? true : false,
        [
            'id' => 'remember-me-checkbox'
        ]
    );?>

    <div class="invalid-feedback"><?= $errors['rememberMe'] ?? '';?></div>

</div>

<div class="form-group">
    
    <?= form_submit('login-button', 'Login', ['class' => 'btn btn-primary']);?>

</div>

<?= form_close();?>

<?php $this->endSection();?>