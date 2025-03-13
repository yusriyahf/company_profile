<?= $this->extend('admin/template/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Edit Slider</h1>
        <hr class="mb-4">

        <div class="row g-4 settings-section">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="card-body">
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('warning')) : ?>
                        <div class="alert alert-warning" role="alert">
                            <?= session()->getFlashdata('warning') ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?= base_url('admin/slider/proses_edit/' . $sliderData['id_slider']) ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>

                        <input type="hidden" name="id_slider" value="<?= $sliderData['id_slider'] ?>">

                        <!-- Foto Slider 1 -->
                        <div class="mb-3">
                            <label for="file_foto_slider">Ganti Foto Slider:</label>
                            <div class="mt-2">
                                <img src="<?= !empty($sliderData['foto_slider']) ? base_url('assets/img/slider/' . $sliderData['foto_slider']) : base_url('asset-user/images/default.png'); ?>" width="200" alt="Preview Slider">
                            </div>
                            <input type="file" name="file_foto_slider" id="file_foto_slider" class="form-control mt-3">

                            <!-- Alt Text ID -->
                            <label for="alt_foto_slider_id" class="mt-2">Alt Foto Slider (id)</label>
                            <input type="text" name="alt_foto_slider_id" id="alt_foto_slider_id" class="form-control" value="<?= isset($sliderData['alt_foto_slider_id']) ? $sliderData['alt_foto_slider_id'] : ''; ?>">

                            <!-- Alt Text EN -->
                            <label for="alt_foto_slider_en" class="mt-2">Alt Foto Slider (en)</label>
                            <input type="text" name="alt_foto_slider_en" id="alt_foto_slider_en" class="form-control" value="<?= isset($sliderData['alt_foto_slider_en']) ? $sliderData['alt_foto_slider_en'] : ''; ?>">

                            <!-- caption id -->
                            <label for="caption_slider_id" class="mt-2">Caption Slider (id)</label>
                            <input type="text" name="caption_slider_id" id="caption_slider_id" class="form-control" value="<?= isset($sliderData['caption_slider_id']) ? $sliderData['caption_slider_id'] : ''; ?>">

                            <!-- caption id -->
                            <label for="caption_slider_en" class="mt-2">Caption Slider (en)</label>
                            <input type="text" name="caption_slider_en" id="caption_slider_en" class="form-control" value="<?= isset($sliderData['caption_slider_en']) ? $sliderData['caption_slider_en'] : ''; ?>">
                        </div>


                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <?php if (session()->getFlashdata('success')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div><!-- //app-card -->
        </div><!-- //row -->

        <hr class="my-4">
    </div><!-- //container-xl -->
</div><!-- //app-content -->

<?= $this->endSection(); ?>