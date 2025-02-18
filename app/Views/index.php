<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
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
                <a href="<?= base_url($lang == 'id' ? 'id/tentang' : 'en/about') ?>" class="read-more">
                    <?= lang('bahasa.buttonArticle'); ?> <i class="bi bi-arrow-right"></i>
                </a>

            </div>

            <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
                <div class="image-wrapper">
                    <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
                        <img src="<?= base_url('assets/img/profil/' . $profil['foto_perusahaan']); ?>" alt="<?= $lang == 'id' ? $profil['alt_foto_perusahaan_id'] : $profil['alt_foto_perusahaan_en']; ?>" class="img-fluid main-image rounded-4">

                    </div>
                </div>
            </div>
        </div>

    </div>

</section><!-- /About Section -->




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

<!-- product section -->
<section id="product" class="product section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2><?= $lang == 'id' ? $aktivitasMeta['nama_halaman_id'] : $aktivitasMeta['nama_halaman_en']; ?></h2>
        <p><?= $lang == 'id' ? $aktivitasMeta['deskripsi_halaman_id'] : $aktivitasMeta['deskripsi_halaman_en']; ?></p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-5">
            <?php foreach ($aktivitas as $p) : ?>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <a href="<?= base_url($lang == 'id'
                                    ? 'id/aktivitas/'  . $p['slug_aktivitas_id']
                                    : 'en/activity/' . $p['slug_aktivitas_en']); ?>" class="text-decoration-none">
                        <div class="zoom-container card text-bg-primary mb-3" style="box-shadow: 20px 20px 20px 20px rgba(38, 51, 61, 0.1);">
                            <img src="<?= base_url('assets/img/aktivitas/' . $p["foto_aktivitas"]) ?>" class="card-img-top img-fluid zoom" alt="<?= $lang == 'id' ? $p['alt_aktivitas_id'] : $p['alt_aktivitas_en']; ?>" style="height:300px">
                            <div class="card-body">
                                <h5 class="card-title" style="color: whitesmoke;"><?= $lang == 'id' ? $p['judul_aktivitas_id'] : $p['judul_aktivitas_en']; ?></h5>
                            </div>
                        </div>
                    </a>
                </div>

            <?php endforeach; ?>
        </div>
</section>
<!-- end product section -->

<!-- Services Section -->
<section id="services" class="services section light-background">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2><?= $lang == 'id' ? $articleMeta['nama_halaman_id'] : $articleMeta['nama_halaman_en']; ?></h2>
        <p><?= $lang == 'id' ? $articleMeta['deskripsi_halaman_id'] : $articleMeta['deskripsi_halaman_en']; ?></p>
    </div><!-- End Section Title -->

    <section id="service-details" class="service-details section features">
        <div class="container">
            <div class="row gy-5">
                <!-- Artikel Utama -->
                <div class="col-lg-8 ps-lg-5" data-aos="fade-up" data-aos-delay="200">
                    <?php if (!empty($article)): ?>
                        <div class="service-box">
                            <a href="<?= base_url(
                                            $lang === 'id'
                                                ? 'id/artikel/' . ($article[0]['slug_kategori_id'] ?? 'kategori-tidak-ditemukan') . '/' . ($article[0]['slug_artikel_id'] ?? 'artikel-tidak-ditemukan')
                                                : 'en/article/' . ($article[0]['slug_kategori_en'] ?? 'category-not-found') . '/' . ($article[0]['slug_artikel_en'] ?? 'article-not-found')
                                        ); ?>" style="display: block; text-decoration: none; color: inherit;">
                                <?php if (isset($article[0]['foto_artikel'])): ?>
                                    <img src="<?= base_url('assets/img/artikel/' . $article[0]['foto_artikel']); ?>"
                                        alt="<?= $lang == 'id' ? $article[0]['alt_artikel_id'] : $article[0]['alt_artikel_en']; ?>"
                                        class="img-fluid services-img"
                                        style="border-radius: 2%;" loading="lazy">
                                <?php else: ?>
                                    <p>No image available</p>
                                <?php endif; ?>
                                <h2><?= $lang == 'id' ? $article[0]['judul_artikel_id'] : $article[0]['judul_artikel_en']; ?></h2>
                                <p><span class="badge text-bg-primary"><?= $lang == 'id' ? $article[0]['nama_kategori'] : $article[0]['nama_kategori']; ?></span> - <?= date('d F Y', strtotime($article[0]['created_at'])); ?></p>
                                <p>
                                    <?= $lang == 'id' ? $article[0]['snippet_id'] : $article[0]['snippet_en']; ?>
                                </p>
                                <a href="<?= base_url(
                                                $lang === 'id'
                                                    ? 'id/artikel/' . ($article['slug_kategori_id'] ?? 'kategori-tidak-ditemukan') . '/' . ($article['slug_artikel_id'] ?? 'artikel-tidak-ditemukan')
                                                    : 'en/article/' . ($article['slug_kategori_en'] ?? 'category-not-found') . '/' . ($article['slug_artikel_en'] ?? 'article-not-found')
                                            ); ?>" class="read-more">
                                    <?= lang('bahasa.buttonArticle'); ?> <i class="bi bi-arrow-right"></i>
                                </a>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Artikel Lainnya -->
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-box">
                        <h4><?= $lang == 'id' ? 'Artikel Lainnya' : 'Related Articles'; ?></h4>
                        <div class="services-list">
                            <?php if (!empty($sideArtikel)): ?>
                                <?php foreach ($sideArtikel as $article): ?>
                                    <a href="<?= base_url($lang == 'id'
                                                    ? 'id/artikel/' . $article['slug_kategori_id'] . '/' . $article['slug_artikel_id']
                                                    : 'en/article/' . $article['slug_kategori_en'] . '/' . $article['slug_artikel_en']); ?>" class="d-flex align-items-center mb-3">
                                        <img src="<?= base_url('assets/img/artikel/' . $article['foto_artikel']); ?>"
                                            alt="<?= $lang == 'id' ? $article['alt_artikel_id'] : $article['alt_artikel_en']; ?>"
                                            class="img-fluid me-3"
                                            style="width: 100px; height: 80px; object-fit: cover; border-radius: 5%;" loading="lazy">
                                        <div>
                                            <span><?= $lang == 'id' ? $article['judul_artikel_id'] : $article['judul_artikel_en']; ?></span>
                                            <p style="font-size: 0.875rem; color: #6c757d; margin-top: 4px;">
                                                <?= date('d F Y', strtotime($article['created_at'])); ?>
                                            </p>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Tidak ada artikel terkait.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</section><!-- /Services Section -->

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
                        class="w-100"
                        height="550"
                        border-radius="15px" ;
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