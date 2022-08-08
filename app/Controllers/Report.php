<?php 
namespace App\Controllers;

 

use Dompdf\Dompdf;
use Dompdf\Options;

use App\Models\ModelEmployee;  

use App\Models\ModelCuti;  



class Report extends BaseController
{
 
	public function __construct()
    {
      $this->db = \Config\Database::connect();
      $this->builder = $this->db->table('auth_groups');
      $this->builder2 = $this->db->table('users');
      $this->builder3 = $this->db->table('auth_groups_users');
    }
	public function index()
	{ 

		$get_userdata =  $this->builder2->where('id', user_id())->get()->getResult();

		$data = [
			'title' => 'Dashboard',
			'in_group' => in_groups('administrator'), 
			'get_userdata'			=> $get_userdata[0]->name_users,
		]; 
		return view('report', compact('data')); 
		 
	}

	public function Cetak($var = null)
	{ 
		if ((in_groups('administrator') == true)||(in_groups('kplbgn') == true)) {
			  
			$Cuti		= new ModelCuti();

		/* 	$getCuti = $Cuti
						->join('tbl_categori_cuti', 'tbl_categori_cuti.id_categori_cuti = tbl_cuti.id_categori_cuti')
						->join('tbl_employee', 'tbl_employee.id_employee = tbl_cuti.id_employee')
						->like('tgl_pengajuan', $var)
						->findAll(); */


			$getCuti = $Cuti
						->join('tbl_employee', 'tbl_employee.id_employee = tbl_cuti.id_employee')
						->like('tgl_pengajuan', $var)
						->findAll();

			$pecah = explode("-", $var);			
			if ($pecah[1] == 1) {
				$bulan = "Januari";
			}elseif ($pecah[1] == 2) {
				$bulan = "Februari"; 
			}elseif ($pecah[1] == 3) {
				$bulan = "Maret"; 
			}elseif ($pecah[1] == 4) {
				$bulan = "April"; 
			}elseif ($pecah[1] == 5) {
				$bulan = "Mei"; 
			}elseif ($pecah[1] == 6) {
				$bulan = "Juni"; 
			}elseif ($pecah[1] == 7) {
				$bulan = "Juli"; 
			}elseif ($pecah[1] == 8) {
				$bulan = "Agustus"; 
			}elseif ($pecah[1] == 9) {
				$bulan = "September"; 
			}elseif ($pecah[1] == 10) {
				$bulan = "Oktober"; 
			}elseif ($pecah[1] == 11) {
				$bulan = "November"; 
			}elseif ($pecah[1] == 12) {
				$bulan = "Desember"; 
			}
 
			$data = [
				'title'             => "Laporan Cuti~".$bulan.' '.$pecah[0] ,
				'date'				=> $bulan.' '.$pecah[0],
				'getCuti'			=> $getCuti,
			];

		


		
				
				$views = view('report_pdf', $data);

				$dompdfs 	= new Dompdf(); 
				$html 		= $views; 
				$dompdfs->setPaper('A4', 'Portrait'); 
				$dompdfs->loadHtml($html); 
				$dompdfs->set_option('isRemoteEnabled', true);
				$dompdfs->set_option("isPhpEnabled", true); 
				$dompdfs->render();
				$dompdfs->stream('LaporanCuti'.date('Ymdhis').'.pdf', array(
						"Attachment" => false

				));  



		}  
	}
	


}
