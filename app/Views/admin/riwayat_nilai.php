<?= $this->extend("/template/admin_template.php"); ?>
<?= $this->section("konten"); ?>
<?php $session = \Config\Services::session(); ?>
<div class="pagetitle">
    <h1>Data Riwayat Penilaian</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
            <li class="breadcrumb-item active">Kategori Masjid</li>
            <li class="breadcrumb-item active">Riwayat Penilaian</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <?php if ($session->getFlashdata('gagal')) {  ?>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                    <?= $session->getFlashdata('gagal'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php } elseif ($session->getFlashdata('berhasil')) { ?>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show small" role="alert">
                    <?= $session->getFlashdata('berhasil'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row justify-align-between">
                            <div class="col-md-6">
                                <button class="btn btn-sm btn-primary" id="btn-tambah"><i class="bi bi-database-fill-add"></i> Tambah Data Nilai</button>
                            </div>
                            <div class="col-auto text-right">
                                <h5 class="mb-0"><?= $masjid['nama_masjid']; ?></h5>
                                <span><?= $masjid['alamat_masjid']; ?></span>
                            </div>
                            <!-- <button class="btn btn-sm btn-primary" id="btn-tambah"><i class="bi bi-database-fill-add"></i> Tambah Data Nilai</button> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="" id="table-10" style="font-size: small;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Jumlah Jamaah</th>
                                        <th>Wakaf</th>
                                        <th>Identitas Muhammadiyah</th>
                                        <th>SK Takmir</th>
                                        <th>Kajian</th>
                                        <th>Tarjih</th>
                                        <th>Digital</th>
                                        <th>IMB</th>
                                        <th>Penilai</th>
                                        <th>Tanggal</th>
                                        <th>Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($riwayat_nilai as $key => $n) { ?>
                                        <tr>
                                            <td class="align-top text-center"><?= $key + 1; ?></td>
                                            <td class="align-top"><?= $n['jumlah_jamaah']; ?></td>
                                            <td class="align-top"><?= $n['merupakan_wakaf']; ?></td>
                                            <td class="align-top"><?= $n['plakat_muhammadiyah']; ?></td>
                                            <td class="align-top"><?= $n['sk_takmir']; ?></td>
                                            <td class="align-top"><?= $n['kajian_kemuhammadiyahan']; ?></td>
                                            <td class="align-top"><?= $n['kegiatan_tarjih']; ?></td>
                                            <td class="align-top"><?= $n['dakwah_digital']; ?></td>
                                            <td class="align-top"><?= $n['imb_masjid']; ?></td>
                                            <td class="align-top"><?= $n['nama_pengguna']; ?></td>
                                            <td class="align-top"><?= $n['nilai_updatedat']; ?></td>
                                            <td class="align-top"><button class="btn btn-sm btn-danger" onclick="hapus('<?= $n['id']; ?>', '<?= $n['id_masjid']; ?>')"><i class="bi bi-trash"></i></button></td>
                                        </tr>
                                    <?php }  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal01">

</div>
<div class="modal02">

</div>
<section class="error">
    <div class="row">
        <div class="col-12">
            <p id="inierror"></p>
        </div>
    </div>
</section>
<input type="hidden" value="<?= csrf_hash(); ?>" name="<?= csrf_token(); ?>" id="csrf">
<input type="hidden" value="<?= $idmasjid; ?>" name="idmasjid" id="idmasjid">
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function() {
        //btn tambah click opeen modal
        $('#table-10').DataTable();

        $('#btn-tambah').on('click', function() {
            $.ajax({
                url: "<?= site_url('admin/dinamis/modal_tambah_nilai'); ?>",
                type: "POST",
                dataType: "json",
                data: {
                    idmasjid: $("#idmasjid").val()
                },
                beforeSend: function() {},
                complete: function() {},
                success: function(response) {
                    $(".modal01").html(response.data);
                    $("#largeModalTambah").modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    $("#inierror").html(xhr.status + "<br>" + xhr.responseText + "<br>" + thrownError)
                }
            });
            return false;
        });
    });
</script>

<script>
    function hapus(idnilai, idmasjid) {
        swal({
                title: "Anda yakin?",
                text: "Ingin menghapus data nilai ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var csrfName = 'csrf_test_name'; // CSRF Token name
                    var csrfHash = $("input[name='csrf_test_name']").val(); // CSRF hash
                    $.ajax({
                        url: "<?= site_url('admin/do_hapus_nilai'); ?>",
                        type: "POST",
                        dataType: "json",
                        data: {
                            idnilai: idnilai,
                            idmasjid: idmasjid,
                            [csrfName]: csrfHash
                        },
                        beforeSend: function() {},
                        complete: function() {},
                        success: function(response) {
                            $("input[name='csrf_test_name']").val(response.token);
                            if (response.status == 0) {
                                iziToast.error({
                                    title: 'Info!',
                                    message: response.pesan,
                                    position: 'topRight'
                                });
                            } else {
                                iziToast.success({
                                    title: 'Info!',
                                    message: response.pesan,
                                    position: 'topRight'
                                });
                            }
                            location.reload();
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                }
            });

        return false;
    }
</script>

<?= $this->endSection(); ?>