<?php 
namespace App\Models;

use CodeIgniter\Model;

class ModelEmployee extends Model{
    protected $table      = 'tbl_employee'; 
    protected $primaryKey = "id_employee";
    protected $returnType = "object"; 
    protected $allowedFields = [
                                'id_employee',
                                'id_user',
                                'full_name_pegawai',
                                'alamat_pegawai',
                                'number_pegawai',
                                'jabatan_pegawai',
                                'tgl_crt_dt_vehicle'
                            ];



    function join_where($data = null)
    {
        $builder = $this->db->table('tbl_employee');  
        $builder->join('users', 'users.id = tbl_employee.id_user');    
        $builder->where('id_employee', $data);

        $query = $builder->get();

        return $query->getResult();
    }

}