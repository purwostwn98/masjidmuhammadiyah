<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['username', 'password', 'nama_pengguna', 'alamat_pengguna', 'lembaga_pengguna', 'level', 'email_pengguna'];
    protected $useTimestamps    = true;

    public function simpan($username, $password, $nama_pengguna, $email_pengguna, $alamat_pengguna, $lembaga_pengguna, $level)
    {
        $dt_simpan = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'nama_pengguna' => $nama_pengguna,
            'email_pengguna' => $email_pengguna,
            'alamat_pengguna' => $alamat_pengguna,
            'lembaga_pengguna' => $lembaga_pengguna,
            'level' => $level
        ];

        $query = $this->insert($dt_simpan);
        return $query;
    }

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
