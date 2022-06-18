<?php

$this->data['subject'] = 'Message from: ' . base_url();

$this->data['mailType'] = 'html';

?>
Created: <?= date('d.m.Y H:i');?>
<br>
Subject: <?= esc($subject);?>
<br>
Text: <?= esc($body);?>