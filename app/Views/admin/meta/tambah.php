<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Tambahkan Meta</h1>
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

                    <form action="<?= base_url('admin/meta/proses_tambah') ?>" method="POST">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Nama Halaman (ID)</label>
                                    <input type="text" class="form-control" id="nama_halaman_id" name="nama_halaman_id" placeholder="Masukkan Nama Halaman" value="<?= old('nama_halaman_id') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Halaman (EN)</label>
                                    <input type="text" class="form-control" id="nama_halaman_en" name="nama_halaman_en" placeholder="Masukkan Nama Halaman" value="<?= old('nama_halaman_en') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi Halaman (ID)</label>
                                    <input type="text" class="form-control" id="deskripsi_halaman_id" name="deskripsi_halaman_id" placeholder="Masukkan Deskripsi Halaman" value="<?= old('deskripsi_halaman_id') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi Halaman (EN)</label>
                                    <input type="text" class="form-control" id="deskripsi_halaman_en" name="deskripsi_halaman_en" placeholder="Masukkan Deskripsi Halaman" value="<?= old('deskripsi_halaman_en') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Title (ID)</label>
                                    <input type="text" class="form-control" id="title_id" name="title_id" placeholder="Masukkan Meta Title (ID)" value="<?= old('title_id') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Title (EN)</label>
                                    <input type="text" class="form-control" id="title_en" name="title_en" placeholder="Masukkan Meta Title (EN)" value="<?= old('title_en') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Description (ID)</label>
                                    <input type="text" class="form-control" id="meta_desc_id" name="meta_desc_id" placeholder="Masukkan Meta Description (ID)" value="<?= old('meta_desc_id') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Description (EN)</label>
                                    <input type="text" class="form-control" id="meta_desc_en" name="meta_desc_en" placeholder="Masukkan Meta Description (EN)" value="<?= old('meta_desc_en') ?>">
                                </div>
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
            </div><!--//app-card-->
        </div><!--//row-->

        <hr class="my-4">
    </div><!--//container-fluid-->
</div><!--//app-content-->

<?= $this->endSection('content'); ?>