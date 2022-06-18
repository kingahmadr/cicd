<?php

use App\Models\UserModel;

$this->data['subject'] = 'Account verification at ' . base_url();

$this->data['mailType'] = 'text';

?>
Hello <?= esc($user->name);?>,
<br>
<br>
Follow the link below to verify your email:
<br>
<a href="<?= $verifyLink;?>"><?= $verifyLink;?></a>