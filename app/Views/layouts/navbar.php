<?php
// Ambil bahasa yang disimpan di session
$lang = session()->get('lang') ?? 'id'; // Default ke 'id' jika tidak ada di session

$current_url = uri_string();

// Ambil query string (misalnya ?keyword=sukses)
$query_string = $_SERVER['QUERY_STRING'] ?? ''; // Pastikan tidak ada error jika query string kosong

// Simpan segmen bahasa saat ini
$segments = explode('/', $current_url);
$lang_segment = $segments[0] ?? ''; // Ambil segmen pertama dari URL

// Pastikan hanya 'en' atau 'id' yang dianggap sebagai segmen bahasa
if ($lang_segment !== 'en' && $lang_segment !== 'id') {
    $lang_segment = 'id'; // Default ke 'id' jika segmen bahasa tidak ada
}

// Definisikan tautan untuk setiap halaman berdasarkan bahasa
$homeLink    = ($lang_segment === 'en') ? '/' : '/';
$aboutLink   = ($lang_segment === 'en') ? 'about' : 'tentang';
$contactLink = ($lang_segment === 'en') ? 'contact' : 'kontak';
$articleLink = ($lang_segment === 'en') ? 'article' : 'artikel';
$activityLink = ($lang_segment === 'en') ? 'activity' : 'aktivitas';
$productLink = ($lang_segment === 'en') ? 'product' : 'produk';

// Ambil bagian dari URL tanpa segmen bahasa
array_shift($segments); // Hapus segmen bahasa dari array
$url_without_lang = implode('/', $segments); // Gabungkan kembali sisa URL

// Tentukan bahasa yang ingin digunakan
$new_lang = ($lang_segment === 'en') ? 'id' : 'en';

// Mapping penggantian segmen dalam URL berdasarkan bahasa yang aktif
$replace_map = [
    'tentang' => 'about',
    'kontak' => 'contact',
    'artikel' => 'article',
    'aktivitas' => 'activity',
    'produk' => 'product',
];

foreach ($replace_map as $id => $en) {
    if ($lang_segment === 'en') {
        // Jika bahasa saat ini 'en', ubah ke 'id'
        $url_without_lang = str_replace($en, $id, $url_without_lang);
    } else {
        // Jika bahasa saat ini 'id', ubah ke 'en'
        $url_without_lang = str_replace($id, $en, $url_without_lang);
    }
}

// Buat URL yang bersih
$clean_url = ($url_without_lang !== '') ? "$new_lang/$url_without_lang" : $new_lang;

// Gabungkan query string jika ada
if (!empty($query_string)) {
    $clean_url .= '?' . $query_string;
}

// Tautan Bahasa Inggris & Indonesia
$english_url = base_url($clean_url);
$indonesia_url = base_url($clean_url);

// Tautan Kategori Artikel untuk Navbar
$categoryLinks = [];
if (!empty($categories)) {
    foreach ($categories as $cat) {
        $slug = ($lang === 'id') ? $cat['slug_kategori_id'] : $cat['slug_kategori_en'];
        $name = ($lang === 'id') ? $cat['nama_kategori_id'] : $cat['nama_kategori_en'];
        $categoryLinks[] = [
            'url' => base_url("$lang/$articleLink/$slug"),
            'name' => $name
        ];
    }
}

// Tautan Kategori Aktivitas untuk Navbar
$kategoriAktivitasLinks = [];
if (!empty($categoriesAktivitas)) {
    foreach ($categoriesAktivitas as $cat) {
        $slug = ($lang === 'id') ? $cat['slug_kategori_id'] : $cat['slug_kategori_en'];
        $name = ($lang === 'id') ? $cat['nama_kategori_id'] : $cat['nama_kategori_en'];
        $kategoriAktivitasLinks[] = [
            'url' => base_url("$lang/$activityLink/$slug"),
            'name' => $name
        ];
    }
}
?>


<nav id="navmenu" class="navmenu">
    <ul>
        <li>
            <a href="<?= base_url($lang . '/') ?>"
                class="<?= isset($data['activeMenu']) && $data['activeMenu'] === 'home' ? 'active' : '' ?>">
                <?= lang('bahasa.home'); ?>
            </a>
        </li>
        <li><a href="<?= base_url($lang . '/' . $aboutLink) ?>" class="<?= isset($data['activeMenu']) && $data['activeMenu'] === 'about' ? 'active' : '' ?>"><?= lang('bahasa.about'); ?></a></li>
        <!-- Article Dropdown -->
        <li><a href="<?= base_url($lang . '/' . $productLink) ?>" class="<?= isset($activeMenu) && $activeMenu === 'product' ? 'active' : '' ?>"><?= lang('bahasa.product'); ?></a></li>


        <!-- Aktivitas Dropdown -->
        <li class="dropdown">
            <a href="#" class="<?= isset($data['activeMenu']) && $data['activeMenu'] === 'activity' ? 'active' : '' ?>"><?= lang('bahasa.activity'); ?> <i class="bi bi-chevron-down toggle-dropdown "></i></a>
            <ul>
                <li><a class="dropdown-item" href="<?= base_url($lang . '/' . $activityLink) ?>"><?= $lang == 'id' ? 'Semua Aktivitas' : 'All Activity'; ?></a></li>
                <?php if (!empty($kategoriAktivitasLinks)): ?>
                    <?php foreach ($kategoriAktivitasLinks as $categoriAktivitasLink): ?>
                        <li>
                            <a class="dropdown-item" href="<?= $categoriAktivitasLink['url']; ?>">
                                <?= $categoriAktivitasLink['name']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li><a class="dropdown-item"><?= $lang == 'id' ? 'Tidak ada kategori' : 'No Categories available'; ?></a></li>
                <?php endif; ?>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="<?= isset($data['activeMenu']) && $data['activeMenu'] === 'article' ? 'active' : '' ?>"><?= lang('bahasa.article'); ?> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
                <li><a class="dropdown-item" href="<?= base_url($lang . '/' . $articleLink) ?>"><?= $lang == 'id' ? 'Semua Artikel' : 'All Articles'; ?></a></li>
                <?php if (!empty($categoryLinks)): ?>
                    <?php foreach ($categoryLinks as $categoryLink): ?>
                        <li>
                            <a class="dropdown-item" href="<?= $categoryLink['url']; ?>">
                                <?= $categoryLink['name']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li><a class="dropdown-item"><?= $lang == 'id' ? 'Tidak ada kategori' : 'No Categories available'; ?></a></li>
                <?php endif; ?>
            </ul>
        </li>

        <!-- Aktivitas Dropdown -->

        <li><a href="<?= base_url('/' . $lang . '/' . $contactLink); ?>" class="<?= isset($data['activeMenu']) && $data['activeMenu'] === 'contact' ? 'active' : '' ?>"><?= lang('bahasa.contact'); ?></a></li>

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