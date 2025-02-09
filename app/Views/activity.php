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
<section id="service-details" class="service-details section features">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="d-flex justify-content-center">
            <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">
                <!-- navbar kategori -->
                <li class="nav-item">
                    <a class="nav-link <?= ($categoryId == null) ? 'active' : '' ?>"
                        href="<?= base_url($lang == 'id' ? 'id/aktivitas' : 'en/activity') ?>">
                        <h4><?= $lang == 'id' ? 'Semua Artikel' : 'All Articles'; ?></h4>
                    </a>
                </li>
                <?php if (!empty($kategori)): ?>
                    <?php foreach ($kategori as $k): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($categoryId == $k['id_kategori_aktivitas']) ? 'active' : '' ?>"
                                href="<?= base_url($lang == 'id' && isset($k['slug_kategori']) ? 'id/aktivitas/' . $k['slug_kategori'] : 'en/activity/' . $k['slug_kategori']) ?>">
                                <h4><?= isset($k['nama_kategori']) ? $k['nama_kategori'] : 'No Name'; ?></h4>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="nav-item">No categories available</li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="row gy-5 mt-1">
            <?php foreach ($allAktivitas as $p) : ?>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card card border-info mb-3" style="box-shadow: 20px 20px 20px 20px rgba(38, 51, 61, 0.1);">
                        <img src="<?= base_url('assets/img/aktivitas/' . $p["foto_aktivitas"]) ?>" class="card-img-top" alt="<?= $lang == 'id' ? $p['alt_aktivitas_id'] : $p['alt_aktivitas_en']; ?>" style="height:300px">
                        <div class="card-body">
                            <h5 class="card-title"><?= $lang == 'id' ? $p['judul_aktivitas_id'] : $p['judul_aktivitas_en']; ?></h5>
                            <p class="card-text"><?= $lang == 'id'  ? substr($p['deskripsi_aktivitas_id'], 0, 250) : substr($p['deskripsi_aktivitas_en'], 0, 250); ?>... </p>
                            <p class="card-text"><small class="text-muted"></small></p>
                        </div>
                        <div class="text-end mb-3" style="margin-right: 20px;">
                            <a class="btn-getstarted" href="<?= base_url(
                                                                $lang === 'id'
                                                                    ? 'id/aktivitas/' . ($p['slug_kategori_id'] ?? 'kategori-tidak-ditemukan') . '/' . ($p['slug_aktivitas_id'] ?? 'aktivitas-tidak-ditemukan')
                                                                    : 'en/activity/' . ($p['slug_kategori_en'] ?? 'category-not-found') . '/' . ($p['slug_aktivitas_en'] ?? 'activity-not-found')
                                                            ); ?>"><?= lang('bahasa.button'); ?></a>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>