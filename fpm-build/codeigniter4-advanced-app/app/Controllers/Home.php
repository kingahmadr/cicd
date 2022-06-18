<?php

namespace App\Controllers;

class Home extends BaseController
{

	public function index()
	{
		return $this->render('welcome_message');
	}

}