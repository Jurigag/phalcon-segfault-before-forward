<?php

namespace Multiple\Frontend\Controllers;

use Phalcon\Mvc\Controller;

class ProductsController extends Controller
{

	public function indexAction()
	{
		return $this->response->redirect('login');
	}

    public function notFoundAction()
    {
        return $this->response->setContent('test');
    }
}
