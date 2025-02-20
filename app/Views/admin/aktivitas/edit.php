<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Edit Aktivitas</h1>
        <hr class="mb-4">
        <div class="row g-4 settings-section">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="card-body">
                    <form action="<?= base_url('admin/aktivitas/proses_edit/' . $aktivitasData['id_aktivitas']) ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" id="id_aktivitas" name="id_aktivitas" value="<?= $aktivitasData['id_aktivitas'] ?>" hidden>
                                <div class="mb-3">
                                    <label class="form-label">Nama Aktivitas (In) <br><span class="custom-color custom-label">nama Aktivitas hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="judul_aktivitas_id" name="judul_aktivitas_id" value="<?= $aktivitasData['judul_aktivitas_id']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Aktivitas (En) <br><span class="custom-color custom-label">nama Aktivitas hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="judul_aktivitas_en" name="judul_aktivitas_en" value="<?= $aktivitasData['judul_aktivitas_en']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi Aktivitas (In)</label>
                                    <textarea type="text" class="form-control tiny" id="deskripsi_aktivitas_id" name="deskripsi_aktivitas_id"><?= $aktivitasData['deskripsi_aktivitas_id']; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi Aktivitas (En)</label>
                                    <textarea type="text" class="form-control tiny" id="deskripsi_aktivitas_en" name="deskripsi_aktivitas_en"><?= $aktivitasData['deskripsi_aktivitas_en']; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kategori Aktivitas <br>
                                    <span class="custom-color custom-label">Pilih salah satu kategori aktivitas yang tersedia</span>
                                    </label>
                                    <select class="form-select" id="id_kategori_aktivitas" name="id_kategori_aktivitas" required>
                                        <option value="" selected disabled>Pilih Kategori Aktivitas</option>
                                        <?php foreach ($all_data_kategori as $kategori): ?>
                                            <option value="<?= esc($kategori['id_kategori_aktivitas']) ?>" <?= old('id_kategori_aktivitas', $aktivitasData['id_kategori_aktivitas']) == $kategori['id_kategori_aktivitas'] ? 'selected' : '' ?>>
                                                <?= esc($kategori['nama_kategori_id']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Foto Aktivitas</label>
                                    <input type="file" class="form-control" id="foto_aktivitas" name="foto_aktivitas">
                                    <img width="150px" class="img-thumbnail" src="<?= base_url() . "assets/img/aktivitas/" . $aktivitasData['foto_aktivitas']; ?>">
                                    <?= $validation->getError('foto_aktivitas') ?>
                                </div>
                                <p>*Ukuran foto maksimal 572x572 pixels</p>
                                <p>*Foto harus berekstensi jpg/png/jpeg</p>
                                <div class="mb-3">
                                    <label class="form-label">Alt (ID)</label>
                                    <input type="text" class="form-control" id="alt_aktivitas_id" name="alt_aktivitas_id" placeholder="Masukkan Meta Title (ID)" value="<?= old('alt_aktivitas_id', $aktivitasData['alt_aktivitas_id']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alt (EN)</label>
                                    <input type="text" class="form-control" id="alt_aktivitas_en" name="alt_aktivitas_en" placeholder="Masukkan Meta Title (ID)" value="<?= old('alt_aktivitas_en', $aktivitasData['alt_aktivitas_en']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Snippet (ID)</label>
                                    <input type="text" class="form-control" id="snippet_id" name="snippet_id" placeholder="Masukkan Meta Title (ID)" value="<?= old('snippet_id', $aktivitasData['snippet_id']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Snippet (EN)</label>
                                    <input type="text" class="form-control" id="snippet_en" name="snippet_en" placeholder="Masukkan Meta Title (ID)" value="<?= old('snippet_en', $aktivitasData['snippet_en']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Title (ID)</label>
                                    <input type="text" class="form-control" id="title_aktivitas_id" name="title_aktivitas_id" placeholder="Masukkan Meta Title (ID)" value="<?= old('title_aktivitas_id', $aktivitasData['title_aktivitas_id']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Description (ID)</label>
                                    <input type="text" class="form-control" id="meta_desc_id" name="meta_desc_id" placeholder="Masukkan Meta Description (ID)" value="<?= old('meta_desc_id', $aktivitasData['meta_desc_id']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Title (EN)</label>
                                    <input type="text" class="form-control" id="title_aktivitas_en" name="title_aktivitas_en" placeholder="Masukkan Meta Title (EN)" value="<?= old('title_aktivitas_en', $aktivitasData['title_aktivitas_en']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Description (EN)</label>
                                    <input type="text" class="form-control" id="meta_desc_en" name="meta_desc_en" placeholder="Masukkan Meta Description (EN)" value="<?= old('meta_desc_en', $aktivitasData['meta_desc_en']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug (ID)</label>
                                    <input type="text" class="form-control" id="slug_aktivitas_id" name="slug_aktivitas_id" placeholder="Masukkan Slug (ID)" value="<?= old('slug_aktivitas_id', $aktivitasData['slug_aktivitas_id']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug (EN)</label>
                                    <input type="text" class="form-control" id="slug_en" name="slug_aktivitas_en" placeholder="Masukkan Slug (EN)" value="<?= old('slug_aktivitas_en', $aktivitasData['slug_aktivitas_en']) ?>">
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
