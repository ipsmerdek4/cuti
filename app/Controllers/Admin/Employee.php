<?php  
namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;    
use App\Models\ModelEmployee;  

class Employee extends BaseController
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
           
      $data = [
                        'title' => 'Manage Users &raquo; Employee',
                        'in_group' => in_groups('administrator'),
		  ]; 
      return view('pegawai/pegawai', compact('data'));  
        
    }

    public function view()
    {  

      $db = db_connect();
      $builder = $db->table('tbl_employee')
                ->select('id_user, id_employee, tbl_employee.full_name_pegawai, tbl_employee.number_pegawai, tbl_employee.jabatan_pegawai, tbl_employee.alamat_pegawai')
                ->join('users', 'users.id = tbl_employee.id_user');

 


      return DataTable::of($builder)
              ->addNumbering() //it will return data output with numbering on first column 
              ->add('action', function($row){
                  return    '<div class="btn-group mb-0 btn-group-sm" role="group" aria-label="action-btn">
                                <a href="'.base_url().'/musers/employee/edit/'.$row->id_employee.'" class="btn btn-success pt-2 pb-1 ps-3 pe-3""><i class="bi bi-pencil-square"></i></a> 
                                <a id="delete" data-data="'.$row->full_name_pegawai.'" data-id="'.$row->id_employee.'" href="javascript:void(0)" class="btn btn-danger pt-2 pb-1 ps-3 pe-3"><i class="bi bi-trash2"></i></a>
                            </div>';
              })    
              ->hide('id_user') 
              ->hide('id_employee')   
              ->toJson();
 
 
                      
    }

 
    public function add()
    { 
          $get_user   = $this->builder2->get();  // Produces: SELECT * FROM mytable
          

          session();
          $data = [
            'get_user' => $get_user->getResult(),
            'title' => 'Add Employee &raquo; Cuti Online',
            'in_group' => in_groups('administrator'),
            'validation' => \Config\Services::validation(),
          ];

            

          return view('pegawai/pegawai_add', compact('data') );  
        
    }


    public function resource()
    {
          $Employee = new ModelEmployee();

          if (!$this->validate([
            'name_employee'  => [
                  'ruler'   => 'required', 
                  'errors'    => [
                        'required' => '{field} Tidak Boleh Kosong.',
                  ]
            ],
            'number_employee'    =>  [
                  'ruler'   => 'required',
                  'errors'    => [
                        'required' => '{field} Tidak Boleh Kosong.',
                      ]
            ],
            'jabatan_employee'    =>  [
                  'ruler'   => 'required',
                  'errors'    => [
                        'required' => '{field} Tidak Boleh Kosong.',
                      ]
            ],
            'pengguna_employee'    =>  [
                  'ruler'   => 'required', 'is_unique[tbl_employee.id_user]',
                  'errors'    => [
                      'required'  => '{field} Harus di Pilih.', 
                      'is_unique'  => 'Role Login Sudah digunakan, Silahkan gunakan yang lain.', 
                    ]
            ],
            'alamat_employee'    =>  [
                  'ruler'   => 'required',
                  'errors'    => [
                        'required' => '{field} Tidak Boleh Kosong.',
                      ]
            ],
          ])) {
            $validation = \Config\Services::validation();  
            return redirect()->to('/musers/employee/add')->withInput();
          }

          $name_employee = $this->request->getVar('name_employee');
          $number_employee = $this->request->getVar('number_employee');
          $jabatan_employee = $this->request->getVar('jabatan_employee');
          $pengguna_employee = $this->request->getVar('pengguna_employee');
          $alamat_employee = $this->request->getVar('alamat_employee');


          $data1 = [
            'id_user'               => $pengguna_employee,
            'full_name_pegawai'     => $name_employee,
            'alamat_pegawai'        => $alamat_employee,
            'number_pegawai'        => $number_employee,
            'jabatan_pegawai'       => $jabatan_employee, 
            'tgl_crt_dt_vehicle'    => date("Y-m-d H:s:i"), 
          ];

          $Employee->insert($data1);
      
          session()->setFlashdata('msg', 'Employee Berhasil di Tambahkan.');
          return redirect()->to(base_url('/musers/employee'));

    }


    public function edit($id = null)
    { 
            $Employee       = new ModelEmployee();  
            $getemployee    = $Employee->join_where($id); 
            $get_user       = $this->builder2->get();   

             

            session();
            $data = [
              'getemployee'   => $getemployee,
              'title'         => 'Edit Employee &raquo; Cuti Online',
              'in_group'      => in_groups('administrator'),
              'validation'    => \Config\Services::validation(), 
              'ID'            => $id,
              'get_user'      => $get_user->getResult(),
            ];
            return view('pegawai/pegawai_edit', compact('data') );  
    }

    public function updates($id = null)
    { 
            if (!$this->validate([
              'name_employee'  => [
                    'ruler'   => 'required',
                    'errors'    => [
                          'required' => '{field} Tidak Boleh Kosong.',
                    ]
              ],
              'number_employee'    =>  [
                    'ruler'   => 'required',
                    'errors'    => [
                          'required' => '{field} Tidak Boleh Kosong.',
                        ]
              ],
              'jabatan_employee'    =>  [
                    'ruler'   => 'required',
                    'errors'    => [
                          'required' => '{field} Tidak Boleh Kosong.',
                        ]
              ],
              'pengguna_employee'    =>  [
                    'ruler'   => 'required',
                    'errors'    => [
                        'required'  => '{field} Harus di Pilih.',  
                      ]
              ],
              'alamat_employee'    =>  [
                    'ruler'   => 'required',
                    'errors'    => [
                          'required' => '{field} Tidak Boleh Kosong.',
                        ]
              ],
            ])) {
              $validation = \Config\Services::validation();  
              return redirect()->to('/musers/employee/add')->withInput();
            }

          
            $Employee = new ModelEmployee();


            $name_employee      = $this->request->getVar('name_employee');
            $number_employee    = $this->request->getVar('number_employee');
            $jabatan_employee   = $this->request->getVar('jabatan_employee');
            $pengguna_employee  = $this->request->getVar('pengguna_employee');
            $alamat_employee    = $this->request->getVar('alamat_employee');

            $data1 = [
                'id_user'               => $pengguna_employee,
                'full_name_pegawai'     => $name_employee,
                'alamat_pegawai'        => $alamat_employee,
                'number_pegawai'        => $number_employee,
                'jabatan_pegawai'       => $jabatan_employee,  
            ];
 
            $Employee->update($id, $data1);

            session()->setFlashdata('msg', 'Employee Berhasil di Perbaharui.');
            return redirect()->to(base_url('/musers/employee'));


    }

    public function destroy($id = null)
    {
          $id_employee  = $id; 
          $Employee = new ModelEmployee();

          $xdeletnya = $Employee->delete($id_employee); 

          if ($xdeletnya) {  
              session()->setFlashdata('msg', '<div style="font-size:15px;">Delete Successfully.<br><br></div>');  
              return redirect()->to(base_url('/musers/employee')); 
          } else {
              session()->setFlashdata('error', '<div class="" style="font-size:15px;">An error occurred while deleting data.<br>Please repeat again.</div>');
              return redirect()->to(base_url('/musers/employee'));
          } 

    }

}