<?php

namespace App\Controllers;

use App\Models\MasjidModel;

class Landing extends BaseController
{
    protected $masjidModel;

    public function __construct()
    {
        $this->masjidModel = new MasjidModel();
    }

    public function index(): string
    {
        return view('landingpage/index');
    }

    public function dinamis_load_peta()
    {
        if ($this->request->isAJAX()) {
            $idmasjid = $this->request->getPost('idmasjid');
            $allmasjid = $this->masjidModel->where('koordinat_x!=', null)->where('koordinat_y!=', null)
                ->join('masjid_nilai', 'master_masjid.id_nilai = masjid_nilai.id')
                ->findAll();
            //array ini perlu ditambah jika tambah kolom kriteria
            $arr_masjid = [];
            foreach ($allmasjid as $key => $v) {
                // cek syarat wajid
                $jml_kriteria_lain = 0;
                if ($v['jumlah_jamaah'] != "Lebih dari 10, kurang dari 30" || $v['jumlah_jamaah'] != "Kurang dari 10") {
                    $jml_kriteria_lain += 1;
                }

                $arr_kriteria_lainnya = ['kajian_kemuhammadiyahan', 'dakwah_digital', 'imb_masjid'];
                foreach ($arr_kriteria_lainnya as $a => $k) {
                    if ($v[$k] == "Ya") {
                        $jml_kriteria_lain += 1;
                    }
                }

                // menentukan warna icon
                if ($v['merupakan_wakaf'] != "Ya" || $v['plakat_muhammadiyah'] != "Ya" || $v['sk_takmir'] != "Ya" || $v['kegiatan_tarjih'] != "Ya") {
                    $icon = "abuIcon";
                } else {
                    if ($jml_kriteria_lain <= 4) {
                        $icon = "redicon.png";
                    } elseif ($jml_kriteria_lain <= 7) {
                        $icon = "yellowicon.png";
                    } else {
                        $icon = "greenicon.png";
                    }
                }
                $arr_masjid[] = array(
                    'nama_masjid' => $v['nama_masjid'],
                    'koordinat_x' => $v['koordinat_x'],
                    'koordinat_y' => $v['koordinat_y'],
                    'tlp_takmir' => $v['tlp_takmir'],
                    'alamat_masjid' => $v['alamat_masjid'],
                    'icon' => "yellowicon.png"
                );
            }

            $msg['allmasjid'] = $arr_masjid;
            echo json_encode($msg);
        } else {
            echo ("Maaf perintah anda tidak dapat diproses");
        }
    }
}
