<?= $this->extend("/template/admin_template.php"); ?>
<?= $this->section("konten"); ?>
<?php $session = \Config\Services::session(); ?>
<div class="pagetitle">
    <h1>Kategori Masjid</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
            <li class="breadcrumb-item active">Kategori Masjid</li>
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
                        <!-- <button class="btn btn-sm btn-primary" id="btn-tambah"><i class="bi bi-database-fill-add"></i> Tambah Masjid</button> -->
                    </div>
                    <div class="row">
                        <div class="col-12  table-responsive">
                            <table class="" id="table-10" style="font-size: small;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>
                                            Nama Masjid
                                        </th>
                                        <th>Alamat</th>
                                        <th>Pengelola</th>
                                        <!-- <th data-type="date" data-format="YYYY/DD/MM">Ranting</th> -->
                                        <th>Ranting</th>
                                        <th>Koordinat</th>
                                        <th>Kategori</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>

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
        // load tabel
        dataTabel();

        //btn tambah click opeen modal
        $('#btn-tambah').on('click', function() {
            $.ajax({
                url: "<?= site_url('admin/dinamis/modal_tambah_masjid'); ?>",
                type: "POST",
                dataType: "json",
                data: {
                    idmasjid: "idmasjid"
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
    function dataTabel() {

        $('#table-10').DataTable({
            destroy: true,
            "ajax": {
                url: "<?= base_url('admin/dinamis/load_tabel_kategori'); ?>",
                type: "POST",
                data: {
                    masjid: "all"
                },
            },
            "columns": [{
                    className: 'align-top',
                    data: 'nomor'
                },
                {
                    className: 'align-top',
                    data: "nama"
                },
                {
                    className: 'align-top',
                    data: "alamat"
                },
                {
                    className: 'align-top',
                    data: "pengelola"
                },
                {
                    className: 'align-top',
                    data: "ranting"
                },
                {
                    className: 'align-top',
                    data: "koordinat"
                },
                {
                    "mData": null,
                    "bSortable": false,
                    "mRender": function(data, type, full) {
                        return '<i style="font-size:20px;" class="bi bi-star-fill ' + full['icon'] + '"></i>';
                    },
                    className: 'align-top text-center'
                },
                {
                    "mData": null,
                    "bSortable": false,
                    "mRender": function(data, type, full) {
                        return '<a href="/admin/riwayat-penilaian?idmasjid=' + full['id'] + '" class="btn btn-sm btn-info"><i class="bi bi-arrow-right-circle"></i></a>';
                    },
                    className: 'align-top text-center'
                }
            ],
        })
    }
</script>

<script>
    function detail(id) {
        $.ajax({
            url: "<?= site_url('admin/dinamis/modal_detail_masjid'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                idmasjid: id
            },
            beforeSend: function() {},
            complete: function() {},
            success: function(response) {
                $(".modal02").html(response.data);
                $("#largeModalDetail").modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });

        return false;
    }

    function edit(id) {
        $.ajax({
            url: "<?= site_url('admin/dinamis/modal_edit_masjid'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                idmasjid: id
            },
            beforeSend: function() {},
            complete: function() {},
            success: function(response) {
                $(".modal01").html(response.data);
                $("#largeModalEdit").modal('show');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });

        return false;
    }

    function hapus(id) {
        swal({
                title: "Anda yakin?",
                text: "Ingin menghapus data masjid ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var csrfName = 'csrf_test_name'; // CSRF Token name
                    var csrfHash = $("input[name='csrf_test_name']").val(); // CSRF hash
                    $.ajax({
                        url: "<?= site_url('admin/do_hapus_masjid'); ?>",
                        type: "POST",
                        dataType: "json",
                        data: {
                            idmasjid: id,
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
                            dataTabel();
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