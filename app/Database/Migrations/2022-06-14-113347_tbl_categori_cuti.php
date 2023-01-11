<?php 
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbl_categori_cuti extends Migration{
    public function up(){   

        $this->forge->addField([ 
            'id_categori_cuti'              => [ 'type' => 'INT', 'constraint' => 10, 'unsigned' => true, 'auto_increment' => true ],   
		 	'nama_categori_cuti'            => [ 'type' => 'VARCHAR', 'constraint' => 100, ],
            'max_categori_cuti'             => [ 'type' => 'INT', ],
            'max_penggunaan_ccuti'          => [ 'type' => 'INT', ],
            'status_categori_cuti'          => [ 'type' => 'TINYINT', ],
            'tgl_create_dt_categori_cuti'   => [ 'type' => 'DATETIME', 'null' => true, ],   
			'tgl_update_dt_categori_cuti'   => [ 'type' => 'DATETIME', 'null' => true, ],   
        ]);
        
        $this->forge->addKey('id_categori_cuti', true);         
        $this->forge->createTable('tbl_categori_cuti');
    }

    public function down(){
        $this->forge->dropTable('tbl_categori_cuti');
    }
}