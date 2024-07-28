<?php

namespace App\Controllers;

use App\Models\MasjidModel;
use App\Models\KategoriMasjidModel;
use App\Models\NilaiMasjidModel;

class Landing extends BaseController
{
    protected $masjidModel;
    protected $kategoriMasjidModel;
    protected $nilaiMasjidModel;

    public function __construct()
    {
        $this->masjidModel = new MasjidModel();
        $this->kategoriMasjidModel = new KategoriMasjidModel();
        $this->nilaiMasjidModel = new NilaiMasjidModel();
    }

    public function index(): string
    {
        $data = [
            'listMasjid' => $this->masjidModel->where('koordinat_x!=', null)->where('koordinat_y!=', null)
                ->select('id, nama_masjid, alamat_masjid, koordinat_x, koordinat_y')->findAll()
        ];
        return view('landingpage/index', $data);
    }

    public function dinamis_review_maps()
    {
        $id = $this->request->getPost('idmasjid');
        $masjid = $this->masjidModel->where('id', $id)->first();
        $msg['koordinat_x'] = $masjid['koordinat_x'];
        $msg['koordinat_y'] = $masjid['koordinat_y'];
        echo json_encode($msg);
    }

    public function dinamis_load_peta()
    {
        if ($this->request->isAJAX()) {
            $idmasjid = $this->request->getPost('idmasjid');
            $allmasjid = $this->masjidModel->where('koordinat_x!=', null)->where('koordinat_y!=', null)
                ->findAll();

            $kategori_wajib = $this->kategoriMasjidModel->where("wajib", 1)->findAll();
            $kategori_tambahan = $this->kategoriMasjidModel->where("wajib", 0)->findAll();
            $nilai = $this->nilaiMasjidModel->findAll();
            $arr_nilai = [];
            foreach ($nilai as $key => $n) {
                $i = md5($n["id_masjid"] . "-" . $n["id_kategori"]);
                $arr_nilai[$i] = $n["nilai"];
            }

            $nilai = [];
            //array ini perlu ditambah jika tambah kolom kriteria
            $arr_masjid = [];
            foreach ($allmasjid as $key => $val) {
                $wajib = true;
                foreach ($kategori_wajib as $k => $kw) {
                    $i = md5($val["id"] . "-" . $kw["id"]);
                    if (empty($arr_nilai[$i]) || $arr_nilai[$i] == 0) {
                        $wajib = false;
                    }
                }

                $jml_kriteria_lain = 0;
                if ($wajib == true) {
                    foreach ($kategori_tambahan as $k => $kt) {
                        $i = md5($val["id"] . "-" . $kt["id"]);
                        if ($kt["id"] == 8) {
                            if (!empty($arr_nilai[$i]) && $arr_nilai[$i] >= 3) {
                                $jml_kriteria_lain += 1;
                            }
                        } else {
                            if (!empty($arr_nilai[$i]) && $arr_nilai[$i] != 0) {
                                $jml_kriteria_lain += 1;
                            }
                        }
                    }
                }


                // menentukan warna icon
                if ($wajib == false) {
                    $icon = "abuicon.png";
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
                    'nama_masjid' => $val['nama_masjid'],
                    'koordinat_x' => $val['koordinat_x'],
                    'koordinat_y' => $val['koordinat_y'],
                    'tlp_takmir' => $val['tlp_takmir'],
                    'alamat_masjid' => $val['alamat_masjid'],
                    'icon' => $icon
                );
            }

            $msg['allmasjid'] = $arr_masjid;
            echo json_encode($msg);
        } else {
            echo ("Maaf perintah anda tidak dapat diproses");
        }
    }
}
