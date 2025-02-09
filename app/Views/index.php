<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

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
<style>
    .zoom-container {
        overflow: hidden;
    }

    .zoom-container img {
        transition: transform 0.3s;
    }

    .zoom-container img:hover {
        transform: scale(1.1);
    }
</style>

<section id="hero" class="hero section dark-background">

    <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

        <?php $isActive = 'active'; ?>
        <?php if ($slider): ?>
            <?php foreach (['foto_slider1', 'foto_slider2', 'foto_slider3'] as $foto): ?>
                <?php if (!empty($slider[$foto])): ?>
                    <div class="carousel-item <?= $isActive; ?>">
                        <img src="<?= base_url('assets/img/slider/' . $slider[$foto]) ?>" class="d-block w-100" alt="<?= $foto ?>">
                        <div class="carousel-container">
                            <h1 style="text-align: center; font-weight: bold; ">
                                <?= $lang == 'id' ? $slider['caption_slider_id'] : $slider['caption_slider_en']; ?>
                            </h1>
                        </div>
                    </div>
                    <?php $isActive = ''; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>
        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>
        <ol class="carousel-indicators"></ol>

    </div>

</section>


<!-- About Section -->
<section id="about" class="about section">
    <div class="container section-title" data-aos="fade-up">
        <h2><?= $lang == 'id' ? $aboutMeta['nama_halaman_id'] : $aboutMeta['nama_halaman_en']; ?></h2>
        <p><?= $lang == 'id' ? $aboutMeta['deskripsi_halaman_id'] : $aboutMeta['deskripsi_halaman_en']; ?></p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 align-items-center justify-content-between">

            <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
                <h2 class="about-title"><?= $profil['nama_perusahaan']; ?></h2>
                <p class="about-description"><?= $lang == 'id' ? $profil['deskripsi_perusahaan_id'] : $profil['deskripsi_perusahaan_en']; ?></p>

            </div>

            <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
                <div class="image-wrapper">
                    <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
                        <img src="<?= base_url('assets/img/profil/' . $profil['foto_perusahaan']); ?>" alt="<?= $lang == 'id' ? $profil['alt_foto_perusahaan_id'] : $profil['alt_foto_perusahaan_en']; ?>" class="img-fluid main-image rounded-4">
                        <img src="<?= base_url('assets/img/profil/' . $profil['logo_perusahaan']); ?>" alt="<?= $lang == 'id' ? $profil['alt_logo_perusahaan_id'] : $profil['alt_logo_perusahaan_en']; ?>" class="img-fluid small-image rounded-4">
                    </div>
                </div>
            </div>
        </div>

    </div>

</section><!-- /About Section -->


<!-- Services Section -->
<section id="services" class="services section light-background">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2><?= $lang == 'id' ? $articleMeta['nama_halaman_id'] : $articleMeta['nama_halaman_en']; ?></h2>
        <p><?= $lang == 'id' ? $articleMeta['deskripsi_halaman_id'] : $articleMeta['deskripsi_halaman_en']; ?></p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4">

            <?php foreach ($artikel as $a): ?>
                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-card d-flex flex-column flex-md-row align-items-center">
                        <!-- Gambar di atas untuk tampilan mobile -->
                        <div class="flex-shrink-0 mb-3 mb-md-0 me-md-3 images position-relative">
                            <img src="<?= base_url('assets/img/artikel/' . $a['foto_artikel']); ?>"
                                alt="<?= $lang == 'id' ? $a['alt_artikel_id'] : $a['alt_artikel_en']; ?>"
                                class="img-fluid"
                                style="width: 100%; max-width: 160px; height: 160px; object-fit: cover; border-radius: 10%;">
                        </div>
                        <div class="text-start">
                            <h3><?= $lang == 'id' ? $a['judul_artikel_id'] : $a['judul_artikel_en']; ?></h3>
                            <p>
                                <?= $lang == 'id' ? substr($a['snippet_id'], 0, 100) : substr($a['snippet_en'], 0, 100); ?>
                                <?= strlen($lang == 'id' ? $a['snippet_id'] : $a['snippet_en']) > 100 ? '...' : ''; ?>
                            </p>
                            <a href="<?= base_url($lang == 'id'
                                            ? 'id/artikel/' . $a['slug_kategori_id'] . '/' . $a['slug_artikel_id']
                                            : 'en/article/' . $a['slug_kategori_en'] . '/' . $a['slug_artikel_en']); ?>" class="read-more">
                                <?= lang('bahasa.buttonArticle'); ?> <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div><!-- End Service Card -->
            <?php endforeach; ?>


        </div>

    </div>

</section><!-- /Services Section -->

<!-- product section -->
<section id="product" class="product section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2><?= $lang == 'id' ? $productMeta['nama_halaman_id'] : $productMeta['nama_halaman_en']; ?></h2>
        <p><?= $lang == 'id' ? $productMeta['deskripsi_halaman_id'] : $productMeta['deskripsi_halaman_en']; ?></p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-5">
            <?php foreach ($product as $p) : ?>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <a href="<?= base_url($lang == 'id'
                                    ? 'id/produk/produk-detail/'  . $p['slug_id']
                                    : 'en/product/product-detail/' . $p['slug_en']); ?>" class="text-decoration-none">
                        <div class="zoom-container card text-bg-primary mb-3" style="box-shadow: 20px 20px 20px 20px rgba(38, 51, 61, 0.1);">
                            <img src="<?= base_url('assets/img/produk/' . $p["foto_produk"]) ?>" class="card-img-top img-fluid zoom" alt="<?= $lang == 'id' ? $p['alt_produk_id'] : $p['alt_produk_en']; ?>" style="height:300px">
                            <div class="card-body">
                                <h5 class="card-title" style="color: whitesmoke;"><?= $lang == 'id' ? $p['nama_produk_id'] : $p['nama_produk_en']; ?></h5>
                            </div>
                        </div>
                    </a>
                </div>

            <?php endforeach; ?>
        </div>
</section>
<!-- end product section -->

<!-- Contact Section -->
<section id="contact" class="contact section light-background">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2><?= $lang == 'id' ? $contactMeta['nama_halaman_id'] : $contactMeta['nama_halaman_en']; ?></h2>
        <p><?= $lang == 'id' ? $contactMeta['deskripsi_halaman_id'] : $contactMeta['deskripsi_halaman_en']; ?></p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4 g-lg-5">
            <div class="col-lg-5">
                <div class="info-box" data-aos="fade-up" data-aos-delay="200">
                    <?= $lang == 'id' ? $kontak['deskripsi_kontak_id'] : $kontak['deskripsi_kontak_en']; ?>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="contact-map" data-aos="fade-up" data-aos-delay="300">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.2410172253694!2d112.66325561145756!3d-7.974024292017904!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6298db1e5b70b%3A0xaf3552a89f1cc9f0!2sELECOMP%20INDONESIA!5e0!3m2!1sen!2sid!4v1738309308019!5m2!1sen!2sid"
                        width="600"
                        height="550"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>

</section><!-- /Contact Section -->

<?= $this->endSection(); ?>