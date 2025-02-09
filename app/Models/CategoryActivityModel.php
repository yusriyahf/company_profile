<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryActivityModel extends Model
{
    protected $table            = 'tb_kategori_aktivitas';
    protected $primaryKey       = 'id_kategori_aktivitas';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_kategori_id',
        'nama_kategori_en',
        'slug_kategori_id',
        'slug_kategori_en',
        'title_kategori_id',
        'title_kategori_en',
        'meta_desc_id',
        'meta_desc_en',
        'created_at',
        'updated_at',
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

    public function getCategoryBySlug($slugCategory, $lang = 'id')
    {
        // Return the first result from the query
        return $this->where('slug_kategori_id', $slugCategory)->orWhere('slug_kategori_en', $slugCategory)
            ->first();
    }

    /**
     * Mendapatkan semua kategori dalam bahasa tertentu
     *
     * @param string $lang
     * @return array
     */
    public function getAllCategories(string $lang = 'id')
    {
        $fieldName = $lang === 'id' ? 'nama_kategori_id' : 'nama_kategori_en';
        $fieldSlug = $lang === 'id' ? 'slug_kategori_id' : 'slug_kategori_en';

        return $this->select("id_kategori_aktivitas, $fieldName as nama_kategori, $fieldSlug as slug_kategori")
            ->orderBy('id_kategori_aktivitas', 'ASC')
            ->findAll();
    }

    public function getKategoriTerbanyak()
    {
        $result = $this->select('tb_kategori_aktivitas.nama_kategori_id, tb_kategori_aktivitas.slug_kategori_id')
            ->selectCount('tb_aktivitas.id_aktivitas', 'total_aktivitas')
            ->join('tb_aktivitas', 'tb_aktivitas.id_kategori_aktivitas = tb_kategori_aktivitas.id_kategori_aktivitas', 'left')
            ->groupBy('tb_kategori_aktivitas.id_kategori_aktivitas')
            ->orderBy('total_aktivitas', 'DESC')
            ->limit(5)
            ->findAll();

        return $result ?: [];  // Pastikan array dikembalikan
    }
}
