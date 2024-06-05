<div class="modal fade" id="largeModalTambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-database-fill-add"></i> Tambah Nilai Masjid</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= form_open("/admin/do-tambah-nilai", ['class' => 'g-3 needs-validation formadd']);
            // csrf_field();
            ?>
            <input type="hidden" value="<?= csrf_hash(); ?>" name="<?= csrf_token(); ?>" id="csrf">
            <input type="hidden" value="<?= $masjid['id']; ?>" name="id_masjid" id="csrf">
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h5 class="mb-0"><?= $masjid['nama_masjid']; ?></h5>
                            <span><?= $masjid['alamat_masjid']; ?></span>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <label for="selectpengelola" class="col-sm-4 col-form-label">Rata-rata jml. jamaah</label>
                            <div class="col-sm-8">
                                <select class="form-select" name="jumlah_jamaah" aria-label="Default selectpengelola" required>
                                    <option selected="" disabled></option>
                                    <option value='Kurang dari 10'>Kurang dari 10</option>
                                    <option value='Lebih dari 10, kurang dari 30'>Lebih dari 10, kurang dari 30</option>
                                    <option value='Lebih dari 30, kurang dari 50'>Lebih dari 30, kurang dari 50</option>
                                    <option value='Lebih dari 50'>Lebih dari 50</option>
                                    <option value='Lebih dari 50, kurang dari 100'>Lebih dari 50, kurang dari 100</option>
                                    <option value='Lebih dari 100'>Lebih dari 100</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="selectmerupakan_wakaf" class="col-sm-9 col-form-label">Masjid merupakan wakaf resmi ( ada sertifikat wakafnya ) ke Muhammadiyah</label>
                            <div class="col-sm-3">
                                <select class="form-select" name="merupakan_wakaf" aria-label="Default selectmerupakan_wakaf" required>
                                    <option selected="" disabled></option>
                                    <option value='Ya'>Ya</option>
                                    <option value='Tidak'>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="selectplakat_muhammadiyah" class="col-sm-9 col-form-label">Terpasang plakat/ identitas sebagai masjid yang dikelola Muhammadiyah</label>
                            <div class="col-sm-3">
                                <select class="form-select" name="plakat_muhammadiyah" aria-label="Default selectplakat_muhammadiyah" required>
                                    <option selected="" disabled></option>
                                    <option value='Ya'>Ya</option>
                                    <option value='Tidak'>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="selectsk_takmir" class="col-sm-9 col-form-label">SK Takmir Masjid oleh Persyarikatan</label>
                            <div class="col-sm-3">
                                <select class="form-select" name="sk_takmir" aria-label="Default selectsk_takmir" required>
                                    <option selected="" disabled></option>
                                    <option value='Ya'>Ya</option>
                                    <option value='Tidak'>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="selectkajian_kemuhammadiyahan" class="col-sm-9 col-form-label">Masjid menyelenggarakan kegiatan kajian Al Islam dan Kemuhammadiyahan secara rutin</label>
                            <div class="col-sm-3">
                                <select class="form-select" name="kajian_kemuhammadiyahan" aria-label="Default selectkajian_kemuhammadiyahan" required>
                                    <option selected="" disabled></option>
                                    <option value='Ya'>Ya</option>
                                    <option value='Tidak'>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="selectkegiatan_tarjih" class="col-sm-9 col-form-label">Amaliyah/ Ibadah/ kegiatan masjid sesuai manhaj Tarjih Muhammadiyah</label>
                            <div class="col-sm-3">
                                <select class="form-select" name="kegiatan_tarjih" aria-label="Default selectkegiatan_tarjih" required>
                                    <option selected="" disabled></option>
                                    <option value='Ya'>Ya</option>
                                    <option value='Tidak'>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="selectdakwah_digital" class="col-sm-9 col-form-label">Masjid mengembangkan dakwah digital</label>
                            <div class="col-sm-3">
                                <select class="form-select" name="dakwah_digital" aria-label="Default selectdakwah_digital" required>
                                    <option selected="" disabled></option>
                                    <option value='Ya'>Ya</option>
                                    <option value='Tidak'>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="selectimb_masjid" class="col-sm-9 col-form-label">Masjid memiliki IMB sebagai tempat ibadah</label>
                            <div class="col-sm-3">
                                <select class="form-select" name="imb_masjid" aria-label="Default selectimb_masjid" required>
                                    <option selected="" disabled></option>
                                    <option value='Ya'>Ya</option>
                                    <option value='Tidak'>Tidak</option>
                                </select>
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