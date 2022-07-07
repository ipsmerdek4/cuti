<?php 

namespace App\Controllers\Admin;




class Homeadmin extends BaseController
{

    public function index()
    {
        $title = 'Login';

		return view('home_admin', compact('title')); 
    }

}