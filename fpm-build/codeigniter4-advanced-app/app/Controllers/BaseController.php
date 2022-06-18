<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Config\Services;

abstract class BaseController extends \CodeIgniter\Controller
{

    protected $session;

    protected $user;

    protected $viewsNamespace;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->session = Services::session();

        $this->user = auth()->getUser();
    }

    protected function render(string $view, array $params = [], array $options = [])
    {
        if (mb_strpos("\\", $view) === false)
        {
            if ($this->viewsNamespace)
            {
                $view = $this->viewsNamespace . "\\" . $view;
            }
        }

        if (array_key_exists('saveData', $options) == false)
        {
            $options['saveData'] = true;
        }

        return view($view, $params, $options);
    }

    public function goHome()
    {
        return $this->redirect(base_url());
    }

    public function redirect($url)
    {
        return redirect()->withCookies()->to($url);
    }

}