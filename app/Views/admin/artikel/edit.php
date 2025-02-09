<?= $this->extend('admin/template/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Edit Artikel</h1>
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
                    <form action="<?= base_url('admin/artikel/proses_edit/' . $artikelData['id_artikel'] ?? '') ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col">
                                <?php if (isset($artikelData)) : ?>
                                    <input type="text" class="form-control" id="id_artikel" name="id_artikel" value="<?= $artikelData['id_artikel'] ?>" hidden>

                                    <!-- Input Judul Artikel Indonesia -->
                                    <div class="mb-3">
                                        <label class="form-label">Kategori</label>
                                        <select class="form-control" id="id_kategori_artikel" name="id_kategori_artikel">
                                            <option value="">Pilih Kategori</option>
                                            <?php foreach ($kategori as $kat) : ?>
                                                <option value="<?= $kat['id_kategori_artikel']; ?>" <?= old('id_kategori_artikel', $artikelData['id_kategori_artikel']) == $kat['id_kategori_artikel'] ? 'selected' : ''; ?>>
                                                    <?= $kat['nama_kategori_id']; ?> - <?= $kat['nama_kategori_en']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Judul Artikel (Id)</label>
                                        <input type="text" class="form-control" id="judul_artikel_id" name="judul_artikel_id" value="<?= $artikelData['judul_artikel_id']; ?>">
                                    </div>

                                    <!-- Input Judul Artikel Inggris -->
                                    <div class="mb-3">
                                        <label class="form-label">Judul Artikel (En)</label>
                                        <input type="text" class="form-control" id="judul_artikel_en" name="judul_artikel_en" value="<?= $artikelData['judul_artikel_en']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Slug Artikel (Id)</label>
                                        <input type="text" class="form-control" id="slug_artikel" name="slug_artikel" value="<?= $artikelData['slug_artikel_id']; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Slug Artikel (En)</label>
                                        <input type="text" class="form-control" id="slug_artikel_en" name="slug_artikel_en" value="<?= $artikelData['slug_artikel_en']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Snippet (Id)</label>
                                        <input type="text" class="form-control" id="snippet_id" name="snippet_id" value="<?= $artikelData['snippet_id']; ?>">
                                    </div>

                                    <!-- Input Judul Artikel Inggris -->
                                    <div class="mb-3">
                                        <label class="form-label">Snippet (En)</label>
                                        <input type="text" class="form-control" id="snippet_en" name="snippet_en" value="<?= $artikelData['snippet_en']; ?>">
                                    </div>

                                    <!-- Input Deskripsi Artikel Indonesia -->
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi Artikel (Id)</label>
                                        <textarea type="text" class="form-control tiny" id="deskripsi_artikel_id" name="deskripsi_artikel_id"><?= $artikelData['deskripsi_artikel_id']; ?></textarea>
                                    </div>

                                    <!-- Input Deskripsi Artikel Inggris -->
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi Artikel (En)</label>
                                        <textarea type="text" class="form-control tiny" id="deskripsi_artikel_en" name="deskripsi_artikel_en"><?= $artikelData['deskripsi_artikel_en']; ?></textarea>
                                    </div>

                                    <!-- Input untuk Foto Artikel -->
                                    <div class="mb-3">
                                        <label class="form-label">Foto Artikel</label>
                                        <input type="file" class="form-control" id="foto_artikel" name="foto_artikel">
                                        <img width="150px" class="img-thumbnail" src="<?= base_url() . "assets/img/artikel/" . $artikelData['foto_artikel']; ?>">d
                                        <?php if ($validation ?? false && $validation->hasError('foto_artikel')) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('foto_artikel') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <p>*Ukuran foto maksimal 572x572 pixels</p>
                                    <p>*Foto harus berekstensi jpg/png/jpeg</p>

                                    <div class="mb-3">
                                        <label class="form-label">Alt Foto Artikel (Id)</label>
                                        <input type="text" class="form-control" id="alt_artikel_id" name="alt_artikel_id" value="<?= $artikelData['alt_artikel_id']; ?>">
                                    </div>

                                    <!-- Input Judul Artikel Inggris -->
                                    <div class="mb-3">
                                        <label class="form-label">Alt Foto Artikel (En)</label>
                                        <input type="text" class="form-control" id="alt_artikel_en" name="alt_artikel_en" value="<?= $artikelData['alt_artikel_en']; ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Meta Title (ID)</label>
                                        <input type="text" class="form-control" id="title_artikel_id" name="title_artikel_id" placeholder="Masukkan Meta Title (ID)" value="<?= old('title_artikel_id', $artikelData['title_artikel_id']) ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Meta Title (EN)</label>
                                        <input type="text" class="form-control" id="title_artikel_en" name="title_artikel_en" placeholder="Masukkan Meta Title (EN)" value="<?= old('title_artikel_en', $artikelData['title_artikel_en']) ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Meta Description (ID)</label>
                                        <input type="text" class="form-control" id="meta_desc_id" name="meta_desc_id" placeholder="Masukkan Meta Description (ID)" value="<?= old('meta_desc_id', $artikelData['meta_desc_id']) ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Meta Description (EN)</label>
                                        <input type="text" class="form-control" id="meta_desc_en" name="meta_desc_en" placeholder="Masukkan Meta Description (EN)" value="<?= old('meta_desc_en', $artikelData['meta_desc_en']) ?>">
                                    <?php endif; ?>
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