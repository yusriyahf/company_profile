<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<!-- Page Title -->
<div class="page-title light-background">
    <div class="container">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2><?= $lang == 'id' ? $meta['nama_halaman_id'] : $meta['nama_halaman_en']; ?></h2>
            <p><?= $lang == 'id' ? $meta['deskripsi_halaman_id'] : $meta['deskripsi_halaman_en']; ?></p>
        </div><!-- End Section Title -->
    </div>
</div><!-- End Page Title -->

<!-- Service Details Section -->
<section id="service-details" class="service-details section">

    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-8 ps-lg-5" data-aos="fade-up" data-aos-delay="200">
                <img src="<?= base_url('assets/img/aktivitas/' . $aktivitas['foto_aktivitas']); ?>" alt="<?= $lang == 'id' ? $aktivitas['alt_aktivitas_id'] : $aktivitas['alt_aktivitas_en']; ?>" class="img-fluid services-img">
                <h1><?= $lang == 'id' ? $aktivitas['judul_aktivitas_id'] : $aktivitas['judul_aktivitas_en']; ?></h1>
                <p><?= date('d F Y', strtotime($aktivitas['created_at'])); ?> - <?= $lang == 'id' ? $aktivitas['nama_kategori_id'] : $aktivitas['nama_kategori_en']; ?></p>
                <p>
                    <?= $lang == 'id' ? $aktivitas['deskripsi_aktivitas_id'] : $aktivitas['deskripsi_aktivitas_en']; ?>
                </p>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="service-box">
                    <h4><?= $lang == 'id' ? 'Aktivitas Lainnya' : 'Related Articles'; ?></h4>

                    <div class="services-list">
                        <?php foreach ($allAktivitas as $article): ?>
                            <a href="<?= base_url($lang == 'id'
                                            ? 'id/artikel/' . $article['slug_kategori_id'] . '/' . $article['slug_aktivitas_id']
                                            : 'en/article/' . $article['slug_kategori_en'] . '/' . $article['slug_aktivitas_en']); ?>" class="d-flex align-items-center mb-3">
                                <img src="<?= base_url('assets/img/aktivitas/' . $article['foto_aktivitas']); ?>" alt="<?= $lang == 'id' ? $article['alt_aktivitas_id'] : $article['alt_aktivitas_en']; ?>" class="img-fluid me-3" style="width: 100px; height: 80px; object-fit: cover; border-radius: 5%;">
                                <div>
                                    <span><?= $lang == 'id' ? $article['judul_aktivitas_id'] : $article['judul_aktivitas_en']; ?></span>
                                    <p style="font-size: 0.875rem; color: #6c757d; margin-top: 4px;"><?= date('d F Y', strtotime($article['created_at'])); ?></p> <!-- Tanggal Artikel -->
                                </div>
                            </a>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>


        </div>

    </div>

</section><!-- /Service Details Section -->
<?= $this->endSection(); ?>