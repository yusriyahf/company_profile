<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Edit Kategori Artikel</h1>
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

                    <form action="<?= base_url('admin/kategoriartikel/update/' . $category['id_kategori_artikel']) ?>" method="POST">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Nama Kategori (ID)</label>
                                    <input type="text" class="form-control" id="nama_kategori_id" name="nama_kategori_id" placeholder="Masukkan Nama Kategori" value="<?= old('nama_kategori_id', $category['nama_kategori_id']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Kategori (EN)</label>
                                    <input type="text" class="form-control" id="nama_kategori_en" name="nama_kategori_en" placeholder="Masukkan Nama Kategori" value="<?= old('nama_kategori_en', $category['nama_kategori_en']) ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Meta Title (ID)</label>
                                    <input type="text" class="form-control" id="title_kategori_id" name="title_kategori_id" placeholder="Masukkan Nama Kategori" value="<?= old('title_kategori_id', $category['title_kategori_id']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Title (EN)</label>
                                    <input type="text" class="form-control" id="title_kategori_en" name="title_kategori_en" placeholder="Masukkan Nama Kategori" value="<?= old('title_kategori_en', $category['title_kategori_en']) ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Meta Description (ID)</label>
                                    <input type="text" class="form-control" id="meta_desc_id" name="meta_desc_id" placeholder="Masukkan Meta Description" value="<?= old('meta_desc_id', $category['meta_desc_id']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Description (EN)</label>
                                    <input type="text" class="form-control" id="meta_desc_en" name="meta_desc_en" placeholder="Masukkan Meta Description" value="<?= old('meta_desc_en', $category['meta_desc_en']) ?>">
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