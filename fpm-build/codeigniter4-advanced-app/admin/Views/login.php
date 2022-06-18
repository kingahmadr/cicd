<?php

/* @var $this \CodeIgniter\View\View */
/* @var $model \Admin\Forms\LoginForm */

$this->data['title'] = 'Login';

$this->data['breadcrumbs'][] = $this->data['title'];

helper(['form']);

$this->extend('Admin\layout');

?>

<?php $this->section('content');?>

<p>Please fill out the following fields to login:</p>

<?= form_open('admin/login', ['id' => 'login-form']);?>

<div class="form-group">

    <label><?= lang('Username');?></label>

    <?= form_input(
        'username', 
        $data['username'] ?? '', 
        [
            'autofocus' => true,
            'class' => 'form-control'
        ]
    );?>

    <div class="invalid-feedback"><?= $errors['username'] ?? '';?></div>

</div>

<div class="form-group">

    <label><?= lang('Password');?></label>

    <?= form_password('password', '', [
        'class' => 'form-control'
    ]);?>

    <div class="invalid-feedback"><?= $errors['password'] ?? '';?></div>

</div>

<div class="form-group">
    
    <label for="remember-me-checkbox"><?= lang('Remember Me');?></label>

    <?= form_hidden('rememberMe', 0);?>

    <?= form_checkbox('rememberMe', '1', (array_key_exists('rememberMe', $data) && $data['rememberMe']) ? true : false, [
        'id' => 'remember-me-checkbox'
    ]);?>

    <div class="invalid-feedback"><?= $errors['rememberMe'] ?? '';?></div>

</div>

<div class="form-group">
    
    <?= form_submit('login-button', 'Login', ['class' => 'btn btn-primary']);?>

</div>

<?= form_close();?>

<?php $this->endSection();?>