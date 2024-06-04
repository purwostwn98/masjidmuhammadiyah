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

    // public function simpan_mhs($nim, $kode_prodi, $angkatan, $nama_mhs, $email)
    // {
    //     $dt_simpan = [
    //         'nim' => $nim,
    //         'kode_prodi' => $kode_prodi,
    //         'angkatan' => $angkatan,
    //         'nama_mhs' => $nama_mhs,
    //         'email' => $email
    //     ];

    //     $query = $this->insert($dt_simpan);
    //     return $query;
    // }
}
