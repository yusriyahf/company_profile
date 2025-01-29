<?php
// Ambil bahasa yang disimpan di session
$lang = session()->get('lang') ?? 'id'; // Default ke 'en' jika tidak ada di session

$current_url = uri_string();

// Ambil query string (misalnya ?keyword=sukses)
$query_string = $_SERVER['QUERY_STRING']; // Mengambil query string dari URL

// Simpan segmen bahasa saat ini
$lang_segment = substr($current_url, 0, strpos($current_url, '/') + 1); // Menyimpan 'id/' atau 'en/'

// Definisikan tautan untuk setiap halaman berdasarkan bahasa
$homeLink = ($lang_segment === 'en/') ? '/' : '/';
$aboutLink = ($lang_segment === 'en/') ? 'about' : 'tentang';
$contactLink = ($lang_segment === 'en/') ? 'contact' : 'kontak';
$articleLink = ($lang_segment === 'en/') ? 'article' : 'artikel';
$productLink = ($lang_segment === 'en/') ? 'product' : 'produk';
$detailProduct = ($lang_segment === 'en/') ? 'product-detail' : 'produk-detail';

// Buat array untuk menggantikan segmen berdasarkan bahasa
$replace_map = [
    'kontak' => 'contact',
    'tentang' => 'about',
    'artikel' => 'article',
    'produk' => 'product',
    'produk-detail' => 'product-detail',
];

// Ambil bagian dari URL tanpa segmen bahasa
$url_without_lang = substr($current_url, strlen($lang_segment));

// Tentukan bahasa yang ingin digunakan
$new_lang_segment = ($lang_segment === 'en/') ? 'id/' : 'en/';

// Gantikan setiap segmen dalam URL berdasarkan bahasa yang aktif
foreach ($replace_map as $indonesian_segment => $english_segment) {
    if ($lang_segment === 'en/') {
        // Jika bahasa yang dipilih adalah 'en', maka ganti segmen ID ke EN
        $url_without_lang = str_replace($english_segment, $indonesian_segment, $url_without_lang);
    } else {
        // Jika bahasa yang dipilih adalah 'id', maka ganti segmen EN ke ID
        $url_without_lang = str_replace($indonesian_segment, $english_segment, $url_without_lang);
    }
}

// Tautan dengan bahasa yang baru
$clean_url = $new_lang_segment . ltrim($url_without_lang, '/');

// Gabungkan query string jika ada
if (!empty($query_string)) {
    $clean_url .= '?' . $query_string;
}


// Tautan Bahasa Inggris
$english_url = base_url($clean_url);

// Tautan Bahasa Indonesia
$indonesia_url = base_url($clean_url);
?>

<nav id="navmenu" class="navmenu">
    <ul>

        <li>
            <a href="<?= base_url($lang . '/' . $homeLink) ?>"
                class="<?= isset($data['activeMenu']) && $data['activeMenu'] === 'home' ? 'active' : '' ?>">
                <?= lang('bahasa.home'); ?>
            </a>
        </li>
        <li><a href="<?= base_url($lang . '/' . $aboutLink) ?>" class="<?= isset($data['activeMenu']) && $data['activeMenu'] === 'about' ? 'active' : '' ?>"><?= lang('bahasa.about'); ?></a></li>
        <li><a href="<?= base_url($lang . '/' . $articleLink) ?>" class="<?= isset($data['activeMenu']) && $data['activeMenu'] === 'article' ? 'active' : '' ?>"><?= lang('bahasa.article'); ?></a></li>
        <li><a href="<?= base_url($lang . '/' . $productLink) ?>" class="<?= isset($activeMenu) && $activeMenu === 'product' ? 'active' : '' ?>">
                <?= lang('bahasa.product'); ?></a></li>
        <li><a href="<?= base_url($lang . '/' . $contactLink) ?>" class="<?= isset($data['activeMenu']) && $data['activeMenu'] === 'contact' ? 'active' : '' ?>"><?= lang('bahasa.contact'); ?></a></li>

        <li class="dropdown">
            <a href="#"><span>
                    <?php
                    // Menentukan bahasa yang aktif
                    echo ($lang === 'en') ? 'English' : 'Indonesia';
                    ?>
                </span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
                <li>
                    <a href="<?= $indonesia_url; ?>" <?= $lang === 'id' ? 'class="active disabled"' : ''; ?>><img src="<?= base_url('assets/flags/indonesia.jpeg') ?>" alt="EN Flag" class="flag-icon me-1" style="width: 20px;">Indonesia</a>
                </li>
                <li>
                    <a href="<?= $english_url; ?>" <?= $lang === 'en' ? 'class="active disabled"' : ''; ?>><img src="<?= base_url('assets/flags/english.jpeg') ?>" alt="EN Flag" class="flag-icon me-1" style="width: 20px;">English</a>
                </li>
            </ul>
        </li>
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>