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
        <h1>Produk Detail</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="index.html">Home</a></li>
                <li class="current">Produk Detail</li>
            </ol>
        </nav>
    </div>
</div><!-- End Page Title -->

<section>
    <div class="container my-2">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card border-info mb-3" style="box-shadow: 0 4px 20px rgba(38, 51, 61, 0.1);">

                    <div class="row g-0 mb-3 mt-5"> <!-- Menggunakan row untuk layout gambar dan deskripsi -->
                        <h5 class="text-center mb-5" style="font-weight: bold; font-size: 1.5rem; color: #333; text-transform: uppercase; letter-spacing: 2px; position: relative;">
                            <?= $lang == 'id' ? $product['nama_produk_id'] : $product['nama_produk_en']; ?>
                            <span style="display: block; width: 50px; height: 4px; background-color: blue; margin: 10px auto 0;"></span>
                        </h5>
                        <div class="col-md-6">
                            <div class="zoom-container" style="box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5); border-radius: 20px; overflow: hidden; margin-left: 20px;">
                                <img src="<?= base_url('assets/img/produk/' . $product["foto_produk"]) ?>"
                                    class="img-fluid zoom"
                                    alt="<?= $lang == 'id' ? $product['alt_produk_id'] : $product['alt_produk_en']; ?>"
                                    style="width: 100%; height: auto; max-width: 650px;">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="container">
                                <ul class="nav nav-tabs nav-pills flex-column flex-sm-row" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">
                                            <?= ($lang === 'en') ? 'Description' : 'Deskripsi' ?>
                                        </button>
                                    </li>
                                </ul>

                                <div class="tab-content mt-3" id="myTabContent">
                                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                        <div class="description-content">
                                            <h5 class="card-title" style="font-weight: bold;">
                                                <?= $lang == 'id' ? $product['nama_produk_id'] : $product['nama_produk_en']; ?>
                                            </h5>
                                            <p class="card-text" style="font-size: 1.1em;">
                                                <?= $lang == 'id' ? $product['deskripsi_produk_id'] : $product['deskripsi_produk_en']; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<?= $this->endSection(); ?>