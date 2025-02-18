<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Tambahkan Aktivitas</h1>
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
                    <form action="<?= base_url('admin/kategoriAktivitas/proses_tambah') ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Nama Ketegori (In) <br><span class="custom-color custom-label">nama kategori hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="nama_kategori_id" name="nama_kategori_id" value="<?= old('nama_kategori_id') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Kategori (En) <br><span class="custom-color custom-label">nama kategori hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="nama_kategori_en" name="nama_kategori_en" value="<?= old('nama_kategori_en') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Title (ID)</label>
                                    <input type="text" class="form-control" id="title_kategori_id" name="title_kategori_id" placeholder="Masukkan Meta Title (ID)" value="<?= old('title_kategori_id') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Description (ID)</label>
                                    <input type="text" class="form-control" id="meta_desc_id" name="meta_desc_id" placeholder="Masukkan Meta Description (ID)" value="<?= old('meta_desc_id') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Title (EN)</label>
                                    <input type="text" class="form-control" id="title_kategori_en" name="title_kategori_en" placeholder="Masukkan Meta Title (EN)" value="<?= old('title_kategori_en') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Description (EN)</label>
                                    <input type="text" class="form-control" id="meta_desc_en" name="meta_desc_en" placeholder="Masukkan Meta Description (EN)" value="<?= old('meta_desc_en') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug (ID)</label>
                                    <input type="text" class="form-control" id="slug_kategori_id" name="slug_kategori_id" placeholder="Masukkan Slug (ID)" value="<?= old('slug_kategori_id'); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug (EN)</label>
                                    <input type="text" class="form-control" id="slug_kategori_en" name="slug_kategori_en" placeholder="Masukkan Slug (EN)" value="<?= old('slug_kategori_en'); ?>">
                                </div>
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
                </div><!--//app-card-->
            </div>
        </div><!--//row-->

        <hr class="my-4">
    </div><!--//container-fluid-->
</div><!--//app-content-->

<?= $this->endSection('content') ?>