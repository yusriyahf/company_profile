<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>
<style>
    .zoom-container {
        overflow: hidden;
    }

    .zoom-container img {
        transition: transform 0.3s;
    }

    .zoom-container img:hover {
        transform: scale(1.1);
    }
</style>

<section id="hero" class="hero section dark-background">

    <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

        <div class="carousel-item active">
            <img src="<?= base_url('assets/img/hero-carousel/' . $slider['foto_slider1']); ?>" alt="">

            <div class="carousel-container">
                <h2><?= lang('bahasa.headerSlider'); ?><br></h2>
                <p><?= $lang == 'id' ? $slider['caption_slider_id'] : $slider['caption_slider_en']; ?></p>
                <a href="/contact" class="btn-get-started"><?= lang('bahasa.buttonSlider'); ?></a>
            </div>
        </div><!-- End Carousel Item -->

        <div class="carousel-item">
            <img src="<?= base_url('assets/img/hero-carousel/' . $slider['foto_slider2']); ?>" alt="">

            <div class="carousel-container">
                <h2><?= lang('bahasa.headerSlider'); ?></h2>
                <p><?= $lang == 'id' ? $slider['caption_slider_id'] : $slider['caption_slider_en']; ?></p>
                <a href="/contact" class="btn-get-started"><?= lang('bahasa.buttonSlider'); ?></a>
            </div>
        </div><!-- End Carousel Item -->

        <div class="carousel-item">
            <img src="<?= base_url('assets/img/hero-carousel/' . $slider['foto_slider3']); ?>" alt="">

            <div class="carousel-container">
                <h2><?= lang('bahasa.headerSlider'); ?></h2>
                <p><?= $lang == 'id' ? $slider['caption_slider_id'] : $slider['caption_slider_en']; ?></p>
                <a href="/contact" class="btn-get-started"><?= lang('bahasa.buttonSlider'); ?></a>
            </div>
        </div><!-- End Carousel Item -->

        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

        <ol class="carousel-indicators"></ol>

    </div>

</section>


<!-- About Section -->
<section id="about" class="about section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 align-items-center justify-content-between">

            <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
                <span class="about-meta"><?= lang('bahasa.titleAbout'); ?></span>
                <h2 class="about-title"><?= lang('bahasa.headerAbout'); ?></h2>
                <p class="about-description"><?= $lang == 'id' ? $profil['deskripsi_perusahaan_id'] : $profil['deskripsi_perusahaan_en']; ?></p>

                <div class="row feature-list-wrapper">
                    <div class="col-md-6">
                        <ul class="feature-list">
                            <li><i class="bi bi-check-circle-fill"></i><?= lang('bahasa.poin1'); ?></li>
                            <li><i class="bi bi-check-circle-fill"></i> <?= lang('bahasa.poin2'); ?></li>
                            <li><i class="bi bi-check-circle-fill"></i><?= lang('bahasa.poin3'); ?></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="feature-list">
                            <li><i class="bi bi-check-circle-fill"></i><?= lang('bahasa.poin4'); ?></li>
                            <li><i class="bi bi-check-circle-fill"></i><?= lang('bahasa.poin5'); ?></li>
                            <li><i class="bi bi-check-circle-fill"></i><?= lang('bahasa.poin5'); ?></li>
                        </ul>
                    </div>
                </div>

                <div class="info-wrapper">
                    <div class="row gy-4">
                        <div class="col-lg-5">
                            <div class="profile d-flex align-items-center gap-3">
                                <img src="<?= base_url('assets/img/avatar-1.webp'); ?>" alt="CEO Profile" class="profile-image">
                                <div>
                                    <h4 class="profile-name">Yusriyah F</h4>
                                    <p class="profile-position">CEO &amp; Founder</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="contact-info d-flex align-items-center gap-2">
                                <i class="bi bi-telephone-fill"></i>
                                <div>
                                    <p class="contact-label"><?= lang('bahasa.call'); ?></p>
                                    <p class="contact-number">+123 456-789</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
                <div class="image-wrapper">
                    <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
                        <img src="<?= base_url('assets/img/about-5.webp'); ?>" alt="Business Meeting" class="img-fluid main-image rounded-4">
                        <img src="<?= base_url('assets/img/about-2.webp'); ?>" alt="Team Discussion" class="img-fluid small-image rounded-4">
                    </div>
                    <div class="experience-badge floating">
                        <h3>15+ <span><?= lang('bahasa.year'); ?></span></h3>
                        <p><?= lang('bahasa.desc'); ?></p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section><!-- /About Section -->

<!-- product section -->
<section id="product" class="product section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2><?= lang('bahasa.headerProduk'); ?></h2>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-5">
            <?php foreach ($product as $p) : ?>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="zoom-container card text-bg-primary mb-3" style="box-shadow: 20px 20px 20px 20px rgba(38, 51, 61, 0.1);">
                        <img src="<?= base_url('assets/img/produk/' . $p["foto_produk"]) ?>" class="card-img-top img-fluid zoom" alt="<?= $lang == 'id' ? $p['alt_produk_id'] : $p['alt_produk_en']; ?>" style="height:300px">
                        <div class="card-body">
                            <h5 class="card-title" style="color: whitesmoke;"><?= $lang == 'id' ? $p['nama_produk_id'] : $p['nama_produk_en']; ?></h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
</section>
<!-- end product section -->


<!-- Contact Section -->
<section id="contact" class="contact section light-background">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2><?= lang('bahasa.headerKontak'); ?></h2>
        <p><?= $lang == 'id' ? $kontak['deskripsi_kontak_id'] : $kontak['deskripsi_kontak_en']; ?></p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4 g-lg-5">
            <div class="col-lg-5">
                <div class="info-box" data-aos="fade-up" data-aos-delay="200">
                    <h3><?= lang('bahasa.headerKontak'); ?></h3>
                    <p><?= lang('bahasa.deskripsiKontak'); ?></p>

                    <div class="info-item" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon-box">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div class="content">
                            <h4><?= lang('bahasa.location'); ?></h4>
                            <p>Jl. CreativeNest No. 21</p>
                            <p>Malang, 12345</p>
                        </div>
                    </div>

                    <div class="info-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="icon-box">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div class="content">
                            <h4><?= lang('bahasa.nomor'); ?></h4>
                            <p>+1 5589 55488 55</p>
                            <p>+1 6678 254445 41</p>
                        </div>
                    </div>

                    <div class="info-item" data-aos="fade-up" data-aos-delay="500">
                        <div class="icon-box">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div class="content">
                            <h4>Email Address</h4>
                            <p>info@example.com</p>
                            <p>contact@example.com</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="contact-form" data-aos="fade-up" data-aos-delay="300">
                    <h3><?= lang('bahasa.formHeader'); ?></h3>
                    <p><?= lang('bahasa.formDescription'); ?></p>

                    <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="<?= lang('bahasa.namePlaceholder'); ?>" required="">
                            </div>

                            <div class="col-md-6 ">
                                <input type="email" class="form-control" name="email" placeholder="<?= lang('bahasa.emailPlaceholder'); ?>" required="">
                            </div>

                            <div class="col-12">
                                <input type="text" class="form-control" name="subject" placeholder="<?= lang('bahasa.subjectPlaceholder'); ?>" required="">
                            </div>

                            <div class="col-12">
                                <textarea class="form-control" name="message" rows="6" placeholder="<?= lang('bahasa.messagePlaceholder'); ?>" required=""></textarea>
                            </div>

                            <div class="col-12 text-center">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>

                                <button type="submit" class="btn"><?= lang('bahasa.formButton'); ?></button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>

        </div>

    </div>

</section><!-- /Contact Section -->

<?= $this->endSection(); ?>