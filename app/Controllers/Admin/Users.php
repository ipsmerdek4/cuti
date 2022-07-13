<?php  
namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;  
use Myth\Auth\Entities\User; 
use Myth\Auth\Models\UserModel;


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
        
        
      $data = [
        'title' => 'Manage Users &raquo; User',
        'in_group' => in_groups('administrator'),
		  ]; 
		  return view('User/users_admin', compact('data'));  
        
    }

    public function view()
    {  

      $db = db_connect();
      $builder = $db->table('auth_groups_users')
                ->select('user_id, group_id, users.id, users.email, users.username, users.active, auth_groups.name, users.created_at')
                ->join('users', 'users.id = auth_groups_users.user_id') 
                ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');

       
      return DataTable::of($builder)
              ->addNumbering() //it will return data output with numbering on first column 
              ->add('action', function($row){
                  return    '<div class="btn-group mb-0 btn-group-sm" role="group" aria-label="action-btn">
                                <a href="'.base_url().'/musers/user/edit/'.$row->user_id.'" class="btn btn-success pt-2 pb-1 ps-3 pe-3""><i class="bi bi-pencil-square"></i></a> 
                                <a id="deleteuser" data-data="'.$row->email.'" data-id="'.$row->user_id.'" href="javascript:void(0)" class="btn btn-danger pt-2 pb-1 ps-3 pe-3"><i class="bi bi-trash2"></i></a>
                            </div>';
              })   
              ->format('active', function($value){
                    ($value == 1) ? $act = "<div class='badge bg-success text-wrap' style='width: 6rem;'>Active</div>" : $act = "<div class='badge bg-danger text-wrap' style='width: 6rem;'>Not Active</div>"; 
                    return $act;
              })  
              ->format('name', function($value){ 
                    $act = "<div class='badge bg-primary text-wrap text-uppercase' style='width: 9rem;'>".$value."</div>"; 
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
          'title' => 'Add User &raquo; User',
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



          $email_user = $this->request->getVar('email_user');
          $username   = $this->request->getVar('username');
          $password   = $this->request->getVar('password');
          $pengguna   = $this->request->getVar('pengguna');
          $activate_hash = \Myth\Auth\Password::hash($password."^*".$email_user);

          $this->builder2->selectCount('id');
          $ttlUsers = $this->builder2->get()->getResult();

          $Last_id_Users = ($ttlUsers[0]->id + 1)+100;
          
          $data1 = [
            'id'              => $Last_id_Users,
            'email '          => $email_user,
            'username'        => $username,
            'password_hash'   => \Myth\Auth\Password::hash($password),
            'activate_hash'   => $activate_hash,
            'created_at'      => date("Y-m-d H:s:i"), 
          ];

          $insert1 = $this->builder2->insert($data1);
 
          $data2 = [
            'group_id '       => $pengguna,
            'user_id  '       => $Last_id_Users, 
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


          session()->setFlashdata('msg', 'User Berhasil di tambahkan.');
          return redirect()->to(base_url('/musers/user'));




    }


    public function edit($id = null)
    {
      $q_auth_groups   = $this->builder->get();  // Produces: SELECT * FROM mytable
       

      session();
      $data = [
        'q_auth_groups' => $q_auth_groups->getResult(),
        'title' => 'Edit User &raquo; User',
        'in_group' => in_groups('administrator'),
        'validation' => \Config\Services::validation(),
      ];
      return view('User/users_admin_edit', compact('data') );  

    }

    public function update()
    {

    }

    public function destroy($id = null)
    {
          $user_id  = $id;

          $this->builder2->where('id', $user_id);
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