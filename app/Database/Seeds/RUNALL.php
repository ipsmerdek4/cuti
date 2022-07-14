<?php 
namespace App\Database\Seeds;

class RUNALL extends \CodeIgniter\Database\Seeder{
    public function run(){
        $this->call('users');
        $this->call('auth_groups');
        $this->call('auth_groups_users'); 


    }
}