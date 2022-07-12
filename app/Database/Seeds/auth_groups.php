<?php 
namespace App\Database\Seeds;

class Auth_groups extends \CodeIgniter\Database\Seeder{
    public function run(){
        $data = [
            [
            "id" => "101",
            "name" => "administrator",
            "description" => " Level Pengguna administrator",
            ],
            [
            "id" => "102",
            "name" => "pegawai",
            "description" => " Level Pengguna Pegawai",
            ],
            [
            "id" => "103",
            "name" => "kplbgn",
            "description" => " Level Pengguna Kepala Bagian",
            ],
        ];

        $this->db->table('auth_groups')->insertBatch($data);
    }
}