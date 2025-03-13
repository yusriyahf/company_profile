<?= $this->extend('admin/template/template'); ?>
<?= $this->section('content'); ?>

<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Daftar Slider</h1>
            </div>
            </br>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="<?php echo base_url("admin/slider/tambah") ?>" class="btn btn-primary me-md-2"> + Tambah Slider</a>
            </div>
        </div>

        <div class="tab-content" id="orders-table-tab-content">
            <?php if (session()->has('success')) : ?>
                <div class="alert alert-success">
                    <?= session('success') ?>
                </div>
            <?php endif; ?>

            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-body">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="text-center">Foto Slider</th>
                                        <th class="text-center">Alt Text (ID)</th>
                                        <th class="text-center">Alt Text (EN)</th>
                                        <th colspan="3" class="text-center">Caption (ID)</th>
                                        <th colspan="3" class="text-center">Caption (EN)</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($all_data_slider as $tampilSlider) : ?>
                                        <!-- Baris 1: Gambar Slider 1, Alt Text (ID) dan Alt Text (EN) -->
                                        <tr>
                                            <td>
                                                <?php if (!empty($tampilSlider['foto_slider'])) : ?>
                                                    <img src="<?= base_url() . 'assets/img/slider/' . $tampilSlider['foto_slider'] ?>" class="img-fluid" alt="<?= $tampilSlider['alt_foto_slider_id'] ?>">
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $tampilSlider['alt_foto_slider_id'] ?></td>
                                            <td><?= $tampilSlider['alt_foto_slider_en'] ?></td>
                                            <td colspan="3">
                                                <?= $tampilSlider['caption_slider_id'] ?>
                                            </td>
                                            <td colspan="3">
                                                <?= $tampilSlider['caption_slider_en'] ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('admin/slider/edit') . '/' . $tampilSlider['id_slider'] ?>" class="btn btn-warning btn-sm">Ubah</a>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $tampilSlider['id_slider'] ?>">Hapus</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<?php foreach ($all_data_slider as $slider) : ?>
    <div class="modal fade" id="deleteModal<?= $slider['id_slider'] ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="<?= base_url('admin/slider/delete') . '/' . $slider['id_slider'] ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection('content') ?>