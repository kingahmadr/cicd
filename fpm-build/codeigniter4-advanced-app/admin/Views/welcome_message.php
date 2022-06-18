<?php

$this->data['title'] = 'Welcome to CodeIgniter 4';

$this->extend('Admin\layout');

?>
<?php $this->section('content');?>

<h1>About this page</h1>

<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

<p>If you would like to edit this page you will find it located at:</p>

<pre><code>admin/Views/welcome_message.php</code></pre>

<p>The corresponding controller for this page can be found at:</p>

<pre><code>admin/Controllers/Home.php</code></pre>

<?php $this->endSection();?>