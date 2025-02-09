<?php

namespace App\Models;

use CodeIgniter\Model;

class MetaModel extends Model
{
    protected $table            = 'tb_meta';
    protected $primaryKey       = 'id_meta';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_halaman_en', 'nama_halaman_id', 'deskripsi_halaman_id', 'deskripsi_halaman_en', 'title_id', 'title_en', 'meta_desc_id', 'meta_desc_en'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nama_halaman_id' => 'required|max_length[255]',
        'nama_halaman_en' => 'required|max_length[255]',
        'deskripsi_halaman_id' => 'required|max_length[255]',
        'deskripsi_halaman_en' => 'required|max_length[255]',
        'title_id'        => 'permit_empty|string',
        'title_en'        => 'permit_empty|string',
        'meta_desc_id'    => 'permit_empty|string',
        'meta_desc_en'    => 'permit_empty|string',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
