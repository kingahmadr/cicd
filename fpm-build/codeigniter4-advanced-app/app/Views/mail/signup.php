<?php

use App\Models\UserModel;

$this->data['subject'] = 'Account registration at ' . base_url();

$this->data['mailType'] = 'html';

?>
Hello <?= esc($user->name);?>,
<br>
<br>
Follow the link below to verify your email:
<br>
<a href="<?= $verifyLink;?>"><?= $verifyLink;?></a>