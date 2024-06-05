<div class="modal fade" id="largeModalEdit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Edit Data Masjid</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= form_open("/admin/do-edit-masjid", ['class' => 'g-3 needs-validation formadd']);
            // csrf_field();
            ?>
            <input type="hidden" value="<?= csrf_hash(); ?>" name="<?= csrf_token(); ?>" id="csrf">
            <input type="hidden" name="id" value="<?= $masjid['id']; ?>">
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3 mt-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Nama Masjid</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_masjid" value="<?= $masjid['nama_masjid']; ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputalamat" class="col-sm-4 col-form-label">Alamat Masjid</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" style="height: 100px" name="alamat_masjid" id="inputalamat" placeholder="Alamat lengkap masjid" required><?= $masjid['alamat_masjid']; ?></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="selectpengelola" class="col-sm-4 col-form-label">Pengelola</label>
                            <div class="col-sm-8">
                                <select class="form-select" name="pengelola_masjid" aria-label="Default selectpengelola" required value="<?= $masjid['pengelola_masjid']; ?>">
                                    <option value="" disabled></option>
                                    <option <?= $masjid['pengelola_masjid'] == 'PCM' ? 'selected' : ''; ?> value='PCM'>PCM</option>
                                    <option <?= $masjid['pengelola_masjid'] == 'PRM' ? 'selected' : ''; ?> value='PRM'>PRM</option>
                                    <option <?= $masjid['pengelola_masjid'] == 'PDM' ? 'selected' : ''; ?> value='PDM'>PDM</option>
                                    <option <?= $masjid['pengelola_masjid'] == 'AUM' ? 'selected' : ''; ?> value='AUM'>AUM</option>
                                    <option <?= $masjid['pengelola_masjid'] == 'PWM' ? 'selected' : ''; ?> value='PWM'>PWM</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputnmPengelola" class="col-sm-4 col-form-label">Nama Pengelola</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_pengelola" id="inputnmPengelola" required value="<?= $masjid['nama_pengelola']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputnmRanting" class="col-sm-4 col-form-label">Nama Ranting</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_ranting" id="inputnmRanting" required value="<?= $masjid['nama_ranting']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputnmCabang" class="col-sm-4 col-form-label">Nama Cabang</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_cabang" id="inputnmCabang" required value="<?= $masjid['nama_cabang']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputnmDaerah" class="col-sm-4 col-form-label">Nama Daerah</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_daerah" id="inputnmDaerah" required value="<?= $masjid['nama_daerah']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputnmWilayah" class="col-sm-4 col-form-label">Nama Wilayah</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_wilayah" id="inputnmWilayah" required value="<?= $masjid['nama_wilayah']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputnmTakmir" class="col-sm-4 col-form-label">Nama Takmir</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_takmir" id="inputnmTakmir" required value="<?= $masjid['nama_takmir']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputnmtlpTakmir" class="col-sm-4 col-form-label">No. Tlp. Takmir</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="tlp_takmir" id="inputnmtlpTakmir" required value="<?= $masjid['tlp_takmir']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputkoorditanX" class="col-sm-4 col-form-label">Koordinat X</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="koordinat_x" id="inputkoorditanX" required value="<?= $masjid['koordinat_x']; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputkoorditanY" class="col-sm-4 col-form-label">Koordinat Y</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="koordinat_y" id="inputkoorditanY" required value="<?= $masjid['koordinat_y']; ?>">
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