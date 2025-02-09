<?= $this->extend('admin/template/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
	<div class="container-xl">
		<h1 class="app-page-title">Ubah Profil Perusahaan</h1>
		<?php if (!empty(session()->getFlashdata('error'))) : ?>
			<div class="alert alert-danger" role="alert">
				<h4>Error</h4>
				<p><?php echo session()->getFlashdata('error'); ?></p>
			</div>
		<?php endif; ?>
		<?php if (session()->has('success')) : ?>
			<div class="alert alert-success">
				<?= session('success') ?>
			</div>
		<?php endif; ?>

        <div class="row gy-4">
            <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start mb-4 mt-4">
                <div class="app-card-body px-4 w-100">
                    <form action="<?= base_url('admin/profil/proses_edit'); ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>

                        <div class="mb-3 mt-4">
                            <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" value="<?= esc($profil_pengguna['nama_perusahaan'] ); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi_perusahaan_id" class="form-label">Deskripsi Perusahaan (Indonesia)</label>
                            <textarea class="form-control tiny" id="deskripsi_perusahaan_id" name="deskripsi_perusahaan_id"><?= esc($profil_pengguna['deskripsi_perusahaan_id'] ?? ''); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi_perusahaan_en" class="form-label">Deskripsi Perusahaan (Inggris)</label>
                            <textarea class="form-control tiny" id="deskripsi_perusahaan_en" name="deskripsi_perusahaan_en"><?= esc($profil_pengguna['deskripsi_perusahaan_en'] ?? ''); ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="footer" class="form-label">Teks Footer</label>
                            <input type="text" class="form-control" id="footer" name="footer" value="<?= esc($profil_pengguna['footer'] ?? ''); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="alt_foto_perusahaan_id" class="form-label">Alt Foto Perusahaan (Indonesia)</label>
                            <input type="text" class="form-control" id="alt_foto_perusahaan_id" name="alt_foto_perusahaan_id" value="<?= esc($profil_pengguna['alt_foto_perusahaan_id'] ?? ''); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="alt_foto_perusahaan_en" class="form-label">Alt Foto Perusahaan (Inggris)</label>
                            <input type="text" class="form-control" id="alt_foto_perusahaan_en" name="alt_foto_perusahaan_en" value="<?= esc($profil_pengguna['alt_foto_perusahaan_en'] ?? ''); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="alt_logo_perusahaan_id" class="form-label">Alt Logo Perusahaan (Indonesia)</label>
                            <input type="text" class="form-control" id="alt_logo_perusahaan_id" name="alt_logo_perusahaan_id" value="<?= esc($profil_pengguna['alt_logo_perusahaan_id'] ?? ''); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="alt_logo_perusahaan_en" class="form-label">Alt Logo Perusahaan (Inggris)</label>
                            <input type="text" class="form-control" id="alt_logo_perusahaan_en" name="alt_logo_perusahaan_en" value="<?= esc($profil_pengguna['alt_logo_perusahaan_en'] ?? ''); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="logo_perusahaan" class="form-label">Logo Perusahaan</label>
                            <input type="file" class="form-control" id="logo_perusahaan" name="logo_perusahaan">
                            <img width="150px" class="img-thumbnail" src="<?= base_url('assets/img/profil/' . esc($profil_pengguna['logo_perusahaan'] ?? 'default.png')); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="favicon_perusahaan" class="form-label">Favicon Perusahaan</label>
                            <input type="file" class="form-control" id="favicon_perusahaan" name="favicon_perusahaan">
                            <img width="150px" class="img-thumbnail" src="<?= base_url('assets/img/profil/' . esc($profil_pengguna['favicon_perusahaan'] ?? 'default.png')); ?>">
                        </div>

                        <div class="mb-3">
                            <label for="foto_perusahaan" class="form-label">Foto Perusahaan</label>
                            <input type="file" class="form-control" id="foto_perusahaan" name="foto_perusahaan">
                            <img width="150px" class="img-thumbnail" src="<?= base_url('assets/img/profil/' . esc($profil_pengguna['foto_perusahaan'] ?? 'default.png')); ?>">
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= base_url('admin/dashboard'); ?>" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div><!--//app-card-body-->
            </div><!--//app-card-->
        </div><!--//row-->
    </div><!--//container-xl-->
</div><!--//app-content-->

<?= $this->endSection(); ?>
