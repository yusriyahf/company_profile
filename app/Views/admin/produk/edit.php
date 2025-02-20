<?= $this->extend('admin/template/template'); ?>
<?= $this->Section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Edit Produk</h1>
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
                    <form action="<?= base_url('admin/produk/proses_edit/' . $produkData['id_produk']) ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" id="id_produk" name="id_produk" value="<?= $produkData['id_produk'] ?>" hidden>
                                <div class="mb-3">
                                    <label class="form-label">Nama Produk (In) <br><span class="custom-color custom-label">nama Produk hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="nama_produk_id" name="nama_produk_id" value="<?= $produkData['nama_produk_id']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Produk (En) <br><span class="custom-color custom-label">nama Produk hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="nama_produk_en" name="nama_produk_en" value="<?= $produkData['nama_produk_en']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi Produk (In)</label>
                                    <textarea type="text" class="form-control tiny" id="deskripsi_produk_id" name="deskripsi_produk_id"><?= $produkData['deskripsi_produk_id']; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi Produk (En)</label>
                                    <textarea type="text" class="form-control tiny" id="deskripsi_produk_en" name="deskripsi_produk_en"><?= $produkData['deskripsi_produk_en']; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Foto Produk</label>
                                    <input type="file" class="form-control" id="foto_produk" name="foto_produk">
                                    <img width="150px" class="img-thumbnail" src="<?= base_url() . "assets/img/produk/" . $produkData['foto_produk']; ?>">
                                    <?= $validation->getError('foto_produk') ?>
                                </div>
                                <p>*Ukuran foto maksimal 572x572 pixels</p>
                                <p>*Foto harus berekstensi jpg/png/jpeg</p>
                                <div class="mb-3">
                                    <label class="form-label">ALT Produk (In) <br><span class="custom-color custom-label">nama alt hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="alt_produk_id" name="alt_produk_id" value="<?= $produkData['alt_produk_id']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">ALT Produk (En) <br><span class="custom-color custom-label">nama alt hanya boleh mengandung huruf dan angka</span></label>
                                    <input type="text" class="form-control" id="alt_produk_en" name="alt_produk_en" value="<?= $produkData['alt_produk_en']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Title (ID)</label>
                                    <input type="text" class="form-control" id="title_id" name="title_id" placeholder="Masukkan Meta Title (ID)" value="<?= old('title_id', $produkData['title_id']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Description (ID)</label>
                                    <input type="text" class="form-control" id="meta_desc_id" name="meta_desc_id" placeholder="Masukkan Meta Description (ID)" value="<?= old('meta_desc_id', $produkData['meta_desc_id']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Title (EN)</label>
                                    <input type="text" class="form-control" id="meta_title_en" name="title_en" placeholder="Masukkan Meta Title (EN)" value="<?= old('title_en', $produkData['title_en']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meta Description (EN)</label>
                                    <input type="text" class="form-control" id="meta_desc_en" name="meta_desc_en" placeholder="Masukkan Meta Description (EN)" value="<?= old('meta_desc_en', $produkData['meta_desc_en']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug (ID)</label>
                                    <input type="text" class="form-control" id="slug_id" name="slug_id" placeholder="Masukkan Slug (ID)" value="<?= old('slug_id', $produkData['slug_id']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Slug (EN)</label>
                                    <input type="text" class="form-control" id="slug_en" name="slug_en" placeholder="Masukkan Slug (EN)" value="<?= old('slug_en', $produkData['slug_en']) ?>">
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
                </div>
            </div><!--//app-card-->
        </div><!--//row-->

        <hr class="my-4">
    </div><!--//container-fluid-->
</div><!--//app-content-->

<?= $this->endSection('content') ?>