<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<!-- Page Title -->
<div class="page-title light-background">
    <div class="container">
        <h1><?= lang('bahasa.article'); ?></h1>
        <!-- <nav class="breadcrumbs">
            <ol>
                <li><a href="index.html">Home</a></li>
                <li class="current">Service Details</li>
            </ol>
        </nav> -->
    </div>
</div><!-- End Page Title -->

<!-- Service Details Section -->
<section id="service-details" class="service-details section features">

    <div class="container">
        <div class="d-flex justify-content-center">
            <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">
                <li class="nav-item">
                    <a class="nav-link <?= ($categoryId == null) ? 'active' : '' ?>"
                        href="<?= base_url($lang == 'id' ? 'id/artikel' : 'en/article') ?>">
                        <h4><?= $lang == 'id' ? 'Semua Artikel' : 'All Articles'; ?></h4>
                    </a>

                </li>
                <?php if (!empty($kategori)): ?>
                    <?php foreach ($kategori as $k): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($categoryId == $k['id_kategori_artikel']) ? 'active' : '' ?>"
                                href="<?= base_url($lang == 'id' && isset($k['slug_kategori']) ? 'id/artikel/' . $k['slug_kategori'] : 'en/article/' . $k['slug_kategori']) ?>">
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
            <div class="col-lg-8 ps-lg-5" data-aos="fade-up" data-aos-delay="200">
                <?php foreach ($allArticle as $article): ?>
                    <div class="service-box">
                        <img src="<?= base_url('assets/img/artikel/' . $article['foto_artikel']); ?>" alt="<?= $lang == 'id' ? $article['alt_artikel_id'] : $article['alt_artikel_en']; ?>" class="img-fluid services-img" style="border-radius: 2%;">
                        <h2><?= $lang == 'id' ? $article['judul_artikel_id'] : $article['judul_artikel_en']; ?></h2>
                        <p>2 Januari 2022</p>
                        <p>
                            <?= $lang == 'id' ? $article['snippet_id'] : $article['snippet_en']; ?>
                        </p>
                        <a href="<?= base_url(
                                        $lang === 'id'
                                            ? 'id/artikel/' . ($article['slug_kategori_id'] ?? 'kategori-tidak-ditemukan') . '/' . ($article['slug_artikel_id'] ?? 'artikel-tidak-ditemukan')
                                            : 'en/article/' . ($article['slug_kategori_en'] ?? 'category-not-found') . '/' . ($article['slug_artikel_en'] ?? 'article-not-found')
                                    ); ?>" class="read-more">
                            <?= lang('bahasa.buttonArticle'); ?> <i class="bi bi-arrow-right"></i>
                        </a>


                    </div>
                <?php endforeach; ?>
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