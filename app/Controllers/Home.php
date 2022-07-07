<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$title = 'Login';

		return view('home', compact('title'));
	}

	//--------------------------------------------------------------------

}
