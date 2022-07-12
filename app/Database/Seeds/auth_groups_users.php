<?php 
namespace App\Database\Seeds;

class auth_groups_users extends \CodeIgniter\Database\Seeder{
    public function run(){
        $data = [
            [ 
                "group_id" => 101,
                "user_id " => 101, 
            ], 
        ];

        $this->db->table('auth_groups_users')->insertBatch($data);
    }
}