<!DOCTYPE html>
<html lang="<?= session()->get('lang') ?? 'id'; ?>">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= isset($meta) ? ($lang == 'id' ? $meta['title_id'] : $meta['title_en']) : ($lang == 'id' ? $artikel['title_artikel_id'] : $artikel['title_artikel_en']); ?></title>
    <meta name="description" content="<?= isset($meta) ? ($lang == 'id' ? $meta['meta_desc_id'] : $meta['meta_desc_en']) : ($lang == 'id' ? $artikel['meta_desc_id'] : $artikel['meta_desc_en']); ?>">

    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="<?= base_url('assets/img/CreativeNest.png'); ?>" rel="icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/aos/aos.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/glightbox/css/glightbox.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/swiper/swiper-bundle.min.css'); ?>" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?= base_url('assets/css/main.css'); ?>" rel="stylesheet">

    <!-- =======================================================
  * Template Name: iLanding
  * Template URL: https://bootstrapmade.com/ilanding-bootstrap-landing-page-template/
  * Updated: Nov 12 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">
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

    // Buat array untuk menggantikan segmen berdasarkan bahasa
    $replace_map = [
        'kontak' => 'contact',
        'tentang' => 'about',
        'artikel' => 'article',
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

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="<?= base_url($lang . '/' . $homeLink) ?>" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 class="sitename">Creativenest</h1>
            </a>

            <?= $this->include('layouts/navbar'); ?>

            <a class="btn-getstarted" href="<?= base_url($lang . '/' . $contactLink) ?>"><?= lang('bahasa.buttonSlider'); ?></a>

        </div>
    </header>

    <main class="main">

        <?= $this->renderSection('content'); ?>

    </main>

    <?= $this->include('layouts/footer'); ?>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/php-email-form/validate.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/aos/aos.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/glightbox/js/glightbox.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/swiper/swiper-bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/purecounter/purecounter_vanilla.js'); ?>"></script>

    <!-- Main JS File -->
    <script src="<?= base_url('assets/js/main.js'); ?>"></script>

</body>

</html>