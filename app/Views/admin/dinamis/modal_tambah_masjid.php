<div class="modal fade" id="largeModalTambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-database-fill-add"></i> Tambah Masjid Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= form_open("/admin/do-tambah-masjid", ['class' => 'g-3 needs-validation formadd']);
            // csrf_field();
            ?>
            <input type="hidden" value="<?= csrf_hash(); ?>" name="<?= csrf_token(); ?>" id="csrf">
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3 mt-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Nama Masjid</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_masjid" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputalamat" class="col-sm-4 col-form-label">Alamat Masjid</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" style="height: 100px" name="alamat_masjid" id="inputalamat" placeholder="Alamat lengkap masjid" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="selectpengelola" class="col-sm-4 col-form-label">Pengelola</label>
                            <div class="col-sm-8">
                                <select class="form-select" name="pengelola_masjid" aria-label="Default selectpengelola" required>
                                    <option selected="" disabled></option>
                                    <option value='PCM'>PCM</option>
                                    <option value='PRM'>PRM</option>
                                    <option value='PDM'>PDM</option>
                                    <option value='AUM'>AUM</option>
                                    <option value='PWM'>PWM</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputnmPengelola" class="col-sm-4 col-form-label">Nama Pengelola</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_pengelola" id="inputnmPengelola" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputnmRanting" class="col-sm-4 col-form-label">Nama Ranting</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_ranting" id="inputnmRanting" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputnmCabang" class="col-sm-4 col-form-label">Nama Cabang</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_cabang" id="inputnmCabang" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputnmDaerah" class="col-sm-4 col-form-label">Nama Daerah</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_daerah" id="inputnmDaerah" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputnmWilayah" class="col-sm-4 col-form-label">Nama Wilayah</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_wilayah" id="inputnmWilayah" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputnmTakmir" class="col-sm-4 col-form-label">Nama Takmir</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_takmir" id="inputnmTakmir" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputnmtlpTakmir" class="col-sm-4 col-form-label">No. Tlp. Takmir</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tlp_takmir" id="inputnmtlpTakmir" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputkoorditanX" class="col-sm-4 col-form-label">Koordinat X</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="koordinat_x" id="inputkoorditanX" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputkoorditanY" class="col-sm-4 col-form-label">Koordinat Y</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="koordinat_y" id="inputkoorditanY" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Data</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div><!-- End Large Modal-->