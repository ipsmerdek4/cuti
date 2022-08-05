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
                                <a href="'.base_url().'/musers/pegawai/edit/'.$row->id_employee.'" class="btn btn-success pt-2 pb-1 ps-3 pe-3""><i class="bi bi-pencil-square"></i></a> 
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
          $q_auth_groups   = $this->builder->get();  // Produces: SELECT * FROM mytable


          session();
          $data = [
            'q_auth_groups' => $q_auth_groups->getResult(), 
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
            'nama_depan'  => [
                  'ruler'   => 'required', 
                  'errors'    => [
                        'required' => '{field} Tidak Boleh Kosong.',
                  ]
            ],
            'nama_belakang'    =>  [
                  'ruler'   => 'required',
                  'errors'    => [
                        'required' => '{field} Tidak Boleh Kosong.',
                      ]
            ],
            'nomer_pengguna'    =>  [
                  'ruler'   => 'required',
                  'errors'    => [
                        'required' => '{field} Tidak Boleh Kosong.',
                      ]
            ], 
            'jabatan_pengguna'    =>  [
                  'ruler'   => 'required',
                  'errors'    => [
                        'required' => '{field} Tidak Boleh Kosong.',
                      ]
            ],
            'alamat_pengguna'    =>  [
                  'ruler'   => 'required',
                  'errors'    => [
                        'required' => '{field} Tidak Boleh Kosong.',
                      ]
            ],
            'email_pengguna'    =>  [
                  'ruler'   => 'required',
                  'errors'    => [
                        'required' => '{field} Tidak Boleh Kosong.',
                      ]
            ],
            'username'    =>  [
                  'ruler'   => 'required',
                  'errors'    => [
                        'required' => '{field} Tidak Boleh Kosong.',
                      ]
            ],
            'password'    =>  [
                  'ruler'   => 'required',
                  'errors'    => [
                        'required' => '{field} Tidak Boleh Kosong.',
                      ]
            ],
            'pengguna'    =>  [
                  'ruler'   => 'required',
                  'errors'    => [
                        'required' => '{field} Tidak Boleh Kosong.',
                      ]
            ],
          ])) {
            $validation = \Config\Services::validation();  
            return redirect()->to('/musers/pegawai/add')->withInput();
          }

          $name_employee1 = $this->request->getVar('nama_depan');
          $name_employee2 = $this->request->getVar('nama_belakang');
          $number_employee = $this->request->getVar('nomer_pengguna');
          $jabatan_employee = $this->request->getVar('jabatan_pengguna');
          $alamat_employee = $this->request->getVar('alamat_pengguna');

          $email_pengguna = $this->request->getVar('email_pengguna'); 
          $username = $this->request->getVar('username');
          $password = $this->request->getVar('password');
          $pengguna = $this->request->getVar('pengguna');

          
          $chkverfikasi = $this->request->getVar('chkverfikasi'); 
          $activate_hash = \Myth\Auth\Password::hash($password."^*".$email_pengguna);

          $Last_id_Users_P  = $this->builder2->select('id')->orderBy('id','desc')->limit(1)->get()->getResult()[0];
          $Last_id_Users    = $Last_id_Users_P->id+1;
 
            if ($chkverfikasi == 'on') {  
                                    
                        $data1 = [ 
                        'id'              => $Last_id_Users,
                        'name_users'      => $name_employee1,
                        'email'           => $email_pengguna,
                        'username'        => $username,
                        'password_hash'   => \Myth\Auth\Password::hash($password),
                        'activate_hash'   => $activate_hash,
                        'created_at'      => date("Y-m-d H:s:i"), 
                        ];

                        $this->builder2->insert($data1); 

                        $data2 = [
                        'group_id'      => $pengguna,
                        'user_id'       => $Last_id_Users, 
                        ];

                        $insert2 = $this->builder3->insert($data2);


                  
                        $message = "This is activation email for your account on ".base_url(). 
                              "<br>To activate your account use this URL".
                              "<br><br><br><h1><a href='".base_url()."/activate-account?token=".$activate_hash."'>Activate account.</a></h1>". 
                                    "<br><br><br>If you did not registered on this website, you can safely ignore this email.";

                        $email = \Config\Services::email();
                        $email->setFrom('mycuti2022@gmail.com', 'MyCuti Online');
                        $email->setTo($email_pengguna);
                        $email->setSubject('Activate your account MyCuti Online');
                        $email->setMessage($message);//your message here
                        
                        //$email->setCC('another@emailHere');//CC
                        //$email->setBCC('thirdEmail@emialHere');// and BCC
                        //$filename = '/img/yourPhoto.jpg'; //you can use the App patch 
                        //$email->attach($filename); 
                        $email->send();
                        //$email->printDebugger(['headers']); 
            }else{

                                    
                        $data1 = [ 
                        'id'              => $Last_id_Users,
                        'name_users'      => $name_employee1,
                        'email'           => $email_pengguna,
                        'username'        => $username,
                        'password_hash'   => \Myth\Auth\Password::hash($password),
                        'active'          => 1,
                        'created_at'      => date("Y-m-d H:s:i"), 
                        ];

                        $this->builder2->insert($data1); 

                        $data2 = [
                        'group_id'      => $pengguna,
                        'user_id'       => $Last_id_Users, 
                        ];

                        $insert2 = $this->builder3->insert($data2); 
            }




            $data3 = [
                  'id_user'               => $Last_id_Users,
                  'full_name_pegawai'     => $name_employee1.' '.$name_employee2,
                  'alamat_pegawai'        => $alamat_employee,
                  'number_pegawai'        => $number_employee,
                  'jabatan_pegawai'       => $jabatan_employee, 
                  'tgl_crt_dt_vehicle'    => date("Y-m-d H:s:i"), 
                ];
      
                $Employee->insert($data3);
      
 
      
            session()->setFlashdata('msg', 'Employee Berhasil di Tambahkan.');
            return redirect()->to(base_url('/musers/pegawai'));

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
            $alamat_employee    = $this->request->getVar('alamat_employee');

            $data1 = [
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
          $dumpEmployee = $Employee->where('id_employee', $id_employee)->get()->getResult(); 
          $user_id = $dumpEmployee[0]->id_user;


          $getEmployee = $Employee->where('id_employee', $id_employee); 
          $this->builder2->where('id', $user_id );


          $xdeletnya2 = $getEmployee->delete();
          $xdeletnya =  $this->builder2->delete(); 
 
          if ($xdeletnya) {  
              session()->setFlashdata('msg', '<div style="font-size:15px;">Delete Successfully.<br><br></div>');  
              return redirect()->to(base_url('/musers/pegawai')); 
          } else {
              session()->setFlashdata('error', '<div class="" style="font-size:15px;">An error occurred while deleting data.<br>Please repeat again.</div>');
              return redirect()->to(base_url('/musers/pegawai'));
          } 

    }

}