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
<section id="contact" class="contact section features">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-4 g-lg-5">
            <div class="col-lg-5">
                <div class="info-box" data-aos="fade-up" data-aos-delay="200">
                <?= $lang == 'id' ? $kontak['deskripsi_kontak_id'] : $kontak['deskripsi_kontak_en']; ?>
                </div>
            </div>

            <div class="col-lg-7">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.2410172253694!2d112.66325561145756!3d-7.974024292017904!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd6298db1e5b70b%3A0xaf3552a89f1cc9f0!2sELECOMP%20INDONESIA!5e0!3m2!1sen!2sid!4v1738309308019!5m2!1sen!2sid" 
                width="600" 
                height="550" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            </div>

</section><!-- /Contact Section -->

<?= $this->endSection(); ?>