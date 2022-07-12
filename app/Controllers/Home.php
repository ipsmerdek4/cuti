<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
 
		$data = [
			'title' => 'Home',
			'in_group' => in_groups('administrator'),
		];
		  

		return view('home', compact('data'));  
	}

	//--------------------------------------------------------------------

}
