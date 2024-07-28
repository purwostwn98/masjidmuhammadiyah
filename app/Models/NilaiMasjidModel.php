<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiMasjidModel extends Model
{
    protected $table            = 'nilai_masjid';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_masjid', 'id_kategori', 'nilai'];
    protected $useTimestamps    = true;
    protected $createdField     = 'nilai_createdat';
    protected $updatedField     = 'nilai_updatedat';

    public function simpan_masjid($id_masjid, $id_kategori, $nilai)
    {
        $dt_simpan = [
            'id_masjid' => $id_masjid,
            'id_kategori' => $id_kategori,
            'nilai' => $nilai
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

    public function edit_nilai($id, $nilai)
    {
        $dt_simpan = [
            'nilai' => $nilai
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
