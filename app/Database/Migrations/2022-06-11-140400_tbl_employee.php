<?php 
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbl_employee extends Migration{
    public function up(){ 
        
        $this->forge->addField([ 
            'id_employee'               => [ 'type' => 'INT', 'constraint' => 10, 'unsigned' => true, 'auto_increment' => true ],   
			'id_user'                   => [ 'type' => 'int', 'constraint' => 11, 'unsigned' => true, ],  
			'full_name_pegawai'         => [ 'type' => 'VARCHAR', 'constraint' => 100, ],   
			'alamat_pegawai'            => [ 'type' => 'TEXT', ],  
			'number_pegawai'            => [ 'type' => 'VARCHAR', 'constraint' => 20, ],  
			'jabatan_pegawai'           => [ 'type' => 'VARCHAR', 'constraint' => 100, ],
			'tgl_crt_dt_vehicle'        => [ 'type' => 'DATETIME', 'null' => true, ],   
        ]);
        
        $this->forge->addPrimaryKey('id_employee', true);        
        $this->forge->addForeignKey('id_user', 'users', 'id');
        $this->forge->createTable('tbl_employee', true);
    
    }

    public function down(){
        $this->forge->dropTable('tbl_employee');
    }
}