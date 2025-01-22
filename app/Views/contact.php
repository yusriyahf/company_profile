<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<section id="contact" class="contact section light-background mt-5">

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
                            <h4><?= lang('bahasa.email'); ?></h4>
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