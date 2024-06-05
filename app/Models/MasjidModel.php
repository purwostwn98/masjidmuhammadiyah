<?php

namespace App\Models;

use CodeIgniter\Model;

class MasjidModel extends Model
{
    protected $table            = 'master_masjid';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama_masjid', 'alamat_masjid', 'pengelola_masjid', 'nama_pengelola', 'nama_ranting', 'nama_cabang', 'nama_daerah', 'nama_wilayah', 'nama_takmir', 'tlp_takmir', 'koordinat_x', 'koordinat_y', 'id_nilai'];
    protected $useTimestamps    = true;
    protected $createdField     = 'msjd_createdat';
    protected $updatedField     = 'msjd_updatedat';

    // public function get_semua_mahasiswa()
    // {
    //     $query = $this->join('mstr_lembaga as lmbg', 'mstr_mahasiswa.kode_prodi = lmbg.kode_prodi')->findAll();
    //     return $query;
    // }

    // public function get_mahasiswa_angkatan($tahun)
    // {
    //     $query = $this->join('mstr_lembaga as lmbg', 'mstr_mahasiswa.kode_prodi = lmbg.kode_prodi')->where('angkatan', $tahun)->findAll();
    //     return $query;
    // }

    // public function update_mhs($nim, $email, $nama_mhs)
    // {
    //     $dt_update = [
    //         'nama_mhs' => $nama_mhs,
    //         'email' => $email
    //     ];
    //     $query = $this->where('nim', $nim)->set($dt_update)->update();
    //     return $query;
    // }

    public function simpan_masjid($nama_masjid, $alamat_masjid, $pengelola_masjid, $nama_pengelola, $nama_ranting, $nama_cabang, $nama_daerah, $nama_wilayah, $nama_takmir, $tlp_takmir, $koordinat_x, $koordinat_y, $id_nilai = 0)
    {
        $dt_simpan = [
            'nama_masjid' => $nama_masjid,
            'alamat_masjid' => $alamat_masjid,
            'pengelola_masjid' => $pengelola_masjid,
            'nama_pengelola' => $nama_pengelola,
            'nama_ranting' => $nama_ranting,
            'nama_cabang' => $nama_cabang,
            'nama_daerah' => $nama_daerah,
            'nama_wilayah' => $nama_wilayah,
            'nama_takmir' => $nama_takmir,
            'tlp_takmir' => $tlp_takmir,
            'koordinat_x' => $koordinat_x,
            'koordinat_y' => $koordinat_y,
            'id_nilai' => $id_nilai
        ];

        $this->transBegin();
        $this->insert($dt_simpan);
        if ($this->transStatus() === false) {
            $this->transRollback();
            $msg = false;
        } else {
            $this->transCommit();
            $msg = true;
        }
        return $msg;
    }

    public function edit_masjid($id, $nama_masjid, $alamat_masjid, $pengelola_masjid, $nama_pengelola, $nama_ranting, $nama_cabang, $nama_daerah, $nama_wilayah, $nama_takmir, $tlp_takmir, $koordinat_x, $koordinat_y)
    {
        $dt_simpan = [
            'nama_masjid' => $nama_masjid,
            'alamat_masjid' => $alamat_masjid,
            'pengelola_masjid' => $pengelola_masjid,
            'nama_pengelola' => $nama_pengelola,
            'nama_ranting' => $nama_ranting,
            'nama_cabang' => $nama_cabang,
            'nama_daerah' => $nama_daerah,
            'nama_wilayah' => $nama_wilayah,
            'nama_takmir' => $nama_takmir,
            'tlp_takmir' => $tlp_takmir,
            'koordinat_x' => $koordinat_x,
            'koordinat_y' => $koordinat_y
        ];

        $this->transBegin();
        $this->update($id, $dt_simpan);
        if ($this->transStatus() === false) {
            $this->transRollback();
            $msg = false;
        } else {
            $this->transCommit();
            $msg = true;
        }
        return $msg;
    }

    public function editNilaiMasjid($id, $idnilai)
    {
        $dt_simpan = [
            'id_nilai' => $idnilai
        ];

        $this->transBegin();
        $this->update($id, $dt_simpan);
        if ($this->transStatus() === false) {
            $this->transRollback();
            $msg = false;
        } else {
            $this->transCommit();
            $msg = true;
        }
        return $msg;
    }
}

class NilaiMasjidModel extends Model
{
    protected $table            = 'masjid_nilai';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_masjid', 'jumlah_jamaah', 'merupakan_wakaf', 'plakat_muhammadiyah', 'sk_takmir', 'kajian_kemuhammadiyahan', 'kegiatan_tarjih', 'dakwah_digital', 'imb_masjid', 'id_penilai'];
    protected $useTimestamps    = true;
    protected $createdField     = 'nilai_createdat';
    protected $updatedField     = 'nilai_updatedat';

    public function simpan($id_masjid, $jumlah_jamaah, $merupakan_wakaf, $plakat_muhammadiyah, $sk_takmir, $kajian_kemuhammadiyahan, $kegiatan_tarjih, $dakwah_digital, $imb_masjid, $id_penilai = 1)
    {
        $dt_simpan = [
            'id_masjid' => $id_masjid,
            'jumlah_jamaah' => $jumlah_jamaah,
            'merupakan_wakaf' => $merupakan_wakaf,
            'plakat_muhammadiyah' => $plakat_muhammadiyah,
            'sk_takmir' => $sk_takmir,
            'kajian_kemuhammadiyahan' => $kajian_kemuhammadiyahan,
            'kegiatan_tarjih' => $kegiatan_tarjih,
            'dakwah_digital' => $dakwah_digital,
            'imb_masjid' => $imb_masjid,
            'id_penilai' => $id_penilai
        ];

        $this->transBegin();
        $this->insert($dt_simpan);
        if ($this->transStatus() === false) {
            $this->transRollback();
            $msg = false;
        } else {
            $this->transCommit();
            $msg = $this->getInsertID();
        }
        return $msg;
    }
}
