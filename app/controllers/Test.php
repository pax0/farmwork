<?php
use core\Controller;

class Test extends Controller
{
	public function index()
	{
		$this->view->view('index', array('name'=>'vvke'));
	}
}