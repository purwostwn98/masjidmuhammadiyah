<?= $this->extend("/template/landing_template.php"); ?>
<?= $this->section("konten"); ?>
<!-- Hero Section -->
<section id="hero" class="hero section">
    <div class="hero-bg">
        <img src="<?= base_url(); ?>/assetslanding/img/hero-bg-light.webp" alt="">
    </div>
    <div class="container text-center">
        <div class="justify-content-center align-items-center">
            <h1 data-aos="fade-up"><span>السَّلَامُ عَلَيْكُمْ وَرَحْمَةُ ٱللَّٰهِ وَبَرَكَاتُهُ</span></h1>
            <p data-aos="fade-up" data-aos-delay="100" class="mt-4">Kategori Masjid Muhammadiyah<br></p>
            <div data-aos="fade-up" data-aos-delay="200" class="row justify-content-center align-items-center">
                <div class="col-lg-4 sm-8">
                    <select id="selectmasjid">
                        <option value=""></option>
                        <?php foreach ($listMasjid as $key => $m) { ?>
                            <option value="<?= $m['id']; ?>"><?= $m['nama_masjid'] . " | " . $m['alamat_masjid']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div id="map" style="height: 500px;"></div>
            <!-- <img src="<?= base_url(); ?>/assetslanding/img/hero-services-img.webp" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300"> -->
        </div>
    </div>
</section><!-- /Hero Section -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#selectmasjid').select2({
            placeholder: "Cari Nama Masjid ..."
        });

        loadPeta(null);

        $('#selectmasjid').change(function() {
            // loadPeta(this.value);
            $.ajax({
                url: "<?= site_url('landing/dinamis/dinamis_review_maps'); ?>",
                type: "POST",
                dataType: "json",
                data: {
                    idmasjid: this.value
                },
                beforeSend: function() {},
                complete: function() {},
                success: function(response) {
                    map.setView([response.koordinat_x, response.koordinat_y], 20, {
                        animation: true
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;

        });
    });
</script>

<script>
    // Initialize the map and set its view to a specific location and zoom level
    var map = L.map('map').setView([-1.250799, 116.847905], 5);

    // Add a tile layer to the map (e.g., OpenStreetMap tiles)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
</script>
<script>
    function loadPeta(idmasjid) {
        $.ajax({
            url: "<?= site_url('landing/dinamis/load_peta'); ?>",
            type: "POST",
            dataType: "json",
            data: {
                idmasjid: idmasjid
            },
            beforeSend: function() {},
            complete: function() {},
            success: function(response) {
                $.each(response.allmasjid, function(index, masjid) {
                    var ImgIcon = L.icon({
                        iconUrl: '<?= base_url(); ?>/imageicon/' + masjid.icon,
                        iconSize: [25, 37], // size of the icon
                        iconAnchor: [12, 41], // point of the icon which will correspond to marker's location
                        popupAnchor: [1, -34], // point from which the popup should open relative to the iconAnchor
                        shadowUrl: '<?= base_url(); ?>/imageicon/marker-shadow.png',
                        shadowSize: [41, 41] // size of the shadow
                    });

                    var marker = L.marker([masjid.koordinat_x, masjid.koordinat_y], {
                        icon: ImgIcon
                    }).addTo(map);
                    // marker.bindTooltip(masjid.nama_masjid, {
                    //     permanent: true,
                    //     direction: 'right'
                    // });
                    // Bind a popup to the marker
                    marker.bindPopup("<b>" + masjid.nama_masjid + "</b></br>" + masjid.alamat_masjid);
                });
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
        return false;
    }
</script>



<?= $this->endSection(); ?>