<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<!-- Page Title -->
<div class="page-title light-background">
    <div class="container">
        <h1>Artikel</h1>
        <nav class="breadcrumbs">
            <ol>
                <li><a href="index.html">Home</a></li>
                <li class="current">Service Details</li>
            </ol>
        </nav>
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
                <?php foreach ($kategori as $k): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($categoryId == $k['id_kategori_artikel']) ? 'active' : '' ?>"
                            href="<?= base_url($lang == 'id' ? 'id/artikel/' . $k['slug_kategori_id'] : 'en/article/' . $k['slug_kategori_en']) ?>">
                            <h4><?= $lang == 'id' ? $k['nama_kategori_id'] : $k['nama_kategori_en']; ?></h4>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>


        <div class="row gy-5 mt-1">
            <div class="col-lg-8 ps-lg-5" data-aos="fade-up" data-aos-delay="200">
                <?php foreach ($allArticle as $article): ?>
                    <div class="service-box">
                        <img src="<?= base_url('assets/img/services.jpg'); ?>" alt="" class="img-fluid services-img" style="border-radius: 2%;">
                        <h2><?= $lang == 'id' ? $article['judul_artikel_id'] : $article['judul_artikel_en']; ?></h2>
                        <p>2 Januari 2022</p>
                        <p>
                            <?= $lang == 'id' ? $article['snippet_id'] : $article['snippet_en']; ?>
                        </p>
                        <a href="<?= base_url(
                                        $lang == 'id'
                                            ? 'id/artikel/' . ($article['slug_kategori_id'] ?? '') . '/' . ($article['slug_artikel_id'] ?? '')
                                            : 'en/article/' . ($article['slug_kategori_en'] ?? '') . '/' . ($article['slug_artikel_en'] ?? '')
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
                                <img src="<?= base_url('assets/img/services.jpg'); ?>" alt="Thumbnail" class="img-fluid me-3" style="width: 100px; height: 80px; object-fit: cover; border-radius: 5%;">
                                <div>
                                    <span><?= $lang == 'id' ? $article['judul_artikel_id'] : $article['judul_artikel_en']; ?></span>
                                    <p style="font-size: 0.875rem; color: #6c757d; margin-top: 4px;"><?= date('d F Y', strtotime($article['created_at'])); ?></p> <!-- Tanggal Artikel -->
                                </div>
                            </a>
                        <?php endforeach; ?>

                    </div>
                </div>
                <!-- <div class="service-box">
                    <h4>Services List</h4>
                    <div class="services-list">
                        <a href="#" class="active"><i class="bi bi-arrow-right-circle"></i><span>Web Design</span></a>
                        <a href="#"><i class="bi bi-arrow-right-circle"></i><span>Web Design</span></a>
                        <a href="#"><i class="bi bi-arrow-right-circle"></i><span>Product Management</span></a>
                        <a href="#"><i class="bi bi-arrow-right-circle"></i><span>Graphic Design</span></a>
                        <a href="#"><i class="bi bi-arrow-right-circle"></i><span>Marketing</span></a>
                    </div>
                </div> -->



                <!-- <div class="help-box d-flex flex-column justify-content-center align-items-center">
                    <i class="bi bi-headset help-icon"></i>
                    <h4>Have a Question?</h4>
                    <p class="d-flex align-items-center mt-2 mb-0"><i class="bi bi-telephone me-2"></i> <span>+1 5589 55488 55</span></p>
                    <p class="d-flex align-items-center mt-1 mb-0"><i class="bi bi-envelope me-2"></i> <a href="mailto:contact@example.com">contact@example.com</a></p>
                </div> -->

            </div>

        </div>

    </div>

</section><!-- /Service Details Section -->

<?= $this->endSection(); ?>