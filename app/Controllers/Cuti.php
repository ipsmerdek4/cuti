<?php  
namespace App\Controllers;

use \Hermawan\DataTables\DataTable;    
use App\Models\ModelCategoriCuti;  
use App\Models\ModelEmployee;  



class Cuti extends BaseController
{
	public function index()
	{ 

		$CategoriCuti = new ModelCategoriCuti();
		$getCategoriCuti = $CategoriCuti->orderBy('status_categori_cuti', 'DESC')->orderBy('tgl_create_dt_categori_cuti', 'DESC')->findAll();

		session();
		$data = [
			'title' 			=> 'Manage Cuti &raquo; Cuti Online',
			'in_group' 			=> in_groups('administrator'),
			'getCategoriCuti'	=> $getCategoriCuti,
			'validation'		=> \Config\Services::validation(),
		]; 
		return view('cuti/cuti', compact('data'));  
	}

 
    public function view()
	{
		$db = db_connect();
		$builder = $db->table('tbl_cuti')
				  ->select('id_cuti, tbl_cuti.id_employee, tbl_cuti.id_categori_cuti, full_name_pegawai, nama_categori_cuti,  tgl_pengajuan, tgl_berakhir, descripsi_cuti, status_cuti')
				  ->join('tbl_employee', 'tbl_employee.id_employee = tbl_cuti.id_employee')
				  ->join('tbl_categori_cuti', 'tbl_categori_cuti.id_categori_cuti = tbl_cuti.id_categori_cuti');
  
    
		return DataTable::of($builder)
				->addNumbering() //it will return data output with numbering on first column 
				->add('action', function($row){
					return    '<div class="btn-group mb-0 btn-group-sm" role="group" aria-label="action-btn">
								  <a href="'.base_url().'/musers/employee/edit/'.$row->id_cuti.'" class="btn btn-success pt-2 pb-1 ps-3 pe-3""><i class="bi bi-pencil-square"></i></a> 
								  <a id="delete" data-data="'.$row->id_cuti.'" data-id="'.$row->id_cuti.'" href="javascript:void(0)" class="btn btn-danger pt-2 pb-1 ps-3 pe-3"><i class="bi bi-trash2"></i></a>
							  </div>';
				})    
				->hide('id_cuti') 
				->hide('id_employee') 
				->hide('id_categori_cuti')   
				->toJson();
   
	}

	
	public function categori_view()
	{ 
		$data = $this->request->getVar('data');
		$CategoriCuti = new ModelCategoriCuti();
		$getCategoriCuti =  $CategoriCuti->where('id_categori_cuti', $data)->findAll();
 
		echo json_encode($getCategoriCuti[0]);
	}


	public function add()
	{ 
		$Employee 			= new ModelEmployee();
		$CategoriCuti 		= new ModelCategoriCuti();

		$getEmployee 		=  $Employee->findAll();
		$getCategoriCuti 	=  $CategoriCuti->where('status_categori_cuti', 1)->findAll();

		session();
		$data = [
 		  'title' 			=> 'Add Cuti &raquo; Cuti Online',
		  'in_group' 		=> in_groups('administrator'),
		  'validation' 		=> \Config\Services::validation(),
		  'getEmployee' 	=> $getEmployee,
		  'getCategoriCuti'	=> $getCategoriCuti,
		];
 
		return view('cuti/cuti_add', compact('data') );  
	}

	public function resource()
	{
			if (!$this->validate([ 
				'name_employee'    =>  [
					'ruler'   => 'required',
					'errors'    => [
							'required' => '{field} Tidak Boleh Kosong.',
						]
				],
				'nama_Kategori'    =>  [
					'ruler'   => 'required',
					'errors'    => [
							'required' => '{field} Tidak Boleh Kosong.',
						]
				],
				'tanggal_pengajuan_cuti'    =>  [
					'ruler'   => 'required',
					'errors'    => [
							'required' => '{field} Tidak Boleh Kosong.',
						]
				],
				'deskripsi_cuti'    =>  [
					'ruler'   => 'required',
					'errors'    => [
							'required' => '{field} Tidak Boleh Kosong.',
						]
				], 
			])) {
				$validation = \Config\Services::validation();  
				return redirect()->to('/mcuti/add')->withInput();
			}
	}

	public function categori_resource()
	{
		
				if (!$this->validate([ 
					'nama_categori_cuti'    =>  [
						'ruler'   => 'required', 'is_unique[tbl_categori_cuti.nama_categori_cuti]',
						'errors'    => [
							'required'  => '{field} Harus di Pilih.', 
							'is_unique'  => '{field} Sudah dibuat, Silahkan buat baru.', 
							]
					],
					'max_categori_cuti'    =>  [
						'ruler'   => 'required',
						'errors'    => [
								'required' => '{field} Tidak Boleh Kosong.',
							]
					],
				])) {
					$validation = \Config\Services::validation();  
					return redirect()->to('/mcuti')->withInput();
				}

				$CategoriCuti = new ModelCategoriCuti();

				$nama_categori_cuti = $this->request->getVar('nama_categori_cuti');
				$max_categori_cuti = $this->request->getVar('max_categori_cuti');


				$data1 = [ 
					'nama_categori_cuti'     		=> $nama_categori_cuti,
					'max_categori_cuti'        		=> $max_categori_cuti,
					'status_categori_cuti'        	=> 1,
					'tgl_create_dt_categori_cuti'	=> date("Y-m-d H:s:i"), 
				];
		
				  $CategoriCuti->insert($data1);
			  
				  session()->setFlashdata('successmodal', '~');
				  return redirect()->to(base_url('/mcuti'));






	}

	public function edit($id = null)
	{

	}

	public function updates($id = null)
	{

	}

	public function categori_update( )
	{
			$ID = $this->request->getVar('ID');
			$sts = $this->request->getVar('sts');

			$CategoriCuti	= new ModelCategoriCuti();

			$data1 = [
                'status_categori_cuti'				=> $sts,
                'tgl_update_dt_categori_cuti'    	=> date('Y-m-d H:m:i'),   
            ];
 
            $CategoriCuti->update($ID, $data1);
			
			$msg = [
				'msg' => 'Success',
			];

			session()->setFlashdata('successmodal', '~');

			echo json_encode($msg);

	}

	public function destroy($id = null)
	{

	}


}
