<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{

/* 
		$message = "Please activate the account ".anchor('user/activate/','Activate Now','');
		$email = \Config\Services::email();
		$email->setFrom('mycuti2022@gmail.com', 'your Title Here');
		$email->setTo('ojan1990@gmail.com');
		$email->setSubject('Your Subject here | tutsmake.com');
		$email->setMessage($message);//your message here
	  
	 	$email->setCC('another@emailHere');//CC
		$email->setBCC('thirdEmail@emialHere');// and BCC
		$filename = '/img/yourPhoto.jpg'; //you can use the App patch 
		$email->attach($filename); 
		$email->send();
		//$email->printDebugger(['headers']);

		 
 */
		 





 
		$data = [
			'title' => 'Home',
			'in_group' => in_groups('administrator'),
		];
		  

		return view('home', compact('data')); 
		
		





	}

	//--------------------------------------------------------------------

}
