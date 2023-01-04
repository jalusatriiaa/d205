<?php

namespace App\Models;

use CodeIgniter\Model;

class BerkasModel extends Model
{
    protected $table = 'penugasan';
    protected $primaryKey = 'id_penugasan';
    protected $useTimestamps = true;
    protected $allowedFields = ['file_st'];
    protected $returnType = 'object';
}