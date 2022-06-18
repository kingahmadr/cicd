<?php

/* @var $this \CodeIgniter\View\View */
/* @var $data \App\Models\ContactForm */

$this->data['title'] = 'Contact';

$this->data['breadcrumbs'][] = $this->data['title'];

helper(['form']);

$this->extend('layout');

?>
<?php $this->section('content');?>

<p>Please fill out the following form to contact us. Thank you.</p>

<?php if($message):?>

    <div class="alert alert-success"><?= $message;?></div>

<?php endif;?>

<?= form_open('contact', ['id' => 'contact-form']);?>

<?php foreach($customErrors as $error):?>

    <div class="alert alert-error"><?= $error;?></div>

<?php endforeach;?>

<div class="form-group">

    <label><?= $model->validationRules['name']['label'];?></label>

    <?= form_input(
        'name', 
        $data['name'] ?? '', 
        [
            'class' => 'form-control',
            'autofocus' => true
        ]
    );?>

    <div class="invalid-feedback"><?= $errors['name'] ?? '';?></div>

</div>

<div class="form-group">

    <label><?= $model->validationRules['email']['label'];?></label>

    <?= form_input(
        'email', 
        $data['email'] ?? '', 
        [
            'class' => 'form-control'
        ]
    );?>

    <div class="invalid-feedback"><?= $errors['email'] ?? '';?></div>

</div>

<div class="form-group">

    <label><?= $model->validationRules['subject']['label'];?></label>
    
    <?= form_input(
        'subject', 
        $data['subject'] ?? '', 
        [
            'class' => 'form-control'
        ]
    );?>

    <div class="invalid-feedback"><?= $errors['subject'] ?? '';?></div>

</div>

<div class="form-group">

    <label><?= $model->validationRules['body']['label'];?></label>
    
    <?= form_textarea(
        'body', 
        $data['body'] ?? '', 
        [
            'class' => 'form-control',
            'rows' => 6
        ]
    );?>

    <div class="invalid-feedback"><?= $errors['body'] ?? '';?></div>

</div>

<div class="form-group">

    <?= form_submit('contact-button', 'Submit', ['class' => 'btn btn-primary']);?>

</div>

<?= form_close();?>

<?php $this->endSection();?>