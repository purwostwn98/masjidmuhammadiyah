<?= $this->extend("/template/landing_template.php"); ?>
<?= $this->section("konten"); ?>
<!-- Hero Section -->
<section id="hero" class="hero section">
    <div class="hero-bg">
        <img src="<?= base_url(); ?>/assetslanding/img/hero-bg-light.webp" alt="">
    </div>
    <div class="container text-center">
        <div class="justify-content-center align-items-center">
            <h1 data-aos="fade-up" class="mt-3"><span>السَّلَامُ عَلَيْكُمْ وَرَحْمَةُ ٱللَّٰهِ وَبَرَكَاتُهُ</span></h1>
            <p data-aos="fade-up" data-aos-delay="100" class="mt-4">Kategori Masjid Muhammadiyah<br></p>
            <div data-aos="fade-up" data-aos-delay="200" class="row justify-content-center align-items-center">
                <div class="col-lg-4 sm-8">
                    <select id="selectmasjid">
                        <option value=""></option>
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
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
    });
</script>

<script>
    // Initialize the map and set its view to a specific location and zoom level
    var map = L.map('map').setView([-7.5580860321414285, 110.77167166686505], 13);

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

                console.log(response.allmasjid);
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
<script>
    // Add a marker to the map
    var marker = L.marker([-7.5580860321414285, 110.77167166686505], {
        title: "Universitas Muhammadiyah Surakarta"
    }).addTo(map);

    marker.bindTooltip("Universitas Muhammadiyah Surakarta", {
        permanent: true,
        direction: 'right'
    });
    // Bind a popup to the marker
    marker.bindPopup("<b>Universitas Muhammadiyah Surakarta</b></br>Universitas terbaik");

    // // Add a marker to the map
    // var marker2 = L.marker([-7.546038589597217, 110.77203030919318]).addTo(map);
    // // Bind a popup to the marker
    // marker2.bindPopup("<b>Edutorium UMS</b></br>Universitas terbaik");
</script>



<?= $this->endSection(); ?>