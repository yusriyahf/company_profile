<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    protected $table            = 'tb_aktivitas';
    protected $primaryKey       = 'id_aktivitas';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_kategori_aktivitas',
        'judul_aktivitas_id',
        'judul_aktivitas_en',
        'slug_aktivitas_id',
        'slug_aktivitas_en',
        'snippet_id',
        'snippet_en',
        'deskripsi_aktivitas_id',
        'deskripsi_aktivitas_en',
        'foto_aktivitas',
        'alt_aktivitas_id',
        'alt_aktivitas_en',
        'title_aktivitas_id',
        'title_aktivitas_en',
        'meta_desc_id',
        'meta_desc_en',
        'created_at',
        'updated_at'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
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

    public function getArticlesWithCategory($categoryId = null, $lang = 'id')
    {
        // Select columns properly based on language
        $this->select(
            'tb_aktivitas.*, ' .
                'tb_kategori_aktivitas.slug_kategori_id, ' .
                'tb_kategori_aktivitas.slug_kategori_en, ' .
                ($lang === 'id' ? 'tb_kategori_aktivitas.nama_kategori_id' : 'tb_kategori_aktivitas.nama_kategori_en') . ' as nama_kategori, ' .
                ($lang === 'id' ? 'tb_kategori_aktivitas.slug_kategori_id' : 'tb_kategori_aktivitas.slug_kategori_en') . ' as slug_kategori'
        );

        // Join the category table properly
        $this->join('tb_kategori_aktivitas', 'tb_kategori_aktivitas.id_kategori_aktivitas = tb_aktivitas.id_kategori_aktivitas', 'left');

        // Filter by category if provided
        if ($categoryId) {
            $this->where('tb_aktivitas.id_kategori_aktivitas', $categoryId);
        }

        return $this->findAll(); // Return all results
    }

    public function getActivityWithCategory($slug)
    {
        return $this->select('tb_aktivitas.*, tb_kategori_aktivitas.nama_kategori_id, tb_kategori_aktivitas.nama_kategori_en')
            ->join('tb_kategori_aktivitas', 'tb_kategori_aktivitas.id_kategori_aktivitas = tb_aktivitas.id_kategori_aktivitas', 'left')
            ->where('tb_aktivitas.slug_aktivitas_id', $slug)
            ->orWhere('tb_aktivitas.slug_aktivitas_en', $slug)
            ->first();
    }
}
