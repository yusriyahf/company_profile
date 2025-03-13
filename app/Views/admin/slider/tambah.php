<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Tambahkan Slider</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="card-body">

                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                        <div class="alert alert-danger" role="alert">
                            <h4>Error</h4>
                            <p><?php echo session()->getFlashdata('error'); ?></p>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('admin/slider/proses_tambah') ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="mb-3">
                            <label class="form-label">Foto Slider</label>
                            <input class="form-control <?= (session()->getFlashdata('error_foto_slider')) ? 'is-invalid' : '' ?>" type="file" id="foto_slider" name="foto_slider">
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('error_foto_slider') ?>
                            </div>
                        </div>
                        <p>*Ukuran foto maksimal 2MB</p>
                        <p>*Foto harus berekstensi jpg/png/jpeg</p>
                        <div class="mb-3">
                            <label class="form-label">ALT Foto Slider (ID) <br><span class="custom-color custom-label">alt Slider hanya boleh mengandung huruf dan angka</span></label>
                            <input type="text" class="form-control" id="alt_foto_slider_id" name="alt_foto_slider_id" value="<?= old('alt_foto_slider_id') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ALT Foto Slider (En) <br><span class="custom-color custom-label">alt Slider hanya boleh mengandung huruf dan angka</span></label>
                            <input type="text" class="form-control" id="alt_foto_slider_en" name="alt_foto_slider_en" value="<?= old('alt_foto_slider_en') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Caption Slider (ID) <br><span class="custom-color custom-label">caption hanya boleh mengandung huruf dan angka</span></label>
                            <input type="text" class="form-control" id="caption_slider_id" name="caption_slider_id" value="<?= old('caption_slider_id') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Caption Slider (En) <br><span class="custom-color custom-label">caption hanya boleh mengandung huruf dan angka</span></label>
                            <input type="text" class="form-control" id="caption_slider_en" name="caption_slider_en" value="<?= old('caption_slider_en') ?>">
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            <div class="col">
                                <?php if (!empty(session()->getFlashdata('success'))) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo session()->getFlashdata('success') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!--//app-card-->
    </div><!--//row-->

    <hr class="my-4">
</div><!--//container-fluid-->

<?= $this->endSection('content') ?>