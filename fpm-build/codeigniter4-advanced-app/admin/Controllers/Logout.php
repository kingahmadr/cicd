<?php

namespace Admin\Controllers;

class Logout extends BaseController
{

    public function index()
    {
        adminAuth()->unsetId();

        return $this->goHome();
    }

}