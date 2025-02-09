<?= $this->extend('admin/template/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Edit Slider</h1>
        <hr class="mb-4">

        <div class="row g-4 settings-section">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="card-body">
                    <form action="<?= base_url('admin/slider/proses_edit/' . $sliderData['id_slider']) ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>

                        <input type="hidden" name="id_slider" value="<?= $sliderData['id_slider'] ?>">

                        <!-- Foto Slider 1 -->
                        <div class="mb-3">
                            <label for="file_foto_slider1">Ganti Foto Slider 1 (Opsional):</label>
                            <div class="mt-2">
                                <img src="<?= !empty($sliderData['foto_slider1']) ? base_url('assets/img/slider/' . $sliderData['foto_slider1']) : base_url('asset-user/images/default.png'); ?>" width="200" alt="Preview Slider 1">
                            </div>
                            <input type="file" name="file_foto_slider1" id="file_foto_slider1" class="form-control mt-3">
                            <!-- Alt Text ID -->
                            <label for="alt_foto_slider1_id" class="mt-2">Alt Foto Slider (id)</label>
                            <input type="text" name="alt_foto_slider1_id" id="alt_foto_slider1_id" class="form-control" value="<?= isset($sliderData['alt_foto_slider1_id']) ? $sliderData['alt_foto_slider1_id'] : ''; ?>">

                            <!-- Alt Text EN -->
                            <label for="alt_foto_slider1_en" class="mt-2">Alt Foto Slider (en)</label>
                            <input type="text" name="alt_foto_slider1_en" id="alt_foto_slider1_en" class="form-control" value="<?= isset($sliderData['alt_foto_slider1_en']) ? $sliderData['alt_foto_slider1_en'] : ''; ?>">
                        </div>

                        <!-- Foto Slider 2 -->
                        <div class="mb-3">
                            <label for="file_foto_slider2">Ganti Foto Slider 2 (Opsional):</label>
                            <div class="mt-2">
                                <img src="<?= !empty($sliderData['foto_slider2']) ? base_url('assets/img/slider/' . $sliderData['foto_slider2']) : base_url('assets/img/slider/default.png'); ?>" width="200" alt="Preview Slider 2">
                            </div>
                            <input type="file" name="file_foto_slider2" id="file_foto_slider2" class="form-control mt-3">
                            <!-- Alt Text ID -->
                            <label for="alt_foto_slider2_id" class="mt-2">Alt Foto Slider (id)</label>
                            <input type="text" name="alt_foto_slider2_id" id="alt_foto_slider2_id" class="form-control" value="<?= isset($sliderData['alt_foto_slider2_id']) ? $sliderData['alt_foto_slider2_id'] : ''; ?>">

                            <!-- Alt Text EN -->
                            <label for="alt_foto_slider2_en" class="mt-2">Alt Foto Slider (en)</label>
                            <input type="text" name="alt_foto_slider2_en" id="alt_foto_slider2_en" class="form-control" value="<?= isset($sliderData['alt_foto_slider2_en']) ? $sliderData['alt_foto_slider2_en'] : ''; ?>">
                        </div>

                        <!-- Foto Slider 3 -->
                        <div class="mb-3">
                            <label for="file_foto_slider3">Ganti Foto Slider 3 (Opsional):</label>
                            <div class="mt-2">
                                <img src="<?= !empty($sliderData['foto_slider3']) ? base_url('assets/img/slider/' . $sliderData['foto_slider3']) : base_url('assets/img/slider/default.png'); ?>" width="200" alt="Preview Slider 3">
                            </div>
                            <input type="file" name="file_foto_slider3" id="file_foto_slider3" class="form-control mt-3">
                            <!-- Alt Text ID -->
                            <label for="alt_foto_slider3_id" class="mt-2">Alt Foto Slider (id)</label>
                            <input type="text" name="alt_foto_slider3_id" id="alt_foto_slider3_id" class="form-control" value="<?= isset($sliderData['alt_foto_slider3_id']) ? $sliderData['alt_foto_slider3_id'] : ''; ?>">

                            <!-- Alt Text EN -->
                            <label for="alt_foto_slider3_en" class="mt-2">Alt Foto Slider (en)</label>
                            <input type="text" name="alt_foto_slider3_en" id="alt_foto_slider3_en" class="form-control" value="<?= isset($sliderData['alt_foto_slider3_en']) ? $sliderData['alt_foto_slider3_en'] : ''; ?>">
                        </div>

                        <p class="text-muted">*Ukuran foto maksimal 1900x1144 pixels</p>
                        <p class="text-muted">*Foto harus berekstensi jpg/png/jpeg</p>

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
