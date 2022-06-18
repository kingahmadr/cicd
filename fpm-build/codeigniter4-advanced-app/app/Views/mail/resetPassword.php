<?php

use App\Models\UserModel;

$this->data['subject'] = 'Password reset for ' . base_url();

$this->data['mailType'] = 'html';

?>
Hello <?= esc($user->name);?>,
<br>
<br>
Follow the link below to reset your password:
<br>
<a href="<?= $resetLink;?>"><?= $resetLink;?></a>