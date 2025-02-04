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
        <div class="row gy-5">
            <?php foreach ($product as $p) : ?>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card card border-info mb-3" style="box-shadow: 20px 20px 20px 20px rgba(38, 51, 61, 0.1);">
                        <img src="<?= base_url('assets/img/produk/' . $p["foto_produk"]) ?>" class="card-img-top" alt="<?= $lang == 'id' ? $p['alt_produk_id'] : $p['alt_produk_en']; ?>" style="height:300px">
                        <div class="card-body">
                            <h5 class="card-title"><?= $lang == 'id' ? $p['nama_produk_id'] : $p['nama_produk_en']; ?></h5>
                            <p class="card-text"><?= $lang == 'id'  ? substr($p['deskripsi_produk_id'], 0, 250) : substr($p['deskripsi_produk_en'], 0, 250); ?>... </p>
                            <p class="card-text"><small class="text-muted"></small></p>
                        </div>
                        <div class="text-end mb-3" style="margin-right: 20px;">
                            <a class="btn-getstarted" href="<?= base_url($lang . '/' . $productLink . '/' . $detailProduct . '/' . $p['slug_' . $lang]) ?>" ><?= lang('bahasa.button'); ?></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
</main>
<?= $this->endSection(); ?>