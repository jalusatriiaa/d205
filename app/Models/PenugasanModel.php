<?php

namespace App\Models;

use CodeIgniter\Model;

class PenugasanModel extends Model
{
    protected $table = 'penugasan';
    protected $primaryKey = 'id_tugas';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_penugasan', 'nomor_surat', 'tanggal_mulai', 'tanggal_surat', 'status_laporan', 'nomor_laporan', 'tanggal_selesai', 'file_st', 'file_km', 'file_laporan'];

    public function search($keyword)
    {
        return $this->table('penugasan')->like('nama_penugasan', $keyword)->orLike('nomor_surat', $keyword);
    }
}