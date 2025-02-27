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
                                    <label class="form-label">Foto Slider 1</label>
                                    <input class="form-control <?= ($validation->hasError('foto_slider1')) ? 'is-invalid' : '' ?>" type="file" id="foto_slider1" name="foto_slider1">
                                    <?= $validation->getError('foto_slider1') ?>
                                </div>
                                <p>*Ukuran foto maksimal 572x572 pixels</p>
                                <p>*Foto harus berekstensi jpg/png/jpeg</p>
                        <div class="mb-3">
                                    <label class="form-label">ALT Slider 1(ID) <br><span class="custom-color custom-label">alt Slider hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="alt_foto_slider1_id" name="alt_foto_slider1_id" value="<?= old('alt_foto_slider1_id') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">ALT Slider 1(En) <br><span class="custom-color custom-label">alt Slider hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="alt_foto_slider1_en" name="alt_foto_slider1_en" value="<?= old('alt_foto_slider1_en') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Foto Slider 2</label>
                                    <input class="form-control <?= ($validation->hasError('foto_slider2')) ? 'is-invalid' : '' ?>" type="file" id="foto_slider2" name="foto_slider2">
                                    <?= $validation->getError('foto_slider2') ?>
                                </div>
                                <p>*Ukuran foto maksimal 572x572 pixels</p>
                                <p>*Foto harus berekstensi jpg/png/jpeg</p>
                        <div class="mb-3">
                                    <label class="form-label">ALT Slider 2(ID) <br><span class="custom-color custom-label">alt Slider hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="alt_foto_slider2_id" name="alt_foto_slider2_id" value="<?= old('alt_foto_slider2_id') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">ALT Slider 2(En) <br><span class="custom-color custom-label">alt Slider hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="alt_foto_slider2_en" name="alt_foto_slider2_en" value="<?= old('alt_foto_slider2_en') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Foto Slider 3</label>
                                    <input class="form-control <?= ($validation->hasError('foto_slider3')) ? 'is-invalid' : '' ?>" type="file" id="foto_slider3" name="foto_slider3">
                                    <?= $validation->getError('foto_slider3') ?>
                                </div>
                                <p>*Ukuran foto maksimal 572x572 pixels</p>
                                <p>*Foto harus berekstensi jpg/png/jpeg</p>
                        <div class="mb-3">
                                    <label class="form-label">ALT Slider 3(ID) <br><span class="custom-color custom-label">alt Slider hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="alt_foto_slider3_id" name="alt_foto_slider3_id" value="<?= old('alt_foto_slider3_id') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">ALT Slider 3(En) <br><span class="custom-color custom-label">alt Slider hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="alt_foto_slider3_en" name="alt_foto_slider3_en" value="<?= old('alt_foto_slider3_en') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Caption (ID) <br><span class="custom-color custom-label">caption hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="caption_slider_id" name="caption_slider_id" value="<?= old('caption_slider_id') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Caption (En) <br><span class="custom-color custom-label">caption hanya boleh mengandung huruf dan angka</span></label>
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