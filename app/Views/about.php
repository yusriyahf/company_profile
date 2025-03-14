<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<!-- Page Title -->
<div class="page-title light-background">
    <div class="container">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2><?= $lang == 'id' ? $meta['nama_halaman_id'] : $meta['nama_halaman_en']; ?></h2>
            <h1><?= $lang == 'id' ? $meta['deskripsi_halaman_id'] : $meta['deskripsi_halaman_en']; ?></h1>
        </div><!-- End Section Title -->
    </div>
</div><!-- End Page Title -->

<section id="about" class="about section mt-5">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 align-items-center justify-content-between">

            <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
                <span class="about-meta"><?= lang('bahasa.titleAbout'); ?></span>
                <h2 class="about-title"><?= lang('bahasa.headerAbout'); ?></h2>
                <p class="about-description"><?= $lang == 'id' ? $profil['deskripsi_perusahaan_id'] : $profil['deskripsi_perusahaan_en']; ?></p>
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

<?= $this->endSection(); ?>