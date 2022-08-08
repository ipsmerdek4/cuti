<?php 
namespace App\Models;

use CodeIgniter\Model;

class ModelCuti extends Model{
    protected $table      = 'tbl_cuti';
    protected $primaryKey = "id_cuti";
    protected $returnType = "object"; 
    protected $allowedFields = [
                                'id_employee',
                                'id_categori_cuti',
                                'tgl_pengajuan',
                                'tgl_berakhir',
                                'descripsi_cuti',
                                'cuti_tahunan',
                                'sisa_cuti_tahunan',
                                'status_cuti',
                                'tgl_create_dt_cuti',
                                'tgl_update_dt_cuti'
                            ];
}