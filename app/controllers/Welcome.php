<?php
use core\Controller;

class Welcome extends Controller
{
	public function index()
	{
		$this->view->view('index', array('name'=>'vvke'));
	}
}