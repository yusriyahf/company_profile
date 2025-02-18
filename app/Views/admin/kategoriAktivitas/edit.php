<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Edit Kategori Aktivitas</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="card-body">
                    <form action="<?= base_url('admin/kategoriAktivitas/proses_edit/' . $all_data_aktivitas_kategori['id_kategori_aktivitas']) ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" id="id_kategori_aktivitas" name="id_kategori_aktivitas" value="<?= $all_data_aktivitas_kategori['id_kategori_aktivitas'] ?>" hidden>
                                <div class="mb-3">
                                    <label class="form-label">Nama Kategori (In) <br><span class="custom-color custom-label">nama kategori hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="nama_kategori_id" name="nama_kategori_id" value="<?= $all_data_aktivitas_kategori['nama_kategori_id']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Kategori (En) <br><span class="custom-color custom-label">nama Klien hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="nama_kategori_en" name="nama_kategori_en" value="<?= $all_data_aktivitas_kategori['nama_kategori_en']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Title (ID)</label>
                                    <input type="text" class="form-control" id="title_kategori_id" name="title_kategori_id" placeholder="Masukkan Meta Title (ID)" value="<?= old('title_kategori_id', $all_data_aktivitas_kategori['title_kategori_id']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Description (ID)</label>
                                    <input type="text" class="form-control" id="meta_desc_id" name="meta_desc_id" placeholder="Masukkan Meta Description (ID)" value="<?= old('meta_desc_id', $all_data_aktivitas_kategori['meta_desc_id']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Title (EN)</label>
                                    <input type="text" class="form-control" id="title_kategori_en" name="title_kategori_en" placeholder="Masukkan Meta Title (EN)" value="<?= old('title_kategori_en', $all_data_aktivitas_kategori['title_kategori_en']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Description (EN)</label>
                                    <input type="text" class="form-control" id="meta_desc_en" name="meta_desc_en" placeholder="Masukkan Meta Description (EN)" value="<?= old('meta_desc_en', $all_data_aktivitas_kategori['meta_desc_en']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug (ID)</label>
                                    <input type="text" class="form-control" id="slug_kategori_id" name="slug_kategori_id" placeholder="Masukkan Slug (ID)" value="<?= old('slug_kategori_id', $all_data_aktivitas_kategori['slug_kategori_id']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug (EN)</label>
                                    <input type="text" class="form-control" id="slug_kategori_en" name="slug_kategori_en" placeholder="Masukkan Slug (EN)" value="<?= old('slug_kategori_en', $all_data_aktivitas_kategori['slug_kategori_en']) ?>">
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

<?= $this->endSection('content') ?>