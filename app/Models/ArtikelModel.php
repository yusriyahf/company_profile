<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table            = 'tb_artikel';
    protected $primaryKey       = 'id_artikel';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'judul_artikel_id',
        'judul_artikel_en',
        'snippet_id',
        'snippet_en',
        'slug_artikel_id',
        'slug_artikel_en',
        'konten_id',
        'konten_en',
        'id_kategori_artikel',
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
            'tb_artikel.*, ' .
                'tb_kategori_artikel.slug_kategori_id, ' .
                'tb_kategori_artikel.slug_kategori_en, ' .
                ($lang === 'id' ? 'tb_kategori_artikel.nama_kategori_id' : 'tb_kategori_artikel.nama_kategori_en') . ' as nama_kategori, ' .
                ($lang === 'id' ? 'tb_kategori_artikel.slug_kategori_id' : 'tb_kategori_artikel.slug_kategori_en') . ' as slug_kategori'
        );

        // Join the category table properly
        $this->join('tb_kategori_artikel', 'tb_kategori_artikel.id_kategori_artikel = tb_artikel.id_kategori_artikel', 'left');

        // Filter by category if provided
        if ($categoryId) {
            $this->where('tb_artikel.id_kategori_artikel', $categoryId);
        }

        return $this->findAll(); // Return all results
    }
}
