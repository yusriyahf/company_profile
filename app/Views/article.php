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
    <div class="container">
        <!--  -->


        <div class="row gy-5">

            <div class="col-lg-8 ps-lg-5" data-aos="fade-up" data-aos-delay="200">
                <?php foreach ($allArticle as $article): ?>
                    <div class="service-box">
                        <a href="<?= base_url(
                                        $lang === 'id'
                                            ? 'id/artikel/' . ($article['slug_kategori_id'] ?? 'kategori-tidak-ditemukan') . '/' . ($article['slug_artikel_id'] ?? 'artikel-tidak-ditemukan')
                                            : 'en/article/' . ($article['slug_kategori_en'] ?? 'category-not-found') . '/' . ($article['slug_artikel_en'] ?? 'article-not-found')
                                    ); ?>" style="display: block; text-decoration: none; color: inherit;">
                            <img src="<?= base_url('assets/img/artikel/' . $article['foto_artikel']); ?>" alt="<?= $lang == 'id' ? $article['alt_artikel_id'] : $article['alt_artikel_en']; ?>" class="img-fluid services-img" style="border-radius: 2%;" loading="lazy">
                            <h2><?= $lang == 'id' ? $article['judul_artikel_id'] : $article['judul_artikel_en']; ?></h2>
                            <p><span class="badge text-bg-primary"><?= $lang == 'id' ? $article['nama_kategori'] : $article['nama_kategori']; ?></span> - <?= date('d F Y', strtotime($article['created_at'])); ?></p>
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
                        </a>
                    </div>
                <?php endforeach; ?>
                <!-- Pagination -->
                <!-- Pagination dengan Bootstrap -->
                <div class="d-flex justify-content-center mt-4">
                    <?= $pager->links('default', 'bootstrap_pagination') ?>
                </div>


            </div>


            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="service-box">
                    <h4><?= $lang == 'id' ? 'Artikel Lainnya' : 'Related Articles'; ?></h4>
                    <div class="services-list">
                        <?php foreach ($sideArticle as $article): ?>
                            <a href="<?= base_url($lang == 'id'
                                            ? 'id/artikel/' . $article['slug_kategori_id'] . '/' . $article['slug_artikel_id']
                                            : 'en/article/' . $article['slug_kategori_en'] . '/' . $article['slug_artikel_en']); ?>" class="d-flex align-items-center mb-3">
                                <img src="<?= base_url('assets/img/artikel/' . $article['foto_artikel']); ?>" alt="<?= $lang == 'id' ? $article['alt_artikel_id'] : $article['alt_artikel_en']; ?>" class="img-fluid me-3" style="width: 100px; height: 80px; object-fit: cover; border-radius: 5%;" loading="lazy">
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