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

<!-- Service Details Section -->
<section id="service-details" class="service-details section features">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <?php
        // Urutkan produk berdasarkan 'updated_at' dari yang terbaru ke yang lama
        usort($product, function ($a, $b) {
            return strtotime($b['updated_at']) - strtotime($a['updated_at']);
        });
        ?>

        <div class="row gy-5">
            <?php foreach ($product as $p) : ?>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <a href="<?= base_url($lang == 'id'
                                    ? 'id/produk/produk-detail/'  . $p['slug_id']
                                    : 'en/product/product-detail/' . $p['slug_en']); ?>"
                        class="text-decoration-none" style="color: black;">
                        <div class="card border-info mb-3" style="box-shadow: 20px 20px 20px 20px rgba(38, 51, 61, 0.1);">
                            <img src="<?= base_url('assets/img/produk/' . $p["foto_produk"]) ?>" class="card-img-top"
                                alt="<?= $lang == 'id' ? $p['alt_produk_id'] : $p['alt_produk_en']; ?>" style="height:300px">
                            <div class="card-body">
                                <h5 class="card-title" style="font-weight: bold; color: black;">
                                    <?= $lang == 'id' ? $p['nama_produk_id'] : $p['nama_produk_en']; ?>
                                </h5>
                                <p class="card-text"><small class="text-muted">
                                        <?= lang('bahasa.updated'); ?> <?= date('d M Y', strtotime($p['updated_at'])); ?>
                                    </small></p>
                                <p class="card-text" style="color: black;">
                                    <?= $lang == 'id' ? substr($p['deskripsi_produk_id'], 0, 250) : substr($p['deskripsi_produk_en'], 0, 250); ?>...
                                </p>
                            </div>
                            <div class="text-end mb-3" style="margin-right: 20px;">
                                <a href="<?= base_url($lang . '/' . $productLink . '/' . $detailProduct . '/' . $p['slug_' . $lang]) ?>">
                                    <?= lang('bahasa.buttonArticle'); ?> <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

</section>
</main>
<?= $this->endSection(); ?>