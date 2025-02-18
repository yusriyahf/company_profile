<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>



<section id="about" class="about section mt-5 d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="container text-center" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center">
            <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <img src="<?= base_url('assets/error/404.png') ?>"
                    alt="404 Not Found"
                    class="img-fluid rounded-4" style="width: 450px;">
                <p class="about-description mt-3"><?= lang('bahasa.404'); ?></p>
                <a href="<?= base_url('/') ?>" class="btn btn-primary  rounded-pill"><?= lang('bahasa.btnback'); ?></a>
            </div>
        </div>
    </div>
</section><!-- /About Section -->

<?= $this->endSection(); ?>