<?php

/* @var $this \CodeIgniter\View\View */
/* @var $model \App\Forms\ResetPasswordForm */

$this->data['title'] = 'Reset password';

$this->data['breadcrumbs'][] = $this->data['title'];

helper('form');

$this->extend('layout');

?>
<?php $this->section('content');?>

<p>Please choose your new password:</p>

<?= form_open('user/resetPassword/' . $id . '/' . $token, ['id' => 'reset-password-form']);?>

<div class="form-group">

    <label><?= $model->validationRules['password']['label'];?></label>

    <?= form_password(
        'password', 
        '', 
        [
            'class' => 'form-control',
            'autofocus' => true
        ]
    );?>

    <div class="invalid-feedback"><?= $errors['password'] ?? '';?></div>

</div>

<div class="form-group">

    <?= form_submit('send', 'Save', ['class' => 'btn btn-primary']);?>

</div>

<?= form_close();?>

<?php $this->endSection();?>