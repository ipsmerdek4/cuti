<?php 
namespace App\Controllers;



class Report extends BaseController
{
 

	public function index()
	{
	  
		$data = [
			'title' => 'Dashboard',
			'in_group' => in_groups('administrator'), 
		];
		  

		return view('report', compact('data')); 
		
		





	}

	//--------------------------------------------------------------------

}
