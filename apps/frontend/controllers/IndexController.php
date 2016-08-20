<?php

namespace Multiple\Frontend\Controllers;

use Phalcon\Exception;
use Phalcon\Mvc\Controller;

class IndexController extends Controller
{

	public function indexAction()
	{
        throw new Exception('test');
	}
}
