<?php 
namespace App\Models;

use CodeIgniter\Model;

class ModelCategoriCuti extends Model{
    protected $table      = 'tbl_categori_cuti'; 
    protected $primaryKey = "id_categori_cuti";
    protected $returnType = "object"; 
    protected $allowedFields = [
                                'nama_categori_cuti',
                                'max_categori_cuti',
                                'status_categori_cuti',
                                'tgl_create_dt_categori_cuti',
                                'tgl_update_dt_categori_cuti', 
                            ];

}