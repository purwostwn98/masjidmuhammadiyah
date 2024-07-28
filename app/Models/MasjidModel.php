<?php

namespace App\Models;

use CodeIgniter\Model;

class MasjidModel extends Model
{
    protected $table            = 'master_masjid';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama_masjid', 'alamat_masjid', 'pengelola_masjid', 'nama_pengelola', 'nama_ranting', 'nama_cabang', 'nama_daerah', 'nama_wilayah', 'nama_takmir', 'tlp_takmir', 'koordinat_x', 'koordinat_y', 'id_nilai', 'id_pwm'];
    protected $useTimestamps    = true;
    protected $createdField     = 'msjd_createdat';
    protected $updatedField     = 'msjd_updatedat';

    public function simpan_masjid($nama_masjid, $alamat_masjid, $pengelola_masjid, $nama_pengelola, $nama_ranting, $nama_cabang, $nama_daerah, $nama_wilayah, $nama_takmir, $tlp_takmir, $koordinat_x, $koordinat_y, $id_nilai, $id_pwm)
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
            'id_nilai' => $id_nilai,
            'id_pwm' => $id_pwm
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

    public function edit_masjid($id, $nama_masjid, $alamat_masjid, $pengelola_masjid, $nama_pengelola, $nama_ranting, $nama_cabang, $nama_daerah, $nama_takmir, $tlp_takmir, $koordinat_x, $koordinat_y, $id_pwm)
    {
        $dt_simpan = [
            'nama_masjid' => $nama_masjid,
            'alamat_masjid' => $alamat_masjid,
            'pengelola_masjid' => $pengelola_masjid,
            'nama_pengelola' => $nama_pengelola,
            'nama_ranting' => $nama_ranting,
            'nama_cabang' => $nama_cabang,
            'nama_daerah' => $nama_daerah,
            'nama_takmir' => $nama_takmir,
            'tlp_takmir' => $tlp_takmir,
            'koordinat_x' => $koordinat_x,
            'koordinat_y' => $koordinat_y,
            'id_pwm' => $id_pwm
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


class pwmModel extends Model
{
    protected $table            = 'master_pwm';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['Nama', 'Ketua', 'Ket'];

    public function simpan($Nama, $Ketua, $Ket)
    {
        $dt_simpan = [
            'Nama' => $Nama,
            'Ketua' => $Ketua,
            'Ket' => $Ket
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
