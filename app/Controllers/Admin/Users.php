<?php  
namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;  
use Myth\Auth\Entities\User; 
use Myth\Auth\Models\UserModel; 
use App\Models\ModelEmployee;  


class Users extends BaseController
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
        'title' => 'Manage Users &raquo; User',
        'in_group' => in_groups('administrator'),
        'get_userdata'			=> $get_userdata[0]->name_users,

		  ]; 
		  return view('User/users_admin', compact('data'));  
        
    }

    public function view()
    {  

      

      $db = db_connect();
      $builder = $db->table('auth_groups_users')
                ->select('user_id, group_id, users.id, users.name_users, users.email, users.username, users.active, auth_groups.name, users.created_at')
                ->join('users', 'users.id = auth_groups_users.user_id') 
                ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');

       
      return DataTable::of($builder)
              ->addNumbering() //it will return data output with numbering on first column 
              ->add('action', function($row){  
                    $getuser_id = $this->builder2->where('id', '101')->get()->getResult(); 
                    if ($row->user_id == '101') {  
                      return    '<div class="btn-group mb-0 btn-group-sm" role="group" aria-label="action-btn">
                                    <a href="'.base_url().'/musers/user/edit/'.$row->user_id.'" class="btn btn-success pt-2 pb-1 ps-3 pe-3""><i class="bi bi-pencil-square"></i></a> 
                                    <a href="javascript:void(0)" class="btn btn-danger pt-2 pb-1 ps-3 pe-3 disabled"><i class="bi bi-trash2"></i></a>
                                </div>'; 
                    }else{
                          return    '<div class="btn-group mb-0 btn-group-sm" role="group" aria-label="action-btn">
                                        <a href="'.base_url().'/musers/user/edit/'.$row->user_id.'" class="btn btn-success pt-2 pb-1 ps-3 pe-3""><i class="bi bi-pencil-square"></i></a> 
                                        <a id="deleteuser" data-data="'.$row->email.'" data-id="'.$row->user_id.'" href="javascript:void(0)" class="btn btn-danger pt-2 pb-1 ps-3 pe-3"><i class="bi bi-trash2"></i></a>
                                    </div>'; 
                    }
              })   
              ->format('active', function($value){ 
                  ($value == 1) ? $act = "<div class='fw-bolder text-success' style='width: 6rem;'>Active</div>" : $act = "<div class='fw-bolder text-danger' style='width: 6rem;'>Not Active</div>"; 
                 
                  return $act; 
              })  
              ->format('name', function($value){  
                    $act = "<div class='fw-bolder text-primary text-center' style='width: 9rem;'>".$value."</div>"; 
                    return $act;
              })
              ->hide('user_id') 
              ->hide('group_id')  
              ->hide('id')     
              ->toJson();
 
                      
    }

 
    public function add()
    { 
 
        $q_auth_groups   = $this->builder->get();  // Produces: SELECT * FROM mytable
       

        session();
        $data = [
          'q_auth_groups' => $q_auth_groups->getResult(),
          'title' => 'Add User &raquo; Cuti Online',
          'in_group' => in_groups('administrator'),
          'validation' => \Config\Services::validation(),
        ];
 
          

        return view('User/users_admin_add', compact('data') );  
        
    }


    public function resource()
    {
      
 
          if (!$this->validate([
              'email_user'  => [
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
              'full_name'    =>  [
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
                          'required' => '{field} Harus di Pilih.',
                        ]
              ],
            ])) {
            $validation = \Config\Services::validation();  
            return redirect()->to('/musers/user/add')->withInput();
          }

          $chkverfikasi = $this->request->getVar('chkverfikasi');

       
          $full_name = $this->request->getVar('full_name');
          $email_user = $this->request->getVar('email_user');
          $username   = $this->request->getVar('username');
          $password   = $this->request->getVar('password');
          $pengguna   = $this->request->getVar('pengguna');
          $activate_hash = \Myth\Auth\Password::hash($password."^*".$email_user);

       

          $Last_id_Users_P  = $this->builder2->select('id')->orderBy('id','desc')->limit(1)->get()->getResult()[0];
          $Last_id_Users    = $Last_id_Users_P->id+1;

       

        

          if ($chkverfikasi == 'on') { 

                        
                  $data1 = [ 
                    'id'              => $Last_id_Users,
                    'name_users'      => $full_name,
                    'email'           => $email_user,
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
                  $email->setTo($email_user);
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
                      'name_users'      => $full_name,
                      'email'           => $email_user,
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

          session()->setFlashdata('msg', 'User Berhasil di tambahkan.');
          return redirect()->to(base_url('/musers/user'));




    }


    public function edit($id = null)
    {
      $id_users = $id;
      $get_userdata =  $this->builder2->where('id', user_id())->get()->getResult();

      $getUsers = $this->builder3->join('users', 'users.id = auth_groups_users.user_id') 
                                ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
                                ->where('users.id', $id_users)->get();

    
      $q_auth_groups   = $this->builder->get();  // Produces: SELECT * FROM mytable
       

      session();
      $data = [
        'q_auth_groups' => $q_auth_groups->getResult(),
        'title'         => 'Edit User &raquo; User',
        'in_group'      => in_groups('administrator'),
        'validation'    => \Config\Services::validation(),
        'getusers'      => $getUsers->getResult(),
        'ID'            => $id,
        'get_userdata'			=> $get_userdata[0]->name_users,
      ];
      return view('User/users_admin_edit', compact('data') );  

    }

    public function update($id = null)
    {
      
       
            if (!$this->validate([
              'email_user'  => [
                    'ruler'   => 'required',
                    'errors'    => [
                          'required' => '{field} Tidak Boleh Kosong.',
                    ]
              ],
              'full_name'    =>  [
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
              'pengguna'    =>  [
                    'ruler'   => 'required',
                    'errors'    => [
                          'required' => '{field} Harus di Pilih.',
                        ]
              ],
            ])) {
              $validation = \Config\Services::validation();  
              return redirect()->to('/musers/user/edit/'.$id)->withInput();
            }  

            $statuspress  = $this->request->getVar('statuspress');

            

            $full_name  = $this->request->getVar('full_name');
            $email_user = $this->request->getVar('email_user');
            $username   = $this->request->getVar('username');
            $pengguna   = $this->request->getVar('pengguna'); 


            $getUsers = $this->builder3->join('users', 'users.id = auth_groups_users.user_id') 
                                ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
                                ->where('users.id', $id)->get();

            $group_id = $getUsers->getResult()[0]->group_id; 

             $chkpass = $this->request->getVar('chkpass');
             if ($chkpass == "on") {

                if ($statuspress == 'on') {
                    $newstatus = 1;
                }else{
                    $newstatus = 0; 
                }

                      $password   = $this->request->getVar('password'); 
                      $data1 = [ 
                        'email'           => $email_user,
                        'name_users'      => $full_name,
                        'username'        => $username,
                        'password_hash'   => \Myth\Auth\Password::hash($password), 
                        'active'          => $newstatus,
                        'updated_at'      => date("Y-m-d H:s:i"), 
                      ]; 
                      
                      $this->builder2->update($data1, 'id = '.$id); 
                      
                      $this->builder3->update(['group_id' => $pengguna], 'user_id = '.$id);
                  
                 
             }else{ 
                    if ($statuspress == 'on') {
                        $newstatus = 1;
                    }else{
                        $newstatus = 0; 
                    } 
                    $data2 = [ 
                      'email '          => $email_user,
                      'name_users'      => $full_name,
                      'username'        => $username, 
                      'active'          => $newstatus,
                      'updated_at'      => date("Y-m-d H:s:i"), 
                    ]; 

                    $this->builder2->update($data2, 'id = '.$id);
 
                    $this->builder3->update(['group_id' => $pengguna], 'user_id = '.$id);

             } 
              
   
             session()->setFlashdata('msg', 'User Berhasil di Perbaharui.');
             return redirect()->to(base_url('/musers/user'));
   



    }

    public function destroy($id = null)
    {
          $user_id  = $id;

          $Employee = new ModelEmployee();

          $getEmployee = $Employee->where('id_user', $user_id);
          $this->builder2->where('id', $user_id);


          $xdeletnya2 = $getEmployee->delete();
          $xdeletnya = $this->builder2->delete(); 

          if ($xdeletnya) {  
              session()->setFlashdata('msg', '<div style="font-size:15px;">Delete Successfully.<br><br></div>');  
              return redirect()->to(base_url('/musers/user')); 
          } else {
              session()->setFlashdata('error', '<div class="" style="font-size:15px;">An error occurred while deleting data.<br>Please repeat again.</div>');
              return redirect()->to(base_url('/musers/user'));
          } 


    }

}