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
        'id_kategori_artikel',
        'judul_artikel_id',
        'judul_artikel_en',
        'slug_artikel_id',
        'slug_artikel_en',
        'snippet_id',
        'snippet_en',
        'deskripsi_artikel_id',
        'deskripsi_artikel_en',
        'foto_artikel',
        'alt_artikel_id',
        'alt_artikel_en',
        'title_artikel_id',
        'title_artikel_en',
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
    protected $useTimestamps = true;
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

    public function getPaginatedArticles($categoryId = null, $lang = 'id', $perPage = 3)
    {
        $this->select(
            'tb_artikel.*, ' .
                'tb_kategori_artikel.slug_kategori_id, ' .
                'tb_kategori_artikel.slug_kategori_en, ' .
                ($lang === 'id' ? 'tb_kategori_artikel.nama_kategori_id' : 'tb_kategori_artikel.nama_kategori_en') . ' as nama_kategori, ' .
                ($lang === 'id' ? 'tb_kategori_artikel.slug_kategori_id' : 'tb_kategori_artikel.slug_kategori_en') . ' as slug_kategori'
        );

        $this->join('tb_kategori_artikel', 'tb_kategori_artikel.id_kategori_artikel = tb_artikel.id_kategori_artikel', 'left');

        if ($categoryId) {
            $this->where('tb_artikel.id_kategori_artikel', $categoryId);
        }

        $this->orderBy('tb_artikel.created_at', 'DESC');

        return $this->paginate($perPage);
    }

    public function getArticle($lang = 'id', $categoryId = null)
    {
        $this->select(
            'tb_artikel.*, ' .
                'tb_kategori_artikel.slug_kategori_id, ' .
                'tb_kategori_artikel.slug_kategori_en, ' .
                ($lang === 'id' ? 'tb_kategori_artikel.nama_kategori_id' : 'tb_kategori_artikel.nama_kategori_en') . ' as nama_kategori, ' .
                ($lang === 'id' ? 'tb_kategori_artikel.slug_kategori_id' : 'tb_kategori_artikel.slug_kategori_en') . ' as slug_kategori'
        );

        // Tidak memeriksa kategori, cukup ambil artikel acak
        $this->join('tb_kategori_artikel', 'tb_kategori_artikel.id_kategori_artikel = tb_artikel.id_kategori_artikel', 'left');

        // Ambil secara acak dan batasi satu hasil
        $this->orderBy('RAND()');
        $this->limit(1);

        return $this->findAll();  // Kembalikan hasil sebagai array
    }


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

        // Order by latest uploaded (assuming 'created_at' stores upload time)
        $this->orderBy('tb_artikel.created_at', 'DESC');

        return $this->findAll(); // Return all results
    }


    public function getSideArticlesWithCategory($categoryId = null, $lang = 'id')
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

        // Order by latest uploaded (assuming 'created_at' stores upload time)
        $this->orderBy('tb_artikel.created_at', 'DESC');

        return $this->findAll(5); // Return only 5 results
    }

    public function getSideArticlesWithCategoryRand($lang = 'id')
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

        // Order by random
        $this->orderBy('RAND()');

        // Limit the result to 5 random articles
        return $this->findAll(5); // Return only 5 random results
    }



    public function getArtikelWithCategory($slug)
    {
        return $this->select('tb_artikel.*, tb_kategori_artikel.nama_kategori_id, tb_kategori_artikel.nama_kategori_en')
            ->join('tb_kategori_artikel', 'tb_kategori_artikel.id_kategori_artikel = tb_artikel.id_kategori_artikel', 'left')
            ->where('tb_artikel.slug_artikel_id', $slug)
            ->orWhere('tb_artikel.slug_artikel_en', $slug)
            ->first();
    }

    public function getArtikelWithCategoryAdmin()
    {
        return $this->select('tb_artikel.*, tb_kategori_artikel.nama_kategori_id as nama_kategori')
            ->join('tb_kategori_artikel', 'tb_kategori_artikel.id_kategori_artikel = tb_artikel.id_kategori_artikel', 'left')
            ->findAll();
    }
}
