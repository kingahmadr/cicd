<?php

/* @var $this \CodeIgniter\View\View */
/* @var $model \App\Forms\SignupForm */

$this->data['title'] = 'Signup';

$this->data['breadcrumbs'][] = $this->data['title'];

helper(['form']);

$this->extend('layout');

?>
<?php $this->section('content');?>
    
<p>Please fill out the following fields to signup:</p>

<ul>
    <li><a href="<?= site_url('user/requestPasswordReset');?>">Request password reset</a></li>
    <li><a href="<?= site_url('user/resendVerificationEmail');?>">Resend verification email</a></li>
</ul>

<?= form_open('user/signup', ['id' => 'form-signup']);?>

<?php foreach($customErrors as $error):?>

    <div class="alert alert-error"><?= $error;?></div>

<?php endforeach;?>

<div class="form-group">

    <label><?= $model->validationRules['username']['label'];?></label>

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

    <label><?= $model->validationRules['email']['label'];?></label>

    <?= form_input(
        'email', 
        array_key_exists('email', $data) ? $data['email'] : '', 
        [
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

<?php foreach($errors as $error):?>

    <div class="alert alert-error"><?= $error;?></div>

<?php endforeach;?>

<div class="form-group">

    <?= form_submit('signup-button', 'Signup', ['class' => 'btn btn-primary']);?>

</div>

<?= form_close();?>

<?php if(CI_DEBUG):?>
<p>If your server is not configured to send emails, you can create a link by manually constructing a URL with the following form:<br>
<b style="color: red;"><?= site_url('user/verifyEmail/:id/:token');?></b></p>
<?php endif;?>

<?php $this->endSection();?>