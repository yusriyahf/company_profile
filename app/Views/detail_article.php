<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<!-- Page Title -->
<div class="page-title light-background">
    <div class="container">
        <h1>Detail <?= lang('bahasa.article'); ?></h1>
        <!-- <nav class="breadcrumbs">
            <ol>
                <li><a href="index.html">Home</a></li>
                <li class="current">Service Details</li>
            </ol>
        </nav> -->
    </div>
</div><!-- End Page Title -->

<!-- Service Details Section -->
<section id="service-details" class="service-details section">

    <div class="container">

        <div class="row gy-5">



            <div class="col-lg-8 ps-lg-5" data-aos="fade-up" data-aos-delay="200">
                <img src="<?= base_url('assets/img/artikel/' . $artikel['foto_artikel']); ?>" alt="<?= $lang == 'id' ? $artikel['alt_artikel_id'] : $artikel['alt_artikel_en']; ?>" class="img-fluid services-img">
                <h1><?= $lang == 'id' ? $artikel['judul_artikel_id'] : $artikel['judul_artikel_en']; ?></h1>
                <p>
                    <?= $lang == 'id' ? $artikel['deskripsi_artikel_id'] : $artikel['deskripsi_artikel_en']; ?>
                </p>

            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="service-box">
                    <h4><?= $lang == 'id' ? 'Artikel Lainnya' : 'Related Articles'; ?></h4>

                    <div class="services-list">
                        <?php foreach ($allArticle as $article): ?>
                            <a href="<?= base_url($lang == 'id'
                                            ? 'id/artikel/' . $article['slug_kategori_id'] . '/' . $article['slug_artikel_id']
                                            : 'en/article/' . $article['slug_kategori_en'] . '/' . $article['slug_artikel_en']); ?>" class="d-flex align-items-center mb-3">
                                <img src="<?= base_url('assets/img/artikel/' . $article['foto_artikel']); ?>" alt="<?= $lang == 'id' ? $article['alt_artikel_id'] : $article['alt_artikel_en']; ?>" class="img-fluid me-3" style="width: 100px; height: 80px; object-fit: cover; border-radius: 5%;">
                                <div>
                                    <span><?= $lang == 'id' ? $article['judul_artikel_id'] : $article['judul_artikel_en']; ?></span>
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