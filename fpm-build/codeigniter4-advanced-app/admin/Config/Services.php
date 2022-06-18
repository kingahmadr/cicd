<?php

namespace Admin\Config;

use Exception;
use CodeIgniter\Config\Services as CoreServices;

class Services extends CoreServices
{

    public static function adminAuth($getShared = true)
    {
        if ($getShared)
        {
            return static::getSharedInstance(__FUNCTION__);
        }

        return new \BasicApp\Admin\AdminService('admin_id');
    }

}