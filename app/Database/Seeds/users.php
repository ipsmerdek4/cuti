<?php 
namespace App\Database\Seeds;

class users extends \CodeIgniter\Database\Seeder{
    public function run(){
        $data = [
            [ 
                "id"            => "101",
                "name_users"    => "admin",
                "email"         => "administrator@administrator.com",
                "username"      => "administrator",
                "password_hash" =>  \Myth\Auth\Password::hash("administrator"),
                "active"        => "1",
                "created_at"    =>  date("Y-m-d H:s:i"), 
            ], 
        ];

        $this->db->table('users')->insertBatch($data);
    }
}