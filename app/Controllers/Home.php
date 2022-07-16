<?php namespace App\Controllers;

class Home extends BaseController
{

	public function __construct()
    {
      $this->db = \Config\Database::connect();
      $this->builder = $this->db->table('auth_logins'); 
      $this->builder2 = $this->db->table('tbl_employee'); 
      $this->builder3 = $this->db->table('tbl_cuti'); 
    }

	public function index()
	{
		
		$q_auth_logins = $this->builder->where('success', '1')->like('date', date('Y-m-d'))->groupBy('user_id')->countAllResults();  // Produces: SELECT * FROM mytable
		$q_employee = $this->builder2->selectCount('full_name_pegawai')->get();  // Produces: SELECT * FROM mytable
		$q_cuti = $this->builder3->selectCount('tgl_pengajuan')->like('tgl_create_dt_cuti', date('Y-m-d'))->get();  // Produces: SELECT * FROM mytable
 
	 
		$data = [
			'title' => 'Dashboard',
			'in_group' => in_groups('administrator'),
			'count_login_indays'	=> $q_auth_logins,
			'count_employee'		=> $q_employee->getResult()[0]->full_name_pegawai,
			'count_cuti'			=> $q_cuti->getResult()[0]->tgl_pengajuan,
		];
		  

		return view('home', compact('data')); 
		
		





	}

	//--------------------------------------------------------------------

}
