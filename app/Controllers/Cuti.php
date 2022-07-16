<?php  
namespace App\Controllers;

use \Hermawan\DataTables\DataTable;    
use App\Models\ModelCategoriCuti;  
use App\Models\ModelEmployee;  
use App\Models\ModelCuti;  


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
		$Employee = new ModelEmployee(); 
		$getEmployee = $Employee->where('id_user', user()->id)->findAll();  

		$db = db_connect();
		if ((in_groups('administrator') == true)||(in_groups('kplbgn'))) {
			$builder = $db->table('tbl_cuti')
						->select('id_cuti, status_cuti, tbl_cuti.id_employee, tbl_cuti.id_categori_cuti, full_name_pegawai, nama_categori_cuti,  tgl_pengajuan, tgl_berakhir, descripsi_cuti')
						->join('tbl_employee', 'tbl_employee.id_employee = tbl_cuti.id_employee')
						->join('tbl_categori_cuti', 'tbl_categori_cuti.id_categori_cuti = tbl_cuti.id_categori_cuti');
		}else{ 
			$builder = $db->table('tbl_cuti')
						->select('id_cuti, status_cuti, tbl_cuti.id_employee, tbl_cuti.id_categori_cuti, full_name_pegawai, nama_categori_cuti,  tgl_pengajuan, tgl_berakhir, descripsi_cuti')
						->join('tbl_employee', 'tbl_employee.id_employee = tbl_cuti.id_employee')
						->join('tbl_categori_cuti', 'tbl_categori_cuti.id_categori_cuti = tbl_cuti.id_categori_cuti') 
						->where('tbl_cuti.id_employee', $getEmployee[0]->id_employee);

		}
		 
		  
		return DataTable::of($builder)
				->addNumbering() //it will return data output with numbering on first column  
				->add('action', function($row){ 
					  if ((in_groups('administrator') == true)||(in_groups('kplbgn'))) {   	 
						($row->status_cuti == 1) ? $act = '<small class="text-primary fw-bold text-decoration-underline">Approve</small>' : $act = '<a id="approval" data-data="'.$row->full_name_pegawai.'" data-id="'.$row->id_cuti.'" href="javascript:void(0)" class="btn btn-danger" style="font-size:12px;">Not Approve</a>'; 
						return $act;
					}else{
						($row->status_cuti == 1) ? $act = '<small class="text-primary fw-bold text-decoration-underline">Approve</small>' : $act = '<small class="text-danger fw-bold text-decoration-underline">Not Approve</small>'; 
						return $act;
					}  
				})  
				->add('action2', function($row2){
					return    '<div class="btn-group mb-0 btn-group-sm" role="group" aria-label="action-btn">
								  <a href="'.base_url().'/mcuti/edit/'.$row2->id_cuti.'" class="btn btn-success pt-2 pb-1 ps-3 pe-3""><i class="bi bi-pencil-square"></i></a> 
								  <a id="delete" data-data="'.$row2->full_name_pegawai.'" data-id="'.$row2->id_cuti.'" href="javascript:void(0)" class="btn btn-danger pt-2 pb-1 ps-3 pe-3"><i class="bi bi-trash2"></i></a>
							  </div>';
				})     
				->hide('status_cuti') 
				->hide('id_cuti') 
				->hide('id_employee') 
				->hide('id_categori_cuti')   
				->toJson();
   
	}

	public function approve($var = null)
	{	 
		$Cuti = new ModelCuti();
	
		$data1 = [
			'status_cuti'			=> 1, 
			'tgl_update_dt_cuti'	=> date("Y-m-d H:s:i"), 
		];

		$Cuti->update($var, $data1);

		session()->setFlashdata('msg', 'Approve Cuti Berhasil.');
		return redirect()->to(base_url('/mcuti'));
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

		$Employee = new ModelEmployee(); 
		$getEmployee = $Employee->where('id_user', user()->id)->findAll();   

		if (in_groups('administrator') == true) {
			$getEmployee 		=  $Employee->findAll(); 
		}else{
			$getEmployee 		=  $Employee->where('id_employee', $getEmployee[0]->id_employee)->findAll(); 
		}
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
				'lama_cuti'    =>  [
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

			$Cuti = new ModelCuti();

			$name_employee 			= $this->request->getVar('name_employee');
			$nama_Kategori 			= $this->request->getVar('nama_Kategori');
			$tanggal_pengajuan_cuti = $this->request->getVar('tanggal_pengajuan_cuti');
			$deskripsi_cuti 		= $this->request->getVar('deskripsi_cuti');
			$lama_cuti 				= $this->request->getVar('lama_cuti');
			$pecahlama_cuti			= explode(" ", $lama_cuti); 
			$newlama_cuti    		= date('Y-m-d', strtotime('+'.$pecahlama_cuti[0]." days", strtotime($tanggal_pengajuan_cuti)));  

			$data1 = [
				'id_employee'			=> $name_employee,
				'id_categori_cuti'     	=> $nama_Kategori,
				'tgl_pengajuan'        	=> $tanggal_pengajuan_cuti,
				'tgl_berakhir'        	=> $newlama_cuti,
				'descripsi_cuti'       	=> $deskripsi_cuti, 
				'status_cuti'       	=> 0, 
				'tgl_create_dt_cuti'    => date("Y-m-d H:s:i"), 
			  ];
	
			  $Cuti->insert($data1);
		  
			  session()->setFlashdata('msg', 'Cuti Berhasil di Tambahkan.');
			  return redirect()->to(base_url('/mcuti'));






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
		$Employee 			= new ModelEmployee();
		$CategoriCuti 		= new ModelCategoriCuti();
		$Cuti				= new ModelCuti(); 
		$Employee			= new ModelEmployee(); 


		$getEmployee = $Employee->where('id_user', user()->id)->findAll();   

		if (in_groups('administrator') == true) {
			$getEmployee 		=  $Employee->findAll(); 
		}else{
			$getEmployee 		=  $Employee->where('id_employee', $getEmployee[0]->id_employee)->findAll(); 
		}
		$getCategoriCuti 	=  $CategoriCuti->where('status_categori_cuti', 1)->findAll();
		$getCuti 			=  $Cuti->join('tbl_categori_cuti', 'tbl_categori_cuti.id_categori_cuti = tbl_cuti.id_categori_cuti')->where('id_cuti', $id)->findAll();



		session();
		$data = [
			'title'         	=> 'Edit Employee &raquo; Cuti Online',
			'in_group'      	=> in_groups('administrator'),
			'validation'    	=> \Config\Services::validation(), 
			'ID'            	=> $id,
			'getEmployee'		=> $getEmployee,
			'getCategoriCuti'	=> $getCategoriCuti,
			'getCuti'			=> $getCuti[0],
		];
 
		return view('cuti/cuti_edit', compact('data') );  
	}

	public function updates($id = null)
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
			'lama_cuti'    =>  [
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
			return redirect()->to('/mcuti/edit/'.$id)->withInput();
		}

		$Cuti = new ModelCuti();

		$name_employee 			= $this->request->getVar('name_employee');
		$nama_Kategori 			= $this->request->getVar('nama_Kategori');
		$tanggal_pengajuan_cuti = $this->request->getVar('tanggal_pengajuan_cuti');
		$deskripsi_cuti 		= $this->request->getVar('deskripsi_cuti');
		$lama_cuti 				= $this->request->getVar('lama_cuti');
		$pecahlama_cuti			= explode(" ", $lama_cuti); 
		$newlama_cuti    		= date('Y-m-d', strtotime('+'.$pecahlama_cuti[0]." days", strtotime($tanggal_pengajuan_cuti)));  

		$data1 = [
			'id_employee'			=> $name_employee,
			'id_categori_cuti'     	=> $nama_Kategori,
			'tgl_pengajuan'        	=> $tanggal_pengajuan_cuti,
			'tgl_berakhir'        	=> $newlama_cuti,
			'descripsi_cuti'       	=> $deskripsi_cuti,  
			'tgl_update_dt_cuti'    => date("Y-m-d H:s:i"), 
		];

		$Cuti->update($id, $data1);

		session()->setFlashdata('msg', 'Pengajuan Cuti Berhasil di Perbaharui.');
		return redirect()->to(base_url('/mcuti'));






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
		$id_cuti 	= $id; 
		$Cuti		= new ModelCuti();

		$xdeletnya 	= $Cuti->delete($id_cuti); 

		if ($xdeletnya) {  
			session()->setFlashdata('msg', '<div style="font-size:15px;">Delete Successfully.<br><br></div>');  
			return redirect()->to(base_url('/mcuti')); 
		} else {
			session()->setFlashdata('error', '<div class="" style="font-size:15px;">An error occurred while deleting data.<br>Please repeat again.</div>');
			return redirect()->to(base_url('/mcuti'));
		} 
	}


}
