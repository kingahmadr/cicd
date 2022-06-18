<?php

namespace Admin\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Admin implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        if (current_url() == site_url('admin/login'))
        {
            return;
        }

        if (!adminAuth()->getId())
        {
            return redirect()->to('admin/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }

}