<?php

use CodeIgniter\Events\Events;

Events::on('pre_system', function() {

    helper(['admin_auth']);
});