<?= $this->extend("/template/admin_template.php"); ?>
<?= $this->section("konten"); ?>
<?php $session = \Config\Services::session(); ?>
<div class="pagetitle">
    <h1>Data Riwayat Penilaian</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
            <li class="breadcrumb-item active">Kategori Masjid</li>
            <li class="breadcrumb-item active">Penilaian</li>
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
                            <div class="col-12 text-center">
                                <h5 class="mb-0"><b><?= $masjid['nama_masjid']; ?></b></h5>
                                <span class="text-center"><?= $masjid['alamat_masjid']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table" style="font-size: small;">
                                <thead class="bg-primary">
                                    <tr class="bg-primary">
                                        <th>#</th>
                                        <th>Keterangan</th>
                                        <th>Setting</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($kategori as $key => $n) { ?>
                                        <?php $i = md5($masjid["id"] . "-" . $n["id"]); ?>
                                        <tr>
                                            <td class="align-top text-center"><?= $key + 1; ?></td>
                                            <td class="align-top"><?= $n['Kategori']; ?></td>
                                            <td class="align-top">
                                                <?php if ($n["id"] == 8) { ?>
                                                    <select class="" id="exampleFormControlSelect1">
                                                        <option <?= $arr_nilai[$i] == 0 ? 'selected' : ''; ?> value="0" disabled>0</option>
                                                        <?php foreach ($jamaah as $jq => $j) { ?>
                                                            <option <?= $arr_nilai[$i] == $j["id"] ? 'selected' : ''; ?> value="<?= $j["id"]; ?>"><?= $j["ket"]; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                <?php } else { ?>
                                                    <select class="" id="exampleFormControlSelect1">
                                                        <option <?= $arr_nilai[$i] == 0 ? 'selected' : ''; ?> value="0">Tidak</option>
                                                        <option <?= $arr_nilai[$i] == 1 ? 'selected' : ''; ?> value="1">Ya</option>
                                                    </select>
                                                <?php } ?>
                                            </td>
                                            <td class="align-top">
                                                <?php if ($n["id"] == 8) { ?>
                                                    <?php if ($arr_nilai[$i] >= 3) { ?>
                                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Good</span>
                                                    <?php } else { ?>
                                                        <span class="badge bg-secondary"><i class="bi bi-collection me-1"></i> Bad</span>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php if ($arr_nilai[$i] == 1) { ?>
                                                        <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Good</span>
                                                    <?php } else { ?>
                                                        <span class="badge bg-secondary"><i class="bi bi-collection me-1"></i> Bad</span>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function() {
        //btn tambah click opeen modal
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