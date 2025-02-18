<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ContentController extends BaseController
{
    protected $lang;
    protected $uri;

    public function __construct()
    {
        $this->lang = session()->get('lang') ?? 'id';
        $this->uri = service('uri');
    }
    public function index()
    {
        // Ambil segmen kedua dari URL
        $segment = $this->uri->getSegment(2);
        $canonical = site_url();

        // Tentukan canonical URL berdasarkan segment yang diminta
        if ($segment === 'contact' || $segment === 'kontak') {
            $canonical = base_url("$this->lang/" . ($this->lang === 'id' ? 'kontak' : 'contact'));
        } elseif ($segment === 'about' || $segment === 'tentang') {
            $canonical = base_url("$this->lang/" . ($this->lang === 'id' ? 'tentang' : 'about'));
        } elseif ($segment === 'product' || $segment === 'produk') {
            $canonical = base_url("$this->lang/" . ($this->lang === 'id' ? 'produk' : 'product'));
        } elseif ($segment === 'article' || $segment === 'artikel') {
            $canonical = base_url("$this->lang/" . ($this->lang === 'id' ? 'artikel' : 'article'));
        } elseif ($segment === 'aktivitas' || $segment === 'activity') {
            $canonical = base_url("$this->lang/" . ($this->lang === 'id' ? 'aktivitas' : 'activity'));
        }

        // Jika URL tidak sesuai dengan canonical, lakukan redirect
        if (current_url() !== $canonical) {
            return redirect()->to($canonical);
        }
    }
    public function category()
    {
        $segment1 = $this->uri->getSegment(2); // aktivitas atau artikel
        $segment2 = $this->uri->getSegment(3); // kategori
        $canonical = site_url();

        if (($segment1 === 'aktivitas' || $segment1 === 'activity') && $segment2) {
            $canonical = base_url("$this->lang/" . ($this->lang === 'id' ? 'aktivitas' : 'activity') . "/$segment2");
        } elseif (($segment1 === 'artikel' || $segment1 === 'article') && $segment2) {
            $canonical = base_url("$this->lang/" . ($this->lang === 'id' ? 'artikel' : 'article') . "/$segment2");
        } elseif (($segment1 === 'produk' || $segment1 === 'product') && $segment2) {
            $canonical = base_url("$this->lang/" . ($this->lang === 'id' ? 'produk' : 'product') . "/$segment2");
        }

        if (current_url() !== $canonical) {
            return redirect()->to($canonical);
        }
    }
    public function detail()
    {
        $segment1 = $this->uri->getSegment(2); // aktivitas atau artikel
        $segment2 = $this->uri->getSegment(3); // kategori
        $segment3 = $this->uri->getSegment(4); // slug detail
        $canonical = site_url();

        if (($segment1 === 'aktivitas' || $segment1 === 'activity') && $segment2 && $segment3) {
            $canonical = base_url("$this->lang/" . ($this->lang === 'id' ? 'aktivitas' : 'activity') . "/$segment2/$segment3");
        } elseif (($segment1 === 'artikel' || $segment1 === 'article') && $segment2 && $segment3) {
            $canonical = base_url("$this->lang/" . ($this->lang === 'id' ? 'artikel' : 'article') . "/$segment2/$segment3");
        }

        if (current_url() !== $canonical) {
            return redirect()->to($canonical);
        }
    }
}
