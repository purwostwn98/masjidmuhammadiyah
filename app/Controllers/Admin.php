<?php

namespace App\Controllers;

use App\Models\MasjidModel;
use App\Models\NilaiMasjidModel;

class Admin extends BaseController
{
    protected $masjidModel;
    protected $nilaiMasjidModel;

    public function __construct()
    {
        $this->masjidModel = new MasjidModel();
        $this->nilaiMasjidModel = new NilaiMasjidModel();
    }

    public function dashboard(): string
    {
        $pwm = $this->dm->Read("SELECT master_pwm.id,master_pwm.Nama, Count(*) AS Jml FROM master_masjid
                                    INNER JOIN master_pwm ON master_masjid.id_pwm = master_pwm.id
                                    GROUP BY master_pwm.id,master_pwm.Nama");
        $dnpwm = array();
        $dtpwm = array();
        if($pwm){
            foreach($pwm as $a){
                $dnpwm[] = trim($a['Nama']);
                $dtpwm[] = $a['Jml'];
            }
        }

        $data = [
            "title" => ["admin", "Dashboard Admin"],
            "dpwm"  => json_encode($dtpwm),
            "npwm"  => json_encode($dnpwm)
        ];
        return view('admin/dashboard', $data);
    }

    public function v_master_masjid(): string
    {
        $data = [
            "title" => ["admin", "Master Masjid"]
        ];
        return view('admin/master_masjid', $data);
    }

    public function load_master_masjid()
    {
        if ($this->request->isAJAX()) {
            $data = $this->masjidModel->findAll();

            $data_tampil = [];
            foreach ($data as $ind => $val) {
                if ($val['koordinat_x'] == null || $val['koordinat_x'] == "") {
                    $koordinat_x = "-";
                } else {
                    $koordinat_x = $val['koordinat_x'];
                }
                if ($val['koordinat_y'] == null || $val['koordinat_y'] == "") {
                    $koordinat_y = "-";
                } else {
                    $koordinat_y = $val['koordinat_y'];
                }
                // $data_tampil[] = array('id' => $val['id'], 'nama' => $val['nama_masjid'], 'alamat' => $val['alamat_masjid'], 'pengelola' => $val['pengelola_masjid'] . " -> " . $val['nama_pengelola'], 'ranting' => $val['nama_ranting'], 'koordinat' => $koordinat_x . ", " . $koordinat_y, 'nomor' => $ind + 1);
                $data_tampil[] = array(
                    'id' => $val['id'], 'nama' => $val['nama_masjid'], 'nomor' => $ind + 1,
                    'alamat' => $val['alamat_masjid'],
                    'pengelola' => $val['pengelola_masjid'] . " | " . $val['nama_pengelola'],
                    'ranting' => $val['nama_ranting'] != null ? $val['nama_ranting'] : '',
                    'koordinat' => $koordinat_x . ", " . $koordinat_y
                );
            }
            $msg['data'] = $data_tampil;
            echo json_encode($msg);
        } else {
            echo ("Maaf perintah anda tidak dapat diproses");
        }
    }

    public function modal_tambah_masjid()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'wilayah' => "daftarwilayah"
            ];
            $msg = [
                'data' => view('admin/dinamis/modal_tambah_masjid', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Maaf perintah anda tidak dapat diproses");
        }
    }

    public function do_tambah_masjid()
    {
        $nama_masjid = $this->request->getVar('nama_masjid');
        $alamat_masjid = $this->request->getVar('alamat_masjid');
        $pengelola_masjid = $this->request->getVar('pengelola_masjid');
        $nama_pengelola = $this->request->getVar('nama_pengelola');
        $nama_ranting = $this->request->getVar('nama_ranting');
        $nama_cabang = $this->request->getVar('nama_cabang');
        $nama_daerah = $this->request->getVar('nama_daerah');
        $nama_wilayah = $this->request->getVar('nama_wilayah');
        $nama_takmir = $this->request->getVar('nama_takmir');
        $tlp_takmir = $this->request->getVar('tlp_takmir');
        $koordinat_x = $this->request->getVar('koordinat_x');
        $koordinat_y = $this->request->getVar('koordinat_y');
        $query = $this->masjidModel->simpan_masjid($nama_masjid, $alamat_masjid, $pengelola_masjid, $nama_pengelola, $nama_ranting, $nama_cabang, $nama_daerah, $nama_wilayah, $nama_takmir, $tlp_takmir, $koordinat_x, $koordinat_y);
        if ($query == true) {
            $this->session->setFlashdata('berhasil', "Masjid Baru berhasil disimpan");
        } else {
            $this->session->setFlashdata('gagal', "Masjid Baru gagal disimpan");
        }
        return redirect()->to('/admin/master-masjid')->withInput();
    }

    public function do_hapus_masjid()
    {

        $id = $this->request->getPost('idmasjid');

        $this->masjidModel->transBegin();
        $this->masjidModel->delete($id);
        if ($this->masjidModel->transStatus() === false) {
            $this->masjidModel->transRollback();
            $status = 0;
            $pesan = "Masjid gagal dihapus";
        } else {
            $this->masjidModel->transCommit();
            $status = 1;
            $pesan = "Masjid berhasil dihapus";
        }
        $data =
            [
                'token' => csrf_hash(),
                'pesan' => $pesan,
                'status' => $status
            ];
        echo json_encode($data);
    }


    public function modal_edit_masjid()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('idmasjid');
            $data = [
                'masjid' => $this->masjidModel->where('id', $id)->first()
            ];
            $msg = [
                'data' => view('admin/dinamis/modal_edit_masjid', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Maaf perintah anda tidak dapat diproses");
        }
    }

    public function do_edit_masjid()
    {
        $id = $this->request->getVar('id');
        $nama_masjid = $this->request->getVar('nama_masjid');
        $alamat_masjid = $this->request->getVar('alamat_masjid');
        $pengelola_masjid = $this->request->getVar('pengelola_masjid');
        $nama_pengelola = $this->request->getVar('nama_pengelola');
        $nama_ranting = $this->request->getVar('nama_ranting');
        $nama_cabang = $this->request->getVar('nama_cabang');
        $nama_daerah = $this->request->getVar('nama_daerah');
        $nama_wilayah = $this->request->getVar('nama_wilayah');
        $nama_takmir = $this->request->getVar('nama_takmir');
        $tlp_takmir = $this->request->getVar('tlp_takmir');
        $koordinat_x = $this->request->getVar('koordinat_x');
        $koordinat_y = $this->request->getVar('koordinat_y');
        $query = $this->masjidModel->edit_masjid($id, $nama_masjid, $alamat_masjid, $pengelola_masjid, $nama_pengelola, $nama_ranting, $nama_cabang, $nama_daerah, $nama_wilayah, $nama_takmir, $tlp_takmir, $koordinat_x, $koordinat_y);
        if ($query == true) {
            $this->session->setFlashdata('berhasil', "Masjid berhasil diupdate");
        } else {
            $this->session->setFlashdata('gagal', "Masjid gagal diupdate");
        }
        return redirect()->to('/admin/master-masjid')->withInput();
    }

    public function modal_detail_masjid()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('idmasjid');
            $data = [
                'masjid' => $this->masjidModel->where('id', $id)->first()
            ];
            $msg = [
                'data' => view('admin/dinamis/modal_detail_masjid', $data)
            ];
            echo json_encode($msg);
        } else {
            exit("Maaf perintah anda tidak dapat diproses");
        }
    }

    public function v_kategori_masjid(): string
    {
        $data = [
            "title" => ["admin", "Kategori Masjid"]
        ];
        return view('admin/kategori_masjid', $data);
    }

    public function load_tabel_kategori()
    {
        if ($this->request->isAJAX()) {
            $data = $this->masjidModel
                ->join('masjid_nilai', 'master_masjid.id_nilai = masjid_nilai.id', "left")
                ->select('master_masjid.id, nama_masjid, alamat_masjid, pengelola_masjid, nama_pengelola, nama_ranting, koordinat_x, koordinat_y, id_nilai,
                            id_masjid, jumlah_jamaah, merupakan_wakaf, plakat_muhammadiyah, sk_takmir, kajian_kemuhammadiyahan, kegiatan_tarjih, dakwah_digital, imb_masjid, id_penilai')
                ->findAll();
            $data_tampil = [];
            foreach ($data as $ind => $val) {
                $jml_kriteria_lain = 0;
                if ($val['jumlah_jamaah'] != "Lebih dari 10, kurang dari 30" || $val['jumlah_jamaah'] != "Kurang dari 10") {
                    $jml_kriteria_lain += 1;
                }

                $arr_kriteria_lainnya = ['kajian_kemuhammadiyahan', 'dakwah_digital', 'imb_masjid'];
                foreach ($arr_kriteria_lainnya as $a => $k) {
                    if ($val[$k] == "Ya") {
                        $jml_kriteria_lain += 1;
                    }
                }

                // menentukan warna icon
                if ($val['merupakan_wakaf'] != "Ya" || $val['plakat_muhammadiyah'] != "Ya" || $val['sk_takmir'] != "Ya" || $val['kegiatan_tarjih'] != "Ya") {
                    $icon = "text-secondary";
                } else {
                    if ($jml_kriteria_lain <= 4) {
                        $icon = "text-danger";
                    } elseif ($jml_kriteria_lain <= 7) {
                        $icon = "text-warning";
                    } else {
                        $icon = "text-success";
                    }
                }

                if ($val['koordinat_x'] == null || $val['koordinat_x'] == "") {
                    $koordinat_x = "-";
                } else {
                    $koordinat_x = $val['koordinat_x'];
                }
                if ($val['koordinat_y'] == null || $val['koordinat_y'] == "") {
                    $koordinat_y = "-";
                } else {
                    $koordinat_y = $val['koordinat_y'];
                }
                // $data_tampil[] = array('id' => $val['id'], 'nama' => $val['nama_masjid'], 'alamat' => $val['alamat_masjid'], 'pengelola' => $val['pengelola_masjid'] . " -> " . $val['nama_pengelola'], 'ranting' => $val['nama_ranting'], 'koordinat' => $koordinat_x . ", " . $koordinat_y, 'nomor' => $ind + 1);
                $data_tampil[] = array(
                    'id' => $val['id'], 'nama' => $val['nama_masjid'], 'nomor' => $ind + 1,
                    'alamat' => $val['alamat_masjid'],
                    'pengelola' => $val['pengelola_masjid'] . " | " . $val['nama_pengelola'],
                    'ranting' => $val['nama_ranting'] != null ? $val['nama_ranting'] : '',
                    'koordinat' => $koordinat_x . ", " . $koordinat_y,
                    'icon' => $icon
                );
            }
            $msg['data'] = $data_tampil;
            echo json_encode($msg);
        } else {
            echo ("Maaf perintah anda tidak dapat diproses");
        }
    }

    public function v_riwayat_penilaian(): string
    {
        $idmasjid = $this->request->getVar('idmasjid');
        $data = [
            "title" => ["admin", "Kategori Masjid"],
            "riwayat_nilai" => $this->nilaiMasjidModel->where('id_masjid', $idmasjid)
                ->join('users', 'masjid_nilai.id_penilai = users.id')
                ->select('masjid_nilai.id, id_masjid, jumlah_jamaah, merupakan_wakaf, plakat_muhammadiyah, sk_takmir, kajian_kemuhammadiyahan, kegiatan_tarjih, dakwah_digital, imb_masjid, id_penilai, nama_pengguna, nilai_updatedat')
                ->orderBy('nilai_updatedat', 'ASC')
                ->findAll(),
            "idmasjid" => $idmasjid,
            "masjid" => $this->masjidModel->where('id', $idmasjid)->first()
        ];
        return view('admin/riwayat_nilai', $data);
    }

    public function modal_tambah_nilai()
    {
        $idmasjid = $this->request->getVar('idmasjid');
        $masjid = $this->masjidModel->where('id', $idmasjid)->first();
        $data = [
            "masjid" => $masjid
        ];
        $msg = [
            'data' => view('admin/dinamis/modal_tambah_nilai', $data)
        ];
        echo json_encode($msg);
    }

    public function do_tambah_nilai()
    {

        $id_masjid = $this->request->getPost('id_masjid');
        $jumlah_jamaah = $this->request->getPost('jumlah_jamaah');
        $merupakan_wakaf = $this->request->getPost('merupakan_wakaf');
        $plakat_muhammadiyah = $this->request->getPost('plakat_muhammadiyah');
        $sk_takmir = $this->request->getPost('sk_takmir');
        $kajian_kemuhammadiyahan = $this->request->getPost('kajian_kemuhammadiyahan');
        $kegiatan_tarjih = $this->request->getPost('kegiatan_tarjih');
        $dakwah_digital = $this->request->getPost('dakwah_digital');
        $imb_masjid = $this->request->getPost('imb_masjid');
        $id_penilai = $_SESSION['userdata']['id_pengguna'];

        $idnilai = $this->nilaiMasjidModel->simpan($id_masjid, $jumlah_jamaah, $merupakan_wakaf, $plakat_muhammadiyah, $sk_takmir, $kajian_kemuhammadiyahan, $kegiatan_tarjih, $dakwah_digital, $imb_masjid, $id_penilai);
        if ($idnilai != false) {
            $this->session->setFlashdata('berhasil', "Kriteria masjid berhasil disimpan");
            //update idnilai masjid terbaru
            $this->masjidModel->editNilaiMasjid($id_masjid, $idnilai);
        } else {
            $this->session->setFlashdata('gagal', "Kriteria masjid gagal disimpan");
        }
        return redirect()->to("/admin/riwayat-penilaian?idmasjid=$id_masjid")->withInput();
    }

    public function do_hapus_nilai()
    {
        $id = $this->request->getPost('idnilai');
        $idmasjid = $this->request->getPost('idmasjid');
        $this->nilaiMasjidModel->transBegin();
        $this->nilaiMasjidModel->delete($id);
        if ($this->nilaiMasjidModel->transStatus() === false) {
            $this->nilaiMasjidModel->transRollback();
            $status = 0;
            $pesan = "Nilai gagal dihapus";
        } else {
            $this->nilaiMasjidModel->transCommit();
            $status = 1;
            $pesan = "Nilai berhasil dihapus";
            $n = $this->nilaiMasjidModel->where('id_masjid', $idmasjid)->selectMax('id')->first();
            if (!empty($n)) {
                $this->masjidModel->editNilaiMasjid($idmasjid, $n['id']);
            } else {
                $this->masjidModel->editNilaiMasjid($idmasjid, 0);
            }
        }
        $data =
            [
                'token' => csrf_hash(),
                'pesan' => $pesan,
                'status' => $status
            ];
        echo json_encode($data);
    }
}
