<?php  
namespace App\Controllers\Admin;

use \Hermawan\DataTables\DataTable;


class Users extends BaseController
{

    public function index()
    {  
        
        
      $data = [
        'title' => 'Manage Users &raquo; User',
        'in_group' => in_groups('administrator'),
		  ]; 
		  return view('users_admin', compact('data'));  
        
    }

    public function view()
    {  

      $db = db_connect();
      $builder = $db->table('users')->select('id, email, username, active, created_at');
       
      return DataTable::of($builder)
              ->addNumbering() //it will return data output with numbering on first column 
              ->add('action', function($row){
                  return    '<div class="btn-group mb-0 btn-group-sm" role="group" aria-label="action-btn">
                                <a href="'.base_url().'/admin/musers/edit/'.$row->id.'" class="btn btn-success pt-2 pb-1 ps-3 pe-3""><i class="bi bi-pencil-square"></i></a> 
                                <a href="'.base_url().'/admin/musers/delete/'.$row->id.'" class="btn btn-danger pt-2 pb-1 ps-3 pe-3"><i class="bi bi-trash2"></i></a>
                            </div>';
              })   
              ->hide('id')  
 
              ->toJson();
 
                      
    }

 
    public function add()
    { 
        
        $data = [
          'title' => 'Add User &raquo; User',
          'in_group' => in_groups('administrator'),
        ];
          

        return view('users_admin_add', compact('data'));  
        
    }


    public function resource()
    {

    }


    public function edit($id = null)
    {

    }

    public function update()
    {

    }

    public function destroy($id = null)
    {

    }

}