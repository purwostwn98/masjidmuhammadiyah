<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriMasjidModel extends Model
{
    protected $table            = 'kategori_masjid';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['Kategori'];
}
