<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<style>
    .flex-container {
        display: flex;
        /* justify-content: center; */
        align-items: center;
        /* height: 100vh; */
    }

    .zoom-container {
        overflow: hidden;
    }

    .zoom-container img {
        transition: transform 0.3s;
    }

    .zoom-container img:hover {
        transform: scale(1.1);
    }

    .nav-tabs {
        margin-left: 20px;
        margin-right: 10px;
    }

    .tab-content {
        margin-top: 15px;
    }

    .description-content {
        font-size: 16px;
        line-height: 1.8;
        margin-left: 20px;
        margin-right: 10px;
    }

    .description-content b {
        font-weight: 600;
    }
</style>
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

<section>
    <div class="container my-2">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card border-info mb-3" style="box-shadow: 0 4px 20px rgba(38, 51, 61, 0.1);">

                    <div class="product-container mb-3 mt-5" style="text-align: justify; margin-left: 30px; margin-right: 30px;">
                        <h5 class="text-center mb-5" style="font-weight: bold; font-size: 1.5rem; color: #333; text-transform: uppercase; letter-spacing: 2px;">
                            <?= $lang == 'id' ? $product['nama_produk_id'] : $product['nama_produk_en']; ?>
                            <span style="display: block; width: 50px; height: 4px; background-color: blue; margin: 10px auto 0;"></span>
                        </h5>

                        <div style="margin: 0 auto;">
                            <p style="font-size: 1.1em;">
                                <img src="<?= base_url('assets/img/produk/' . $product["foto_produk"]) ?>"
                                    alt="<?= $lang == 'id' ? $product['alt_produk_id'] : $product['alt_produk_en']; ?>"
                                    style="float: left; margin-right: 15px; width: 100%; height: auto; max-width: 500px;">
                                <?= $lang == 'id' ? $product['deskripsi_produk_id'] : $product['deskripsi_produk_en']; ?>
                            </p>
                        </div>
                    </div>

                    <div style="clear: both;"></div>
                </div>
            </div>
        </div>
    </div>
</section>



<?= $this->endSection(); ?>