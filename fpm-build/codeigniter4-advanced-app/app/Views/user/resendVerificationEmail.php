<?php

/* @var $this \CodeIgniter\View\View */
/* @var $model \App\Forms\ResendVerificationEmailForm */

$this->data['title'] = 'Resend verification email';

$this->data['breadcrumbs'][] = $this->data['title'];

helper('form');

$this->extend('layout');

?>

<?php $this->section('content');?>

<p>Please fill out your email. A verification email will be sent there.</p>

<?php foreach($customErrors as $error):?>

    <div class="alert alert-error"><?= $error;?></div>

<?php endforeach;?>

<?= form_open('user/resendVerificationEmail', ['id' => 'resend-verification-email-form']);?>

<div class="form-group">

    <label><?= $model->validationRules['email']['label'];?></label>

    <?= form_input(
        'email', 
        $data['email'] ?? '', 
        [
            'class' => 'form-control',
            'autofocus' => true
        ]
    );?>

    <div class="invalid-feedback"><?= $errors['email'] ?? '';?></div>

</div>

<div class="form-group">

    <?= form_submit('send', 'Send', ['class' => 'btn btn-primary']);?>

</div>

<?= form_close();?>

<?php if(CI_DEBUG):?>
<p>If your server is not configured to send emails, you can create a link by manually constructing a URL with the following form:<br>
<b style="color: red;"><?= site_url('user/verifyEmail/:id/:token');?></b></p>
<?php endif;?>

<?php $this->endSection();?>