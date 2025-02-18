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
                    <form action="<?= base_url('admin/aktivitas/proses_tambah') ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Nama Aktivitas (ID) <br> <span class="custom-color custom-label">nama aktivitas hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="judul_aktivitas_id" name="judul_aktivitas_id" value="<?= old('judul_aktivitas_id') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Aktivitas (EN) <br> <span class="custom-color custom-label">nama aktivitas hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="judul_aktivitas_en" name="judul_aktivitas_en" value="<?= old('judul_aktivitas_en') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi Aktivitas (ID)</label>
                                    <textarea type="text" class="form-control tiny" id="deskripsi_aktivitas_id" name="deskripsi_aktivitas_id"><?= old('deskripsi_aktivitas_id') ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi Aktivitas (EN)</label>
                                    <textarea type="text" class="form-control tiny" id="deskripsi_aktivitas_en" name="deskripsi_aktivitas_en"><?= old('deskripsi_aktivitas_en') ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kategori Aktivitas <br>
                                    <span class="custom-color custom-label">Pilih salah satu kategori aktivitas yang tersedia</span>
                                    </label>
                                    <select class="form-select" id="id_kategori_aktivitas" name="id_kategori_aktivitas" required>
    <option value="" selected disabled>Pilih Kategori Aktivitas</option>
    <?php foreach ($all_data_kategori as $kategori): ?>
        <option value="<?= esc($kategori['id_kategori_aktivitas']) ?>" <?= old('id_kategori_aktivitas') == $kategori['id_kategori_aktivitas'] ? 'selected' : '' ?>>
            <?= esc($kategori['nama_kategori_id']) ?>
        </option>
    <?php endforeach; ?>
</select>

                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Foto Aktivitas</label>
                                    <input class="form-control <?= ($validation->hasError('foto_aktivitas')) ? 'is-invalid' : '' ?>" type="file" id="foto_aktivitas" name="foto_aktivitas">
                                    <?= $validation->getError('foto_aktivitas') ?>
                                </div>
                                <p>*Ukuran foto maksimal 572x572 pixels</p>
                                <p>*Foto harus berekstensi jpg/png/jpeg</p>
                                <div class="mb-3">
                                    <label class="form-label">ALT aktivitas (ID) <br><span class="custom-color custom-label">alt aktivitas hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="alt_aktivitas_id" name="alt_aktivitas_id" value="<?= old('alt_aktivitas_id') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">ALT aktivitas (En) <br><span class="custom-color custom-label">alt aktivitas hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="alt_aktivitas_en" name="alt_aktivitas_en" value="<?= old('alt_aktivitas_en') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Snippet (In) <br><span class="custom-color custom-label">Snippet hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="snippet_id" name="snippet_id" value="<?= old('snippet_id') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Snippet (En) <br><span class="custom-color custom-label">Snippet hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="snippet_en" name="snippet_en" value="<?= old('snippet_en') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Title (ID)</label>
                                    <input type="text" class="form-control" id="title_aktivitas_id" name="title_aktivitas_id" value="<?= old('title_aktivitas_id') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Description (ID)</label>
                                    <input type="text" class="form-control" id="meta_desc_id" name="meta_desc_id" value="<?= old('meta_desc_id') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Title (EN)</label>
                                    <input type="text" class="form-control" id="title_aktivitas_en" name="title_aktivitas_en" value="<?= old('title_aktivitas_en') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Description (EN)</label>
                                    <input type="text" class="form-control" id="meta_desc_en" name="meta_desc_en" value="<?= old('meta_desc_en') ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug (ID)</label>
                                    <input type="text" class="form-control" id="slug_aktivitas_id" name="slug_aktivitas_id" placeholder="Masukkan Slug (ID)" value="<?= old('slug_aktivitas_id'); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug (EN)</label>
                                    <input type="text" class="form-control" id="slug_aktivitas_en" name="slug_aktivitas_en" placeholder="Masukkan Slug (EN)" value="<?= old('slug_aktivitas_en'); ?>">
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