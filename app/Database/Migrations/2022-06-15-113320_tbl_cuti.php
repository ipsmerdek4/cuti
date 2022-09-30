<?php 
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbl_cuti extends Migration{
    public function up(){

        $this->forge->addField([ 
            'id_cuti'                   => [ 'type' => 'INT', 'constraint' => 10, 'unsigned' => true, 'auto_increment' => true ],   
			'id_employee'               => [ 'type' => 'INT', 'constraint' => 10, 'unsigned' => true, ],  
			'id_categori_cuti'          => [ 'type' => 'INT', 'null' => true, 'constraint' => 10, 'unsigned' => true, ],    
			'tgl_pengajuan'             => [ 'type' => 'DATE', ],  
			'tgl_berakhir'              => [ 'type' => 'DATE', ],  
			'descripsi_cuti'            => [ 'type' => 'TEXT'  ],
            'cuti_tahunan'              => [ 'type' => 'INT', 'constraint' => 10,],   
            'category_tahunan'          => [ 'type' => 'INT', 'constraint' => 10,],   
            'sisa_cuti_tahunan'         => [ 'type' => 'INT', 'constraint' => 10,],   
			'status_cuti'               => [ 'type' => 'TINYINT', ],
			'tgl_create_dt_cuti'        => [ 'type' => 'DATETIME', 'null' => true, ],   
			'tgl_update_dt_cuti'        => [ 'type' => 'DATETIME', 'null' => true, ],   
        ]);
        
        $this->forge->addPrimaryKey('id_cuti', true);        
        $this->forge->addForeignKey('id_employee', 'tbl_employee', 'id_employee');  
        $this->forge->addForeignKey('id_categori_cuti', 'tbl_categori_cuti', 'id_categori_cuti');  
        $this->forge->createTable('tbl_cuti');
    }

    public function down(){
        $this->forge->dropTable('tbl_cuti');
    }
}